<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kitchen extends CI_Controller
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

      if($user['role_pegawai'] != "kitchen") {
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
      $data['report'] = "Kitchen";
      $this->load->view('apps/pegawai/frame/header',$data);
      $this->load->view('apps/pegawai/kitchen',$data);
      $this->load->view('apps/pegawai/frame/footer');
    }
  }

  public function report()
  {
    $user_id = $this->session->userdata('user_id');
    $user = $this->Admin_model->get_pegawai_by_id($user_id);
    $data['user'] = $user;
    $data['report'] = "Laporan";
    $this->load->view('apps/pegawai/frame/header',$data);
    $this->load->view('apps/pegawai/kitchen_reports',$data);
    $this->load->view('apps/pegawai/frame/footer');
  }

  public function fetch_report()
  {
    if ($this->input->is_ajax_request()) {
      $detailOrder = $this->Admin_model->get_orders_chef('makanan');

      $formattedOrders = array();
      foreach ($detailOrder as $data) {
        if ($data->status_detail === 'selesai') {
          $dataOrders = $this->Admin_model->getOrders(array('status_order' => 'selesai'));

          foreach ($dataOrders as $order) {
            if ($data->id_order === $order->id_order) {
              $formattedOrders[] = array(
                'id_order' => $data->id_order,
                'kd_meja' => $order->kd_meja,
                'pemesan' => $order->pemesan,
                'nama_menu' => $data->nama_menu,
                'jumbel' => $data->jumbel,
                'delivery_person' => $data->delivery_person,
                'tanggal_pesan' => $order->tanggal_pesan,
              );
            }
          }
        }
      }
      header('Content-Type: application/json');
      echo json_encode($formattedOrders);
    } else {
      show_404();
    }
  }

  public function fetch_orders()
  {
    if ($this->input->is_ajax_request()) {
      $detailOrder = $this->Admin_model->get_orders_chef('makanan');

      $formattedOrders = array();
      foreach ($detailOrder as $data) {
        if ($data->status_detail === 'menunggu dibuat' || $data->status_detail === 'sedang dibuat') {
          $dataOrders = $this->Admin_model->getOrders(array('status_order' => 'sudah bayar'));

          foreach ($dataOrders as $order) {
            if ($data->id_order === $order->id_order) {
              $formattedOrders[] = array(
                'id_order' => $data->id_order,
                'detail_id' => $data->detail_id,
                'kd_meja' => $order->kd_meja,
                'pemesan' => $order->pemesan,
                'nama_menu' => $data->nama_menu,
                'jumbel' => $data->jumbel,
                'status_detail' => $data->status_detail,
              );
            }
          }
        }
      }
      
      header('Content-Type: application/json');
      echo json_encode($formattedOrders);
    } else {
      show_404();
    }
  }

  public function confirm_order($detail_id)
  {
    if ($this->input->is_ajax_request()) {
      $user_id = $this->session->userdata('user_id');
      $user = $this->Admin_model->get_pegawai_by_id($user_id);

      $dataDetail = array(
        'status_detail' => 'sedang dibuat',
        'head_chef' => $user['username_pegawai']
      );

      $this->Admin_model->update('detail_order',$dataDetail, array('detail_id'=>$detail_id));

      header('Content-Type: application/json');
      echo json_encode(array('responce' => 'success', 'message' => 'Pesanan berhasil dikonfirmasi.'));
    } else { show_404(); }
  }

  public function finish_order($detail_id)
  {
    if ($this->input->is_ajax_request()) {
      $user_id = $this->session->userdata('user_id');
      $user = $this->Admin_model->get_pegawai_by_id($user_id);

      $dataDetail = array(
        'status_detail' => 'diantar',
        'head_chef' => $user['username_pegawai']
      );

      $this->Admin_model->update('detail_order',$dataDetail, array('detail_id'=>$detail_id));

      header('Content-Type: application/json');
      echo json_encode(array('responce' => 'success', 'message' => 'Pesanan sudah dibuat.'));
    } else {show_404();}
  }
}


/* End of file Kitchen.php */
/* Location: ./application/controllers/Kitchen.php */