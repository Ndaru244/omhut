<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {
  
  public function auth_pelanggan($kode_meja,$nama_pelanggan){
    $query = $this->db->get_where('meja', array('kd_meja' => $kode_meja));
    $meja = $query->row_array();
    
    if ($meja) {
      $this->session->set_userdata('kd_meja', $meja['kd_meja']);
      $this->session->set_userdata('nama_pelanggan', $nama_pelanggan);
      return $meja;
    }
    return false;
  }
  
  public function getSomeData($field, $table) {
    return $this->db->select($field)->from($table)->get()->result();
  }

  public function get_drinks(){
    $this->db->where('jenis_menu', 'minuman');

    $query = $this->db->get('menu');
    if ($query->num_rows() > 0) {
      return $query->result();
    }
    return array();
  }

  public function get_food(){
    $this->db->where('jenis_menu', 'makanan');

    $query = $this->db->get('menu');
    if ($query->num_rows() > 0) {
      return $query->result();
    }
    return array();
  }

  public function getDataByID($table,$id) {
    $query = $this->db->get_where($table, $id);
    return $query->row();
  }
  public function getOrders($kd_meja){
    $query = $this->db->get_where('orders', array('kd_meja' => $kd_meja));
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
    
    $query = $this->db->get();
    return $query->result();
  }

  public function addOrders($data) {
    return $this->db->insert('orders',$data);
  }

  public function addDetailOrder($data) {
    return $this->db->insert('detail_order',$data);
  }

  public function update($table,$data, $id) {
    return $this->db->update($table, $data, $id);
  }

}

/* End of file Main_model.php */
/* Location: ./application/models/Main_model.php */