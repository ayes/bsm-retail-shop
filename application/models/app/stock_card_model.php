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
class Stock_card_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
   
    function get_stock_card() {
        $config['base_url'] = site_url('app/stock_card/index');
	$config['total_rows'] = $this->db->count_all('tbstock_card');
        $config['per_page'] = 30;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $this->db->select('date, product_id, description_code, description, stock_entry, stock_out, balance');
        $this->db->from('tbstock_card');
        $this->db->limit(30, $this->uri->segment(4));
        $this->db->order_by('product_id asc, date asc, id asc');
        $this->db->group_by('date, product_id, description_code, description');
        $query = $this->db->get();
        return $query;
    }
    
    function get_initial_stock($product_id) {   
            $this->db->select_sum('initial_stock', 'masuk');
            $this->db->where('product_id', $product_id);
        $q = $this->db->get('tbstock_card')->result();
        foreach ($q as $istock) :
            return $istock->masuk;
        endforeach;
    }
    function get_initial_stock2($product_id) {   
            $this->db->select_sum('stock_out', 'keluar');
            $this->db->where('product_id', $product_id);
        $q = $this->db->get('tbstock_card')->result();
        foreach ($q as $istock) :
            return $istock->keluar;
        endforeach;
    }
    function get_all_selling() {   
            $this->db->select_sum('selling_price', 'sp');
        $q = $this->db->get('tbproducts')->result();
        foreach ($q as $sp) :
            return $sp->sp;
        endforeach;
    }
   
    function get_unit() 
    {
        $this->db->order_by('unit', 'asc');
        return $this->db->get('tbunit');
    }
    
}

?>
