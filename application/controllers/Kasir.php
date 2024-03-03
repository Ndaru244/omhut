<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
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

      if($user['role_pegawai'] != "kasir") {
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
      $data['report'] = "Kasir";
      $this->load->view('apps/pegawai/frame/header',$data);
      $this->load->view('apps/pegawai/kasir',$data);
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
    $this->load->view('apps/pegawai/kasir_reports',$data);
    $this->load->view('apps/pegawai/frame/footer');
  }

  public function fetch_report()
  {
    if ($this->input->is_ajax_request()) {
      $user_id = $this->session->userdata('user_id');
      $user = $this->Admin_model->get_pegawai_by_id($user_id);

      $orders = $this->Admin_model->getOrders(array('status_order' => 'selesai'));

      $formattedOrders = array();
      foreach ($orders as $order) {
        $detailOrder = $this->Admin_model->get_orders_join($order->id_order);
        $total = 0;

        foreach ($detailOrder as $detail) {
          $total += $detail->jumbel * $detail->harga_menu;
        }
        if($order->responsible_person === $user['username_pegawai']) {
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
      $orders = $this->Admin_model->getOrders(array('status_order' => 'belum bayar'));

      $formattedOrders = array();
      foreach ($orders as $order) {
        $detailOrder = $this->Admin_model->get_orders_join($order->id_order);
        $total = 0;

        foreach ($detailOrder as $detail) {
          $total += $detail->jumbel * $detail->harga_menu;
        }

        $formattedOrders[] = array(
          'id_order' => $order->id_order,
          'pemesan' => $order->pemesan,
          'kd_meja' => $order->kd_meja,
          'menu_details' => $detailOrder,
          'total' => number_format($total, 0, ',', '.')
        );
      }
      header('Content-Type: application/json');
      echo json_encode($formattedOrders);
    } else {
      show_404();
    }
  }

  public function fetch_delivery()
  {
    if ($this->input->is_ajax_request()) {
      $dataDelvery = $this->Admin_model->get_delivery('diantar');

      $formattedOrders = array();

      foreach ($dataDelvery as $data) {
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
            );
          }
        }
      }

      header('Content-Type: application/json');
      echo json_encode($formattedOrders);
    } else {
      show_404();
    }
  }

  public function confirm_order($id_order) 
  {
    if ($this->input->is_ajax_request()) {
      $user_id = $this->session->userdata('user_id');
      $user = $this->Admin_model->get_pegawai_by_id($user_id);

      $dataOrders = array(
        'status_order' => 'sudah bayar',
        'responsible_person' => $user['username_pegawai']
      );

      $detailOrder = $this->Admin_model->get_orders_join($id_order);

      foreach ($detailOrder as $detail) {
        $id = $detail->detail_id;
        $dataDetail = array(
          'status_detail' => 'menunggu dibuat',
        );
        $this->Admin_model->update('detail_order',$dataDetail, array('detail_id'=>$id));
      }
      $this->Admin_model->update('orders',$dataOrders, array('id_order'=>$id_order));

      header('Content-Type: application/json');
      echo json_encode(array('responce' => 'success', 'message' => 'Order berhasil dikonfirmasi.'));
    } else {
      show_404();
    }
  }

  public function cencel_order($id_order) 
  {
    if ($this->input->is_ajax_request()) {
      $user_id = $this->session->userdata('user_id');
      $user = $this->Admin_model->get_pegawai_by_id($user_id);

      $dataOrders = array(
        'status_order' => 'dibatalkan',
        'responsible_person' => $user['username_pegawai']
      );

      $detailOrder = $this->Admin_model->get_orders_join($id_order);

      foreach ($detailOrder as $detail) {
        $id = $detail->detail_id;
        $dataDetail = array(
          'status_detail' => 'dibatalkan',
        );
        $this->Admin_model->update('detail_order',$dataDetail, array('detail_id'=>$id));
      }
      $this->Admin_model->update('orders',$dataOrders, array('id_order'=>$id_order));

      header('Content-Type: application/json');
      echo json_encode(array('responce' => 'success', 'message' => 'Order berhasil dibatalkan.'));
    } else {
      show_404();
    }
  }

  public function confirm_delivery($id_delivery)
  {
    if ($this->input->is_ajax_request()) {
      $user_id = $this->session->userdata('user_id');
      $user = $this->Admin_model->get_pegawai_by_id($user_id);

      $dataDelivery = array(
        'status_detail' => 'selesai',
        'delivery_person' => $user['username_pegawai']
      );

      $this->Admin_model->update('detail_order',$dataDelivery, array('detail_id'=>$id_delivery));

      header('Content-Type: application/json');
      echo json_encode(array('responce' => 'success', 'message' => 'Pesanan selesai.'));
    } else { show_404(); }
  } 

}


/* End of file Kasir.php */
/* Location: ./application/controllers/Kasir.php */