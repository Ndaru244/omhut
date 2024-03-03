<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Admin_model');

    if (!$this->session->userdata('user_id')) {
      $this->session->unset_userdata('user_id');
      redirect(base_url('auth'));
    } else {
      $user_id = $this->session->userdata('user_id');
      $user = $this->Admin_model->get_pegawai_by_id($user_id);

      if($user['role_pegawai'] != "admin") {
        $this->session->unset_userdata('user_id');
        redirect(base_url('auth'));
      }
    }
  }

  public function index()
  {
    $user_id = $this->session->userdata('user_id');
    if ($user_id) {
      $user = $this->Admin_model->get_pegawai_by_id($user_id);
      $data['user'] = $user;
      $data['report'] = "Admin";
      $this->load->view('apps/admin/frame/header',$data);
      $this->load->view('apps/admin/home',$data);
      $this->load->view('apps/admin/frame/footer');
    }
  }

  public function meja()
  {
    $data['report'] = "Admin";
    $this->load->view('apps/admin/frame/header',$data);
    $this->load->view('apps/admin/meja');
    $this->load->view('apps/admin/frame/footer');
  }

  public function menu()
  {
    $data['report'] = "Admin";
    $this->load->view('apps/admin/frame/header',$data);
    $this->load->view('apps/admin/menu');
    $this->load->view('apps/admin/frame/footer');
  }

  public function warehouse()
  {
    $data['report'] = "Laporan Gudang";
    $this->load->view('apps/admin/frame/header',$data);
    $this->load->view('apps/admin/gudang');
    $this->load->view('apps/admin/frame/footer');
  }

  public function pegawai()
  {
    $data['report'] = "Admin";
    $this->load->view('apps/admin/frame/header',$data);
    $this->load->view('apps/admin/pegawai');
    $this->load->view('apps/admin/frame/footer');
  }

  public function report()
  {
    $data['report'] = "Laporan Order";
    $this->load->view('apps/admin/frame/header',$data);
    $this->load->view('apps/admin/report');
    $this->load->view('apps/admin/frame/footer');
  }

  /* Fetch Data */
  public function fetch_pegawai()
  {
    if ($this->input->is_ajax_request()) {
      if ($posts = $this->Admin_model->get_pegawai('pegawai')) {
        $data = array('responce' => 'success', 'posts' => $posts);
      } else {
        $data = array('responce' => 'error', 'posts' => []);
      }
      echo json_encode($data);
    } else {
      show_404();
    }
  }

  public function fetch_report()
  {
    if ($this->input->is_ajax_request()) {
      $orders = $this->Admin_model->getOrders(array('status_order' => 'selesai'));

      $formattedOrders = array();

      foreach ($orders as $order) {
        $detailOrder = $this->Admin_model->get_orders_join($order->id_order);
        $total = 0;
        foreach ($detailOrder as $detail) {
          $total += $detail->jumbel * $detail->harga_menu;
        }
        $formattedOrders[] = array(
          'responsible_person' => $order->responsible_person,
          'id_order' => $order->id_order,
          'pemesan' => $order->pemesan,
          'kd_meja' => $order->kd_meja,
          'tanggal_pesan' => $order->tanggal_pesan,
          'menu_details' => $detailOrder,
          'total' => number_format($total, 0, ',', '.')
        );
      }
      header('Content-Type: application/json');
      echo json_encode($formattedOrders);
    } else {show_404();}
  }

  public function fetch_menu()
  {
    if ($this->input->is_ajax_request()) {
      if ($posts = $this->Admin_model->get('menu')) {
        $data = array('responce' => 'success', 'posts' => $posts);
      } else {
        $data = array('responce' => 'error', 'posts' => []);
      }
      echo json_encode($data);
    } else {
      show_404();
    }
  }

  public function fetch_meja()
  {
    if ($this->input->is_ajax_request()) {
      if ($posts = $this->Admin_model->get('meja')) {
        $data = array('responce' => 'success', 'posts' => $posts);
      } else {
        $data = array('responce' => 'error', 'posts' => []);
      }
      echo json_encode($data);
    } else {
      show_404();
    }
  }

  public function fetch_warehouse()
  {
    if ($this->input->is_ajax_request()) {
      if ($posts = $this->Admin_model->get('warehouse')) {
        $data = array('responce' => 'success', 'posts' => $posts);
      } else {
        $data = array('responce' => 'error', 'posts' => []);
      }
      echo json_encode($data);
    } else {
      show_404();
    }
  }
  /* End Fetch Data */

  /* Insert Data */

  public function insert_pegawai()
  {
    if ($this->input->is_ajax_request()) {
      $this->form_validation->set_rules('username_pegawai', 'Username', 'required|is_unique[pegawai.username_pegawai]|min_length[6]');
      $this->form_validation->set_rules('password_pegawai', 'Password', 'required|min_length[6]');
      $this->form_validation->set_rules('role_pegawai', 'Role', 'required');

      if ($this->form_validation->run() == FALSE) {
        $data = array('responce' => 'error', 'message' => validation_errors());
      } else {
        $ajax_data = $this->input->post();
        $allowedPattern = '/^[a-zA-Z0-9\-.]+$/';

        if (!preg_match($allowedPattern, $ajax_data['username_pegawai'])) { 
          $data = array('responce' => 'error', 'message' => "Karakter Username yang dimasukkan tidak diperbolehkan.\n<br/>Karkater yang bisa digunakan hanya \"-\" dan \".\" saja. ");
        } else {
          $hash_password = password_hash($ajax_data['password_pegawai'], PASSWORD_DEFAULT,);
  
          $ajax_data['password_pegawai'] = $hash_password;
  
          if ($this->Admin_model->insert('pegawai', $ajax_data)) {
            $data = array('responce' => 'success', 'message' => "Berhasil Menambah Data");
          } else {
            $data = array('responce' => 'error', 'message' => "Gagal");
          }
        }
        
      }
    } else {
      show_404();
    }

    echo json_encode($data);
  }

  public function insert_menu()
  {
    if ($this->input->is_ajax_request()) {
      $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
      $this->form_validation->set_rules('harga_menu', 'Harga Menu', 'required');
      $this->form_validation->set_rules('jenis_menu', 'Jenis Menu', 'required');

      if ($this->form_validation->run() == FALSE) {
        $data = array('responce' => 'error', 'message' => validation_errors());
      } else {
        $config['upload_path'] = 'assets/images';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']     = '1024';
        // $config['max_width'] = '1024';
        // $config['max_height'] = '768';

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("gambar_menu")) {
          $data = array('responce' => "error", 'message' => $this->upload->display_errors());
        } else {
          $ajax_data = $this->input->post();
          $ajax_data['gambar_menu'] = $this->upload->data('file_name');

          if ($this->Admin_model->insert('menu', $ajax_data)) {
            $data = array('responce' => 'success', 'message' => "Berhasil Menambah Data");
          } else {
            $data = array('responce' => 'error', 'message' => "Gagal");
          }
        }
      }
    } else {
      show_404();
    }
    echo json_encode($data);
  }

  public function insert_meja()
  {
    if ($this->input->is_ajax_request()) {
      $this->form_validation->set_rules('kd_meja', 'Kode', 'required|is_unique[meja.kd_meja]');
      $this->form_validation->set_message('is_unique', 'Kode meja sudah digunakan,<br> silakan gunakan kode lain.');

      if ($this->form_validation->run() == FALSE) {
        $data = array('responce' => 'error', 'message' => validation_errors());
      } else {
        $ajax_data = $this->input->post();

        $kd_meja = $ajax_data['kd_meja'];
        $qr_meja = $ajax_data['qr_meja'];

        $params['data'] = $kd_meja;
        $params['size'] = 10;
        $params['savename'] = FCPATH . "assets/qr/$qr_meja";
        
        $this->ciqrcode->generate($params);

        // Tambahkan logo ke gambar QR code|Hanya tambahkan logo jika QR code berhasil dibuat
        // if (file_exists($params['savename'])) {
        //   $this->add_logo_to_qr($params['savename'], 'assets/images/systems/logo.png', $params['savename']);
        // }

        if ($this->Admin_model->insert('meja', $ajax_data)) {
          $data = array('responce' => 'success', 'message' => "Berhasil Menambah Data");
        } else {
          $data = array('responce' => 'error', 'message' => "Gagal");
        }
      }
    } else {
      show_404();
    }

    echo json_encode($data);
  }

  public function insert_warehouse()
  {
    if ($this->input->is_ajax_request()) {
      $this->form_validation->set_rules('nama_item', 'Nama', 'required');
      $this->form_validation->set_rules('jumlah_item', 'Jumlah', 'required|min_length[1]');
      $this->form_validation->set_rules('status_item', 'Kode', 'required');

      if ($this->form_validation->run() == FALSE) {
        $data = array('responce' => 'error', 'message' => validation_errors());
      } else {
        $ajax_data = $this->input->post();
        if ($this->Admin_model->insert('warehouse', $ajax_data)) {
          $data = array('responce' => 'success', 'message' => "Berhasil Menambah Data");
        } else {
          $data = array('responce' => 'error', 'message' => "Gagal");
        }
      }
    } else {
      show_404();
    }

    echo json_encode($data);
  }
  /* End Insert Data */

  /* Edit Record Data */
  public function edit_pegawai()
  {
    if ($this->input->is_ajax_request()) {
      $edit_id = $this->input->post('edit_id');
      $id = array('id_pegawai' => $edit_id);

      if($post = $this->Admin_model->getDataByID('pegawai', $id)) {
        $data = array('responce' => 'success', 'post' => $post);
      } else {
        $data = array('responce' => 'error', 'message' => 'gagal');
      }
      echo json_encode($data);
    } else {
      show_404();
    }
  }

  public function edit_menu()
  {
    if ($this->input->is_ajax_request()) {
      $edit_id = $this->input->post('edit_id');
      $id = array('id_menu' => $edit_id);

      if($post = $this->Admin_model->getDataByID('menu', $id)) {
        $data = array('responce' => 'success', 'post' => $post);
      } else {
        $data = array('responce' => 'error', 'message' => 'gagal');
      }
      echo json_encode($data);
    } else {
      show_404();
    }
  }
  /* End Edit Data */

  /* Update Data */
  public function update_pegawai()
  {
    if ($this->input->is_ajax_request()) {
      $this->form_validation->set_rules('edit_username', 'Username', 'required|min_length[6]');
      $this->form_validation->set_rules('edit_old_pass', 'Password', 'min_length[6]');
      $this->form_validation->set_rules('edit_new_pass', 'Password', 'min_length[6]');
      $this->form_validation->set_rules('edit_role', 'Role', 'required');

      if ($this->form_validation->run() == FALSE) {
        $data = array('responce' => 'error', 'message' => validation_errors());
      } else {
        $data['id_pegawai']         = $this->input->post('edit_record_id');
        $data['username_pegawai']   = $this->input->post('edit_username');
        $data['role_pegawai']       = $this->input->post('edit_role');

        $id = array('id_pegawai' => $data['id_pegawai']);
        $allowedPattern = '/^[a-zA-Z0-9\-.]+$/';

        if($this->input->post('edit_old_pass') != '' && $this->input->post('edit_new_pass') != ''){
          if (!preg_match($allowedPattern, $data['username_pegawai'])) {
            $data = array('responce' => 'error', 'message' => "Karakter Username yang dimasukkan tidak diperbolehkan.\n<br/>Karkater yang bisa digunakan hanya \"-\" dan \".\" saja. ");
          } else {
            if (password_verify($this->input->post('edit_old_pass'), $this->input->post('current_pass'))) {
              
              $password = $this->input->post('edit_new_pass');
              $hash_password = password_hash($password, PASSWORD_DEFAULT,);

              $data['password_pegawai'] = $hash_password;

              if($this->Admin_model->update('pegawai',$data, $id)) {
                $data = array('responce' => 'success', 'message' => "Berhasil Mengupdate Data");
              } else {
                $data = array('responce' => 'error', 'message' => "Gagal");
              }
            } else {
              $data = array('responce' => 'error', 'message' => "Password Lama Salah");
            }
          }

        } else {
          if($this->Admin_model->update('pegawai',$data, $id)) {
            $data = array('responce' => 'success', 'message' => "Berhasil Mengupdate Data");
          } else {
            $data = array('responce' => 'error', 'message' => "Gagal");
          }
        }
      }
    } else {
      show_404();
    }
    echo json_encode($data);
  }

  public function update_menu()
  {
    if ($this->input->is_ajax_request()) {
      $this->form_validation->set_rules('edit_nama', 'Nama Menu', 'required');
      $this->form_validation->set_rules('edit_harga', 'Harga Menu', 'required');
      $this->form_validation->set_rules('edit_jenis', 'Jenis Menu', 'required');
      $this->form_validation->set_rules('edit_status', 'Status Menu', 'required');

      if ($this->form_validation->run() == FALSE) {
        $data = array('responce' => 'error', 'message' => validation_errors());
      } else {
        $data['id_menu']      = $this->input->post('edit_record_id');
        $data['nama_menu']    = $this->input->post('edit_nama');
        $data['harga_menu']   = $this->input->post('edit_harga');
        $data['jenis_menu']   = $this->input->post('edit_jenis');
        $data['status_menu']  = $this->input->post('edit_status');

        $id = array('id_menu' => $data['id_menu']);

        if($this->Admin_model->update('menu',$data, $id)) {
          $data = array('responce' => 'success', 'message' => "Berhasil Mengupdate Data");
        } else {
          $data = array('responce' => 'error', 'message' => "Gagal");
        }
      }
    } else {
      show_404();
    }
    echo json_encode($data);
  }
  /* End Update Data */

  /* Delete Data */
  public function delete_pegawai()
  {
    if ($this->input->is_ajax_request()) {
      $del_id = $this->input->post('del_id');
      $id = array('id_pegawai' => $del_id);

      if ($this->Admin_model->delete('pegawai', $id)) {
        $data = array('responce' => 'success');
      } else {
        $data = array('responce' => 'error');
      }

      echo json_encode($data);
    } else {
      show_404();
    }
  }

  public function delete_menu()
  {
    if ($this->input->is_ajax_request()) {
      $del_id = $this->input->post('del_id');
      $id = array('id_menu' => $del_id);
      $getMenu = $this->Admin_model->getDataByID('menu',$id);

      $image_path = 'assets/images/'.$getMenu->gambar_menu;
      
      if (file_exists($image_path)) {
        unlink($image_path);
      }

      if ($this->Admin_model->delete('menu', $id)) {
        $data = array('responce' => 'success');
      } else {
        $data = array('responce' => 'error');
      }

      echo json_encode($data);
    } else {
      show_404();
    }
  }

  public function delete_meja()
  {
    if ($this->input->is_ajax_request()) {
      $del_id = $this->input->post('del_id');
      $id = array('kd_meja' => $del_id);
      $getMeja = $this->Admin_model->getDataByID('meja',$id);

      $image_path = 'assets/qr/'.$getMeja->qr_meja;
      
      if (file_exists($image_path)) {
        unlink($image_path);
      }

      if ($this->Admin_model->delete('meja', $id)) {
        $data = array('responce' => 'success');
      } else {
        $data = array('responce' => 'error');
      }

      echo json_encode($data);
    } else {
      show_404();
    }
  }
  /*End Delete Data */

  private function add_logo_to_qr($qr_path, $logo_path, $output_path)
  {
    // Dapatkan gambar QR dan logo
    $QR = imagecreatefrompng($qr_path);
    $logo = imagecreatefrompng($logo_path);

    // Setel mode gambar agar mendukung transparansi pada logo
    imagecolortransparent($logo, imagecolorallocatealpha($logo, 0, 0, 0, 127));
    imagealphablending($logo, false);
    imagesavealpha($logo, true);

    $QR_width = imagesx($QR);
    $QR_height = imagesy($QR);

    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);

    // Scale logo untuk cocok di dalam QR Code
    $logo_qr_width = $QR_width / 2;
    $scale = $logo_width / $logo_qr_width;
    $logo_qr_height = $logo_height / $scale;

    // Tempelkan logo ke gambar QR
    imagecopyresampled($QR, $logo, $QR_width / 4, $QR_height / 3.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

    // Simpan gambar QR yang telah dimodifikasi dengan logo
    imagepng($QR, $output_path);

    // Hapus gambar sementara
    imagedestroy($QR);
    imagedestroy($logo);
  }

  /* Download QR Image Data */
  public function download_qr($gambar_id)
  {
    $path = "assets/qr/" . $gambar_id;
    $filename = basename($path);

    if (file_exists($path)) {
      // Mendapatkan tipe konten gambar berdasarkan ekstensinya
      $file_extension = pathinfo($path, PATHINFO_EXTENSION);
      $content_type = 'image/' . $file_extension;

      // Mengatur header untuk download
      /* attachment */
      header("Content-Disposition: inline; filename=$filename");
      header("Content-Type: $content_type");
      header("Content-Length: " . filesize($path));

      // Membaca dan menampilkan isi file
      readfile($path);
    } else {
      echo "Image not found.";
    }
  }
}


/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */