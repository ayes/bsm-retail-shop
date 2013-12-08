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
class Added_stock_model extends CI_Model {
    var $product_path;
    function __construct() {
        parent::__construct();
        $this->load->helper('mydate');
        $this->product_path = realpath(APPPATH . '../fx-archive/images_product');
    }
    function get_added_stock() {
        $config['base_url'] = site_url('app/added_stock/index');
	$config['total_rows'] = $this->db->count_all('tbproducts');
        $config['per_page'] = 30;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $this->db->select('*, tp.id as idcode');
        $this->db->from('tbproducts as tp');
        $this->db->join('tbunit as tu', 'tu.id = tp.unit_id');
        $this->db->limit(30, $this->uri->segment(4));
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        return $query;
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
    function getProductCategory() {
        $this->db->order_by('category', 'asc');
        return $this->db->get('tbproduct_category');
    }
    function get_unit() 
    {
        $this->db->order_by('unit', 'asc');
        return $this->db->get('tbunit');
    }
    function code_cek($code)
	{
		
		$this->db->where('id', $code);
                $query = $this->db->get('tbproducts');
		if($query->num_rows() != 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
    function save() {
        $code = $this->input->post('code');
        $qty = $this->input->post('qty');
        $cost = $this->input->post('cost');
        $status = $this->input->post('status');
            $data = array(
                    'date' => con2mysql($this->input->post('date')),
                    'product_id' => $code,
                    'name' => $this->input->post('name'),
                    'cost' => $cost,
                    'qty' => $qty,
                    'status' => $status,
                    'description' => $this->input->post('description'),    
                ); 
            $this->db->insert('tbadded_stock',$data);
             $insert = $this->db->insert_id();
             $last_stock = $this->_get_last_stock($code);
             $balance = $last_stock + $qty;
             $data = array(
                    'date' => con2mysql($this->input->post('date')),
                    'product_id' => $code,
                    'description' => 'ADD',
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
        if (($status == 0) && ($cost != 0)) :
             $outgoing = $cost;
             $last_cash = $this->_get_last_cash();
             $data = array(
                    'date' => con2mysql($this->input->post('date')),
                    'cash_code' => 'OUT',
                    'description' => 'ADD',
                    'description_code' => $insert,
                    'outgoing' => $outgoing,
                    'balance' => $last_cash - $outgoing  
                ); 
             $this->db->insert('tbcash_book',$data);
         endif;    
             
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
    function editId() {
        $this->db->where('id', $this->uri->segment(4));
        return $this->db->get('tbproducts');
    }
     //
    function editFormId() {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        return $this->db->get('tbnews');
    }
    function update() {
             
        $id = $this->input->post('id');
        $picture = $this->input->post('picture');
          $config = array(
                'allowed_types' => 'jpg|jpeg|gif|png',
                'upload_path' => $this->product_path,
                'max_size' => 2000,
                'file_name' => random_string('alnum', 30)
            );
            $this->upload->initialize($config);
            $this->upload->do_upload('userfile');
            $image_data = $this->upload->data();
            $image_file = $image_data['file_name'];
            $image_ext = $image_data['file_ext'];
           $config = array(
                'source_image' => $image_data['full_path'],
                'new_image' => $this->product_path . '/thumbs',
                'maintain_ratio' => true,
                'width' => '227px',
                'height' => '170px'
            );
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
 
        
               $data = array(
                   'stock' => $this->input->post('stock'),
                    'unit_id' => $this->input->post('unit_id'),
                    'product_category_id' => $this->input->post('product_category_id'),
                    'name' => $this->input->post('name'),
                    'purchase_price' => $this->input->post('purchase_price'),
                    'selling_price' => $this->input->post('selling_price'),
                    'description' => $this->input->post('description')
                );
             if ($image_ext != '') {
                $data['picture'] = $image_file;
                if ($picture != 'kosong.gif') {
                unlink($this->product_path.'/thumbs/'.$picture);
                }
                unlink($this->product_path.'/'.$image_file);
            }
        $this->db->where('id', $id);
        $this->db->update('tbproducts', $data);
    }
     private function _get_size($image) {
    $img = getimagesize($image);
    return Array('width'=>$img['0'], 'height'=>$img['1']);
  }
    function delete() {
        if ($this->uri->segment(5) != 'kosong.gif') {
            unlink($this->product_path.'/thumbs/'.$this->uri->segment(5));
        }
        $this->db->where('id', $this->uri->segment(4));
        $this->db->delete('tbproducts');
        
    }
    function get_search_stock() {
        $keyword = $this->input->post('keyword');
        $option = $this->input->post('option');
        
        $this->db->select('*, tp.id as idcode');
        $this->db->from('tbproducts as tp');
        $this->db->join('tbunit as tu', 'tu.id = tp.unit_id');
        $this->db->like($option,$keyword);
        $this->db->order_by('name', 'asc');
        return $this->db->get();
    }
}

?>
