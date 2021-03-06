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
class Receivables_sales extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->user_logged_in();
        $this->load->model('app/receivables_sales_model');
    }
    function user_logged_in() 
    {
        if (($this->session->userdata('login') != TRUE) || ($this->session->userdata('panel') != 'ADMC'))
        {
                redirect('app-panel');
        }
     }
    function index() {
        $data['content'] = 'app/object/finance/receivables_sales_view';
        $data['get_debit'] = $this->receivables_sales_model->get_debit();
        $this->load->view('app/template_view', $data);
    }
    function pay() {
      
            $data['getEdit'] = $this->receivables_sales_model->editId();
        $data['content'] = 'app/object/finance/receivables_sales_pay';
        $this->load->view('app/template_view', $data);
    }
    function save() {
            $this->receivables_sales_model->save();
            $this->session->set_flashdata('message', 'Credit has been paid..');
            redirect('app/receivables_sales');
    }
     function payment() {
            $this->receivables_sales_model->payment();
            $this->session->set_flashdata('message', 'Credit has been paid..');
            $nofak = $this->input->post('no_faktur');
            redirect('app/receivables_sales/detail/'.$nofak);
    }
     function detail() {
      
            $data['get_return_detail_index'] = $this->receivables_sales_model->get_return_detail_index();
            $data['get_return_detail_content'] = $this->receivables_sales_model->get_return_detail_content();
            $data['get_pembayaran_piutang_penjualan'] = $this->receivables_sales_model->get_pembayaran_piutang_penjualan();
        $data['content'] = 'app/object/finance/receivables_sales_detail';
        $this->load->view('app/template_view', $data);
    }
}

?>
