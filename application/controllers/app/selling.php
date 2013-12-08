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
class Selling extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->user_logged_in();
        $this->load->model('app/selling_model');
    }
    function user_logged_in() 
    {
        if (($this->session->userdata('login') != TRUE) || ($this->session->userdata('panel') != 'ADMC'))
        {
                redirect('app-panel');
        }
     }
    function index() {
        $data['content'] = 'app/object/selling/selling_view';
        $data['get_selling'] = $this->selling_model->get_selling();
        $this->load->view('app/template_view', $data);
    }
    function saleX() {
        $data['content'] = 'app/object/selling/selling_sale';
        $this->load->view('app/template_view', $data);
    }
    function save() {
           
            $this->selling_model->save();
            $this->session->set_flashdata('message', 'Selling has been added..');
            redirect('app/selling/selling_form/0');

 
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
    function sale() {
        $data['getEdit'] = $this->selling_model->editId();
        $data['content'] = 'app/object/selling/selling_sale';
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
        $data['content'] = 'app/object/selling/selling_view';
        $data['get_selling'] = $this->selling_model->getSearchProduct();
        $this->load->view('app/template_view', $data);
    }
     function selling_form() {
        $data['getEdit'] = $this->selling_model->editId();
        $data['get_selling_temp'] = $this->selling_model->get_selling_temp();
        $data['content'] = 'app/object/selling/selling_form';
        $this->load->view('app/template_view', $data);
    }
    function delete_temp() {
            $this->selling_model->delete_temp();
            $this->session->set_flashdata('message', 'selling has been delete..');
            redirect('app/selling/selling_form/0');
    } 
    function save_fix() {
           
            $this->selling_model->save_fix();
            $this->session->set_flashdata('message', 'Selling has been added..');
            redirect('app/selling/selling_form/0');

 
    }
}

?>
