<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Admin_model');

    if (!$this->session->userdata('user_id')) {
      // Jika belum login, alihkan ke halaman login
      // redirect(base_url('auth/logout'));
    }
  }

  public function index()
  {
    $user_id = $this->session->userdata('user_id');
    if (!$user_id) {
      $this->load->view('apps/admin/login');
    } else {
      redirect(base_url('auth'));
    }
  }

  public function auth(){
    if ($this->input->is_ajax_request()) {
      $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]');
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

      if ($this->form_validation->run() == FALSE) {
        $data = array('responce' => 'error', 'message' => validation_errors());
      }  else {
        $ajax_data = $this->input->post();
        $allowedPattern = '/^[a-zA-Z0-9\-.]+$/';

        if (!preg_match($allowedPattern, $ajax_data['username'])) { 
          $data = array('responce' => 'error', 'message' => "Karakter Username yang dimasukkan tidak diperbolehkan.\n<br/>Karkater yang bisa digunakan hanya \"-\" dan \".\" saja. ");
        } else {
          $user = $this->Admin_model->auth($ajax_data['username'],$ajax_data['password']);
          if ($user) {
            $data = array('responce' => 'success', 'message' => "Berhasil Login", 'role' => $user['role_pegawai']);
          } else {
            $data = array('responce' => 'error', 'message' => "Username Atau Password Salah!");
          }
        }
        echo json_encode($data);
      }
    } else {
      show_404();
    }
    
  }

  public function logout() {
    $this->session->unset_userdata('user_id');
    redirect(base_url('auth'));
  }

}


/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */