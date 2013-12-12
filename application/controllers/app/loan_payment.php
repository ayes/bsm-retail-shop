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
class Loan_payment extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->user_logged_in();
        $this->load->model('app/loan_payment_model');
    }
    function user_logged_in() 
    {
        if (($this->session->userdata('login') != TRUE) || ($this->session->userdata('panel') != 'ADMC'))
        {
                redirect('app-panel');
        }
     }
    function index() {
        $data['content'] = 'app/object/cash/loan_payment_view';
        $data['get_loan_payment'] = $this->loan_payment_model->get_loan_payment();
        $this->load->view('app/template_view', $data);
    }
   /* function pay() {
      
            $data['getEdit'] = $this->receivables_sales_model->editId();
        $data['content'] = 'app/object/finance/receivables_sales_pay';
        $this->load->view('app/template_view', $data);
    } */
    function save() {
            $this->receivables_sales_model->save();
            $this->session->set_flashdata('message', 'Credit has been paid..');
            redirect('app/receivables_sales');
    }
     function pay() {
            $this->loan_payment_model->payment();
            $this->session->set_flashdata('message', 'Credit has been paid..');
            $nofak = $this->input->post('id');
            redirect('app/loan_payment/detail/'.$nofak);
    }
     function detail() {
      
            $data['get_loan_payment_id'] = $this->loan_payment_model->get_loan_payment_id();
            $data['get_payment_of_loan'] = $this->loan_payment_model->get_payment_of_loan();
            
        $data['content'] = 'app/object/cash/loan_payment_detail';
        $this->load->view('app/template_view', $data);
    }
}

?>
