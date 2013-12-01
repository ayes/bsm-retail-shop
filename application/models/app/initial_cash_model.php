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
class Initial_cash_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function get_initial_cash() {
        $this->db->where('id', 1);
            return $this->db->get('tbcash_book');
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
         $data = array(
            'balance' => $this->input->post('initial_cash'),
            'incoming' => $this->input->post('initial_cash')
        );
        $this->db->where('id', 1);
        $this->db->update('tbcash_book', $data);
    }
    function delete() {
        $this->db->where('id', $this->uri->segment(4));
        $this->db->delete('tbproduct_category');
    }
}

?>
