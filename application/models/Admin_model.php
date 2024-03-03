<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

  public function get($data) {
    $query = $this->db->get($data);
    if ($query->num_rows() > 0) {
      return $query->result();
    }
  }

  public function get_pegawai($data) {
    $this->db->where('role_pegawai !=', 'admin');
    $query = $this->db->get($data);
    if ($query->num_rows() > 0) {
      return $query->result();
    }
  }

  public function get_pegawai_by_id($user_id) {
    $query = $this->db->get_where('pegawai', array('id_pegawai' => $user_id));
    return $query->row_array();
  }
  
  public function getDataByID($table,$id) {
    $query = $this->db->get_where($table, $id);
    return $query->row();
  }

  public function getOrders($status){
    $this->db->order_by('tanggal_pesan', 'DESC');
    $query = $this->db->get_where('orders',$status);
    if ($query->num_rows() > 0) {
      return $query->result();
    }
    return array();
  }

  public function get_orders_join($id_order) { 
    $this->db->select('*');
    $this->db->from('detail_order');
    $this->db->join('menu', 'detail_order.id_menu = menu.id_menu');
    $this->db->where('detail_order.id_order',$id_order);
    $this->db->order_by('detail_id', 'DESC');
    
    $query = $this->db->get();
    return $query->result();
  }

  public function get_orders_chef($status) { 
    $this->db->select('*');
    $this->db->from('detail_order');
    $this->db->join('menu', 'detail_order.id_menu = menu.id_menu');
    $this->db->where('menu.jenis_menu',$status);
    $this->db->order_by('detail_id', 'DESC');
    
    $query = $this->db->get();
    return $query->result();
  }

  public function get_delivery($status) {
    $this->db->select('*');
    $this->db->from('detail_order');
    $this->db->join('menu', 'detail_order.id_menu = menu.id_menu');
    $this->db->where('detail_order.status_detail',$status);
    $this->db->order_by('detail_id', 'DESC');
    
    $query = $this->db->get();
    return $query->result();
  }

  public function insert($table,$data) {
    return $this->db->insert($table,$data);
  }

  public function delete($table,$id) {
    return $this->db->delete($table, $id);
  }

  public function update($table,$data, $id) {
    return $this->db->update($table, $data, $id);
  }

  public function auth($username, $password){
    $query = $this->db->get_where('pegawai', array('username_pegawai' => $username));
    $user = $query->row_array();

    if ($user && password_verify($password, $user['password_pegawai'])) {
      $this->session->set_userdata('user_id', $user['id_pegawai']);
      return $user;
    }
    return false;
  }
}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */