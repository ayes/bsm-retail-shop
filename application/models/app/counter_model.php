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
class Counter_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
   
    function get_all_stock() {
        $this->db->select_sum('stock');
        $q = $this->db->get('tbproducts')->result();
        foreach ($q as $total_all_stock) :
            return $total_all_stock->stock;
        endforeach;
    }
    function get_all_item() {   
            return $this->db->count_all('tbproducts');
    }
    function get_all_purchase() {   
            $this->db->select_sum('purchase_price', 'pp');
        $q = $this->db->get('tbproducts')->result();
        foreach ($q as $pp) :
            return $pp->pp;
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
