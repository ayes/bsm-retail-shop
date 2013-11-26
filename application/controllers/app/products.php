<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of news
 *
 * @author BaseSystem Management http://bsmsite.com
 */
class Products extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->user_logged_in();
        $this->load->model('app/products_model');
    }
    function user_logged_in() 
    {
        if (($this->session->userdata('login') != TRUE) || ($this->session->userdata('panel') != 'ADMC'))
        {
                redirect('app-panel');
        }
     }
    function index() {
        $data['content'] = 'app/object/products/products_view';
        $data['get_all_stock'] = $this->products_model->get_all_stock();
        $data['get_all_item'] = $this->products_model->get_all_item();
        $data['get_all_purchase'] = $this->products_model->get_all_purchase();
        $data['get_all_selling'] = $this->products_model->get_all_selling();
        $data['getProducts'] = $this->products_model->getProducts();
        $this->load->view('app/template_view', $data);
    }
    function add() {
        $data['content'] = 'app/object/products/products_add';
        $data['getProductCategory'] = $this->products_model->getProductCategory();
        $data['get_unit'] = $this->products_model->get_unit();
        $this->load->view('app/template_view', $data);
    }
    function save() {
            
            $config = array(
                        array('field' => 'code', 'label' => 'Code','rules' => 'required|callback_code_cek')
                        );
            $this->form_validation->set_rules($config);
		
		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
            $this->session->set_flashdata('ses_save_category',$this->input->post('product_category_id'));
            $this->session->set_flashdata('ses_save_unit',$this->input->post('unit_id'));
            $this->products_model->save();
            $this->session->set_flashdata('message', 'Product has been added..');
            redirect('app/products/add');
                }
 
    }
    function code_cek($code)
	{
		if($this->products_model->code_cek($code) === TRUE)
		{
			$this->form_validation->set_message('code_cek','<b>%s</b> existing.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
    function edit() {
        $data['getEdit'] = $this->products_model->editId();
        $data['getProductCategory'] = $this->products_model->getProductCategory();
        $data['get_unit'] = $this->products_model->get_unit();
        $data['content'] = 'app/object/products/products_edit';
        $this->load->view('app/template_view', $data);
    }
    function editFormId() {
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
        //configure base path of ckeditor folder
        $this->ckeditor->basePath = base_url().'asset/ckeditor/';
        $this->ckeditor->config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = 700;
        //configure ckfinder with ckeditor config
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../asset/ckfinder/');
        // content
        $data['getNews'] = $this->news_model->editFormId();
        $data['header'] = 'admin/includes/header_news';
        $data['content'] = 'admin/object/news/news_edit';
        $data['getNewsCategory'] = $this->news_model->getNewsCategory();
        $this->load->view('admin/template_admin_view', $data);
    }
    function update() {
         
            $this->products_model->update();
            $this->session->set_flashdata('message', 'Product has been update..');
            redirect('admin/products');

    }
    function delete() {
            $this->products_model->delete();
            $this->session->set_flashdata('message', 'Product has been delete..');
            redirect('admin/products');
    }
    function search() {
        $data['header'] = 'admin/includes/header';
        $data['content'] = 'admin/object/products/products_view';
        $data['getProducts'] = $this->products_model->getSearchProduct();
        $this->load->view('admin/template_view', $data);
    }
}

?>
