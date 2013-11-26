<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of news_category
 *
 * @author BaseSystem Management http://bsmsite.com
 */
class Unit extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('app/unit_model');
    }
    function index() {
        $data['content'] = 'app/object/unit/unit_view';
        $data['get_unit'] = $this->unit_model->get_unit();
        $this->load->view('app/template_view', $data);
    }
     function add() {
        $data['content'] = 'app/object/unit/unit_add';
         $this->load->view('app/template_view', $data);
    }
    function save() {
        $config = array(
            array('field' => 'unit', 'label' => 'Name Unit','rules' => 'required'),
        ); 	
        $this->form_validation->set_rules($config); 
        if($this->form_validation->run() == false)
        {
            $this->add();
        }
        else {    
            $this->unit_model->save();
            $this->session->set_flashdata('message', 'Unit has been added..');
            redirect('app/unit');
        } 
    }
    function edit() {
        $data['getEdit'] = $this->product_category_model->editId();
        $data['header'] = 'admin/includes/header';
        $data['content'] = 'admin/object/product_category/product_category_edit';
         $this->load->view('admin/template_view', $data);
    }
    function editFormId() {
        $data['getEdit'] = $this->news_category_model->editFormId();
        $data['header'] = 'admin/includes/header';
        $data['content'] = 'admin/object/news_category/news_category_edit';
        $this->load->view('admin/template_admin_view', $data);
    }
    function update() {
       
            $this->product_category_model->update();
            $this->session->set_flashdata('message', 'Category has been update..');
            redirect('admin/product_category');
 
    }
    function delete() {
            $this->product_category_model->delete();
            $this->session->set_flashdata('message', 'Category has been delete..');
            redirect('admin/product_category');
    }
}

?>
