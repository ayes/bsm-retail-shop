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
    function get_return_detail_index() {
        $this->db->where('no_faktur', $this->uri->segment(4));
        return $this->db->get('tbselling');
    }
    function get_return_detail_content() {
        $this->db->where('no_faktur', $this->uri->segment(4));
        return $this->db->get('tbselling_detail');
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
    function save_return() {
        $no_faktur = $this->uri->segment(4);
         //get data temp
                $q = $this->db->get('tbselling_detail');
            foreach ($q->result() as $r) :
             $last_stock = $this->_get_last_stock($r->product_id);
             $balance = $last_stock + $r->qty;
             $data = array(
                    'date' => date('Y-m-d'),
                    'product_id' => $r->product_id,
                    'description' => 'RETURN SALE',
                    'description_code' => $no_faktur,
                    'stock_entry' => $r->qty,
                    'balance' => $balance  
                ); 
             $this->db->insert('tbstock_card',$data);
             $data = array(
                   'stock' => $balance,
                );
        $this->db->where('id', $r->product_id);
        $this->db->update('tbproducts', $data);
        endforeach;
        $q = $this->db->get('tbselling');
            foreach ($q->result() as $r) :
                $total = $r->total;
            endforeach;
         if ($status == 0) :
             $outgoing = $total;
             $last_cash = $this->_get_last_cash();
             $data = array(
                    'date' => date('Y-m-d'),
                    'cash_code' => 'OUT',
                    'description' => 'RETURN SALE',
                    'description_code' => $no_faktur,
                    'outgoing' => $outgoing,
                    'balance' => $last_cash - $outgoing  
                ); 
             $this->db->insert('tbcash_book',$data);
          endif;   
             $this->db->where('no_faktur', $no_faktur);
        $this->db->delete('tbselling');
        $this->db->where('no_faktur', $no_faktur);
        $this->db->delete('tbselling_detail');
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
    function search_return_selling() {
        $keyword = $this->input->post('keyword');
        $option = $this->input->post('option');
        
        
        $this->db->like($option,$keyword);
        $this->db->order_by('name', 'asc');
        return $this->db->get('tbselling');
    }
    
}

?>
