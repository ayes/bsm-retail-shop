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
class Products_model extends CI_Model {
    var $product_path;
    function __construct() {
        parent::__construct();
        $this->load->helper('mydate');
        $this->product_path = realpath(APPPATH . '../fx-archive/images_product');
    }
    function getProducts() {
        $config['base_url'] = site_url('admin/products/index');
	$config['total_rows'] = $this->db->count_all('tbproduct_category');
        $config['per_page'] = 15;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $this->db->select('*, tp.id as idcode');
        $this->db->from('tbproducts as tp');
        $this->db->join('tbunit as tu', 'tu.id = tp.unit_id');
        $this->db->limit($config['per_page'], $this->uri->segment(4));
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
                    'date' => con2mysql($this->input->post('date')),
                    'product_category_id' => $this->input->post('product_category_id'),
                    'unit_id' => $this->input->post('unit_id'),
                    'id' => $this->input->post('code'),
                    'name' => $this->input->post('name'),
                    'purchase_price' => $this->input->post('purchase_price'),
                    'selling_price' => $this->input->post('selling_price'),
                    'stock' => $this->input->post('stock'),
                    'description' => $this->input->post('description')
                );
             if ($image_ext == '') {
                 $data['picture'] = 'kosong.gif';
             } else {
                $data['picture'] = $image_file;
                unlink($this->product_path.'/'.$image_file);
            }
            $this->db->insert('tbproducts',$data);
             
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
  
                    'product_category_id' => $this->input->post('product_category_id'),
                    'name' => $this->input->post('name'),
                    'price' => $this->input->post('price'),
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
    function getSearchProduct() {
        $keyword = $this->input->post('keyword');
        $option = $this->input->post('option');
        $this->db->like($option,$keyword);
        return $this->db->get('tbproducts');
    }
}

?>
