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
class Return_selling_model extends CI_Model {

    function __construct() {
        parent::__construct();
         $this->load->helper('mydate');
    }
   
    function get_return_selling() {
        $config['base_url'] = site_url('app/return_selling/index');
	$config['total_rows'] = $this->db->count_all('tbselling');
        $config['per_page'] = 30;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $this->db->select('*');
        $this->db->from('tbselling');
        $this->db->limit(30, $this->uri->segment(4));
        $this->db->order_by('date asc, id desc');
        $query = $this->db->get();
        return $query;
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
        $selling_price = $this->input->post('selling_price');
        $status = $this->input->post('status');
            $data = array(
                    'date' => con2mysql($this->input->post('date')),
                    'product_id' => $code,
                    'name' => $this->input->post('name'),
                    'purchase_price' => $this->input->post('purchase_price'),
                    'selling_price' => $selling_price,
                    'qty' => $qty,
                    'discount' => $discount,
                    'status' => $status,
                    'description' => $this->input->post('description')
                ); 
            $this->db->insert('tbreturn_selling',$data);
             $insert = $this->db->insert_id();
             $last_stock = $this->_get_last_stock($code);
             $balance = $last_stock + $qty;
             $data = array(
                    'date' => con2mysql($this->input->post('date')),
                    'product_id' => $code,
                    'description' => 'RETURN SALE',
                    'description_code' => $insert,
                    'stock_entry' => $qty,
                    'balance' => $balance  
                ); 
             $this->db->insert('tbstock_card',$data);
             $data = array(
                   'stock' => $balance,
                );
        $this->db->where('id', $code);
        $this->db->update('tbproducts', $data);
         if ($status == 0) :
             $outgoing = ($qty * $selling_price) - $discount;
             $last_cash = $this->_get_last_cash();
             $data = array(
                    'date' => con2mysql($this->input->post('date')),
                    'cash_code' => 'OUT',
                    'description' => 'RETURN SALE',
                    'description_code' => $insert,
                    'outgoing' => $outgoing,
                    'balance' => $last_cash - $outgoing  
                ); 
             $this->db->insert('tbcash_book',$data);
          endif;   
             $this->db->where('id', $id);
        $this->db->delete('tbselling');
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
