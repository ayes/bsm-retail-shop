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
class Unit_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function get_unit() {
        $config['base_url'] = site_url('admin/unit/index');
	$config['total_rows'] = $this->db->count_all('tbunit');
        $config['per_page'] = 15;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $this->db->order_by('unit', 'asc');
        $query = $this->db->get('tbunit',$config['per_page'],$this->uri->segment(4));
        return $query;
    }
    function count_product_unit($id) {
            $this->db->where('unit_id', $id);
            $this->db->from('tbproducts');
            return $this->db->count_all_results();
        }
    function save() {
        $data = array(
            'unit' => $this->input->post('unit')
        );
        $this->db->insert('tbunit', $data);
    }
    function editId() {
        $this->db->where('id', $this->uri->segment(4));
        return $this->db->get('tbproduct_category');
    }
    function editFormId() {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        return $this->db->get('tbnews_category');
    }
    function update() {
        $id = $this->input->post('id');
         $data = array(
            'category' => $this->input->post('category')
        );
        $this->db->where('id', $id);
        $this->db->update('tbproduct_category', $data);
    }
    function delete() {
        $this->db->where('id', $this->uri->segment(4));
        $this->db->delete('tbproduct_category');
    }
}

?>
