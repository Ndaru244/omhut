<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Main_model');
  }

  public function index()
  {
    $kd_meja = $this->session->userdata('kd_meja');
    if ($kd_meja) {
      redirect(base_url('main/home'));
    }else {
      $data['kodes'] = $this->Main_model->getSomeData("kd_meja", "meja");
      $this->load->view('apps/user/frame/header');
      $this->load->view('apps/user/index', $data);
      $this->load->view('apps/user/frame/footer');
    }

  }

  public function custom404()
  {
    $this->load->view('apps/error_404');
  }

  public function auth_meja(){
    if ($this->input->is_ajax_request()) {
      $this->form_validation->set_rules('kd_meja', 'Kode Meja', 'required');
      $this->form_validation->set_rules('nama_pelanggan', 'Nama', 'required');

      if ($this->form_validation->run() == FALSE) {
        $data = array('responce' => 'error', 'message' => validation_errors());
      } else {
        $ajax_data = $this->input->post();

        $meja = $this->Main_model->auth_pelanggan($ajax_data['kd_meja'], $ajax_data['nama_pelanggan']);
        if ($meja) {
          $data = array('responce' => 'success', 'message' => "Berhasil Login", 'kd_meja' => $meja['kd_meja'],'nama_pelanggan' => $ajax_data['nama_pelanggan']);
        } else {
          $data = array('responce' => 'error', 'message' => "kode meja salah!"); 
        }
      }
      echo json_encode($data);
    } else {
      show_404();
    }
  }
  
  public function ganti_meja() {
    // $cart = $this->session->userdata('cart') ?? [];
    $this->session->unset_userdata('kd_meja');
    $this->session->unset_userdata('nama_pelanggan');
    // $this->session->unset_userdata('cart', $cart);
    redirect(base_url(''));
  }

  public function home() {
    $kd_meja = $this->session->userdata('kd_meja');
    if ($kd_meja) {
      $this->load->view('apps/user/frame/header');
      $this->load->view('apps/user/home');
      $this->load->view('apps/user/frame/footer');
    } else {
      redirect(base_url(''));
    }
  }

  public function menu_makanan() {
    $kd_meja = $this->session->userdata('kd_meja');
    if ($kd_meja) {
      $foods = $this->Main_model->get_food();
      $data['foods'] = $foods;
      $this->load->view('apps/user/frame/header');
      $this->load->view('apps/user/page_makanan',$data);
      $this->load->view('apps/user/frame/footer');
    } else {
      redirect(base_url(''));
    }
  }

  public function menu_minuman() {
    $kd_meja = $this->session->userdata('kd_meja');
    if ($kd_meja) {
      $drinks = $this->Main_model->get_drinks();
      $data['drinks'] = $drinks;
      $this->load->view('apps/user/frame/header');
      $this->load->view('apps/user/page_minuman',$data);
      $this->load->view('apps/user/frame/footer');
    } else {
      redirect(base_url(''));
    }
  }
  // Fungsi untuk mencari index item dalam keranjang berdasarkan menuId
  private function findCartItemIndex($cart, $menuId) {
    foreach ($cart as $index => $item) {
        if ($item['menuId'] == $menuId) {
            return $index;
        }
    }
    return false;
  }
  
  public function add_to_cart() {
    if (!$this->input->is_ajax_request()) {
      show_404();  // Atau redirect ke halaman lain, sesuai kebutuhan
      return;
    }
  
    $menuId = $this->input->post('menuId');
    $jumbel = $this->input->post('jumbel');

    $cart = $this->session->userdata('cart') ?? [];

    $index = $this->findCartItemIndex($cart, $menuId);

    if ($index !== false) {
      // Jika sudah ada, update quantity
      $cart[$index]['jumbel'] += $jumbel;
    } else {
      // Jika belum ada, tambahkan ke keranjang
      $cartItem = [
        'menuId' => $menuId,
        'jumbel' => $jumbel
      ];
      $cart[] = $cartItem;
    }
    // $this->session->unset_userdata('cart', $cart);
    $this->session->set_userdata('cart', $cart);
    // Kirim respon ke klien
    echo 'success';
  }

  public function update_cart() {
    if (!$this->input->is_ajax_request()) {
      show_404();  // Atau redirect ke halaman lain, sesuai kebutuhan
      return;
    }

    $menuId = $this->input->post('menuId');
    $jumbel = $this->input->post('jumbel');

    $cart = $this->session->userdata('cart') ?? [];

    $index = $this->findCartItemIndex($cart, $menuId);

    if ($index !== false) {
      $cart[$index]['jumbel'] = $jumbel;
      // Pastikan quantity tidak kurang dari 1
      if ($cart[$index]['jumbel'] < 1) {
        $cart[$index]['jumbel'] = 1;
      }

      echo 'success';
    } else {
      echo 'not_found';
    }
    $this->session->set_userdata('cart', $cart);
  }

  public function remove_from_cart() {
    if (!$this->input->is_ajax_request()) {
      show_404();  // Atau redirect ke halaman lain, sesuai kebutuhan
      return;
    }
    $menuId = $this->input->post('menuId');

    $cart = $this->session->userdata('cart') ?? [];
    // Cari apakah menuId sudah ada dalam keranjang
    $index = $this->findCartItemIndex($cart, $menuId);

    if ($index !== false) {
      // Jika sudah ada, hapus item dari keranjang
      array_splice($cart, $index, 1);
      $this->session->set_userdata('cart', $cart);
      echo 'success';
    } else {
      // Jika tidak ditemukan, beri respon bahwa item tidak ada dalam keranjang
      echo 'not_found';
    }


  }
  
  public function keranjang() {
    $kd_meja = $this->session->userdata('kd_meja');
    if ($kd_meja) {
      $this->load->view('apps/user/frame/header');
      $this->load->view('apps/user/page_keranjang');
      $this->load->view('apps/user/frame/footer');
    } else {
      redirect(base_url(''));
    }
  }

  public function confirm_order() {
    if ($this->input->is_ajax_request()) {
      // Ambil data pesanan dari session
      $cart = $this->session->userdata('cart') ?? [];

      if (!empty($cart)) {
        $nomorAcak = random_int(1000, 9999);
        $year = date('y');

        $order_id = intval($year.$nomorAcak);

        $orderData = array(
          'id_order'           => $order_id,
          'pemesan'            => $this->session->userdata('nama_pelanggan'),
          'kd_meja'            => $this->session->userdata('kd_meja'),
          'responsible_person' =>'',
          'status_order'       => 'belum bayar'
        );
        foreach ($cart as $data) :
          $dataDetail = array(
            'id_order' => $order_id,
            'id_menu' => $data['menuId'],
            'jumbel' => $data['jumbel'],
            'status_detail' => 'menunggu pembayaran',
            'head_chef' => '',
            'delivery_person' => ''
          );
          $this->Main_model->addDetailOrder($dataDetail);
        endforeach;
        
        $this->Main_model->addOrders($orderData);

        $this->session->unset_userdata('cart');

        echo 'success';
      } else {
        echo 'error';
      }
    } else {
      show_404();
    }
  }

  public function fetch_orders() {
    if ($this->input->is_ajax_request()) {
      $kd_meja = $this->session->userdata('kd_meja');
      $total = 0;
      $result = array();

      $orders = $this->Main_model->getOrders($kd_meja);
      foreach ($orders as $data) {
        if ($data->status_order != 'selesai' && $data->status_order != 'dibatalkan') {
          $order_detail = $this->Main_model->get_orders_join($data->id_order);
          $order_total = 0;
          $order_items = array();
          foreach ($order_detail as $data_detail) {
            $total_detail = $data_detail->jumbel * $data_detail->harga_menu;
            $order_total += $total_detail;
            $order_items[] = array(
              'nama_menu' => $data_detail->nama_menu,
              'jumbel' => $data_detail->jumbel,
              'harga_menu' => $data_detail->harga_menu,
              'status_detail' => $data_detail->status_detail
            );
          }
          $total += $order_total;
          $result[] = array(
            'id_order' => $data->id_order,
            'status_order' => $data->status_order,
            'order_items' => $order_items,
            'order_total' => $order_total,
            'pemesan' => $data->pemesan,
            'is_user_order' => ($data->pemesan != $this->session->userdata('nama_pelanggan'))
          );
        }
      }
      echo json_encode(array('orders' => $result, 'total' => $total));
    } else {
      show_404();
    }
  }

  public function finish_orders($id_order) {
    if ($this->input->is_ajax_request()) {
      $dataOrders = array(
        'status_order' => 'selesai'
      );

      $this->Main_model->update('orders',$dataOrders, array('id_order'=>$id_order));

      header('Content-Type: application/json');
      echo json_encode(array('responce' => 'success', 'message' => 'Pesanan selesai.'));
    } else { show_404(); }
  }

  public function test() {
    $this->load->view('test');
  }

}


/* End of file Main.php */
/* Location: ./application/controllers/Main.php */