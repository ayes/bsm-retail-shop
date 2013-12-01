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
class Cash_outgoing extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->user_logged_in();
        $this->load->model('app/cash_outgoing_model');
    }
    function user_logged_in() 
    {
        if (($this->session->userdata('login') != TRUE) || ($this->session->userdata('panel') != 'ADMC'))
        {
                redirect('app-panel');
        }
     }
    function index() {
        $data['content'] = 'app/object/cash/cash_outgoing_view';
        $data['get_cash_outgoing'] = $this->cash_outgoing_model->get_cash_outgoing();
        $this->load->view('app/template_view', $data);
    }
    
    function save() {
           
            $this->cash_outgoing_model->save();
            $this->session->set_flashdata('message', 'Cash outgoing has been saved..');
            redirect('app/cash_outgoing');

 
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
    function add() {
        $data['getEdit'] = $this->added_stock_model->editId();
        $data['content'] = 'app/object/stock/added_stock_add';
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
            redirect('app/products');

    }
    /* function delete() {
            $this->products_model->delete();
            $this->session->set_flashdata('message', 'Product has been delete..');
            redirect('admin/products');
    } */
    function search() {
        $data['content'] = 'app/object/purchase/purchase_view';
        $data['get_purchase'] = $this->purchase_model->getSearchProduct();
        $this->load->view('app/template_view', $data);
    }
}

?>
