<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of news_category_model
 *
 * @author BaseSystem Management http://bsmsite.com
 */
class Tools_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
   function getShopName() {
        $this->db->where('id', 1); 
            $q = $this->db->get('tbshop_profile');
            foreach ($q->result() as $row) {
            return $row->name;
      }
        }
        function getBanners() {
        
            return $this->db->get('tbbanners');
 
        }
   function getCountCategoryProduct($id) {
      $query = $this->db->query('select count(product_category_id) as cat from tbproducts where product_category_id ='.$id);
      foreach ($query->result() as $row) {
      return $row->cat;
      }
    }
     function getRandomProductsLimit() {
        $results = $this->db->order_by('id','random')->limit(20)->get('tbproducts')->result(); 
        return $results;   
    }
    function get_name_category($product_category_id) 
    {
        $this->db->where('id', $product_category_id); 
        $q = $this->db->get('tbproduct_category');
        foreach ($q->result() as $row) {
        return $row->category;
    }
    }
     function set_ym_widget() 
    {
        $this->db->where('widget', 'ym_widget'); 
        $q = $this->db->get('tbwidget_setting');
        foreach ($q->result() as $row) 
        {
            return $row->setting;
        }
    }
    function set_contact_widget() 
    {
        $this->db->where('widget', 'contact_widget'); 
        $q = $this->db->get('tbwidget_setting');
        foreach ($q->result() as $row) 
        {
            return $row->setting;
        }
    }
    function get_last_cash()
    {
        $this->db->select('sum(incoming) - sum(outgoing) as lb');
        $this->db->from('tbcash_book');
        $q = $this->db->get();
        foreach ($q->result() as $incoming) :
            return $incoming->lb;
        endforeach;
        
    }
    function cek_no_delete_selling($idcode)
	{
		
		$this->db->where('product_id', $idcode);
                $query = $this->db->get('tbselling');
		if($query->num_rows() != 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
        function cek_no_delete_purchase($idcode)
	{
		
		$this->db->where('product_id', $idcode);
                $query = $this->db->get('tbpurchase');
		if($query->num_rows() != 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}

?>
