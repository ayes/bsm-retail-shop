<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of news_model
 *
 * @author BaseSystem Management http://bsmsite.com
 */
class Loan_payment_model extends CI_Model {

    function __construct() {
        parent::__construct();
         $this->load->helper('mydate');
    }
   
    function get_loan_payment() {
        $config['base_url'] = site_url('app/loan_payment/index');
        $this->db->where('status', 0);
	$config['total_rows'] = $this->db->count_all('tbloan');
        $config['per_page'] = 30;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $this->db->select('*');
        $this->db->from('tbloan');
        $this->db->where('status', 0);
        $this->db->limit(30, $this->uri->segment(4));
        $this->db->order_by('date asc, id desc');
        $query = $this->db->get();
        return $query;
    }
    
    function get_loan_payment_id() {
        $this->db->where('id', $this->uri->segment(4));
        return $this->db->get('tbloan');
    }
   
   function get_payment_of_loan() {
        $this->db->where('loan_id', $this->uri->segment(4));
        return $this->db->get('tbpembayaran_dana_pinjaman');
    }
   function editId() {
        $this->db->where('id', $this->uri->segment(4));
        return $this->db->get('tbselling');
    }
    function save() {
        $id = $this->input->post('id');
        $code = $this->input->post('code');
        $qty = $this->input->post('qty');
        $discount = $this->input->post('discount');
        $status = $this->input->post('status');
           $selling_price = $this->input->post('selling_price');
             
        
             $incoming = ($qty * $selling_price) - $discount;
             $last_cash = $this->_get_last_cash();
             $data = array(
                    'date' => con2mysql($this->input->post('date')),
                    'cash_code' => 'IN',
                    'description' => 'RECEIVABLES SALES',
                    'description_code' => $id,
                    'incoming' => $incoming,
                    'balance' => $last_cash - $incoming 
                ); 
             $this->db->insert('tbcash_book',$data);
              $data = array( 
                    'status' => 0  
                ); 
             $this->db->where('id', $id);
        $this->db->update('tbselling', $data);
    }
    function payment() {
        $loan_id = $this->input->post('id');
        $sisa = $this->input->post('sisa');
        $dibayar = $this->input->post('dibayar');
             $data = array(
                    'date' => con2mysql($this->input->post('date')),
                    'loan_id' => $loan_id,
                    'dibayar' => $dibayar,
                    'description' => $this->input->post('description')
                ); 
             $this->db->insert('tbpembayaran_dana_pinjaman',$data);
        
             $outgoing = $dibayar;
             $last_cash = $this->_get_last_cash();
             $data = array(
                    'date' => con2mysql($this->input->post('date')),
                    'cash_code' => 'LOAN-OUT',
                    'description' => $this->input->post('description'),
                    'description_code' => $loan_id,
                    'outgoing' => $outgoing,
                    'balance' => $last_cash - $outgoing 
                ); 
             $this->db->insert('tbcash_book',$data);
              $data = array( 
                    'residual' => $sisa - $dibayar
                ); 
             $this->db->where('id', $loan_id);
        $this->db->update('tbloan', $data);
    }
    private function _get_last_cash()
    {
        $this->db->select('sum(incoming) - sum(outgoing) as lb');
        $this->db->from('tbcash_book');
        $q = $this->db->get();
        foreach ($q->result() as $incoming) :
            return $incoming->lb;
        endforeach;
        
    }
    private function _get_last_stock($code)
    {
        $this->db->where('id', $code);
        $q = $this->db->get('tbproducts');
        foreach ($q->result() as $sp) :
            return $sp->stock;
        endforeach;
        
    }
    
    
}

?>
