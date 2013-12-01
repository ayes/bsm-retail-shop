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
class Debit_purchase extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->user_logged_in();
        $this->load->model('app/debit_purchase_model');
    }
    function user_logged_in() 
    {
        if (($this->session->userdata('login') != TRUE) || ($this->session->userdata('panel') != 'ADMC'))
        {
                redirect('app-panel');
        }
     }
    function index() {
        $data['content'] = 'app/object/finance/debit_purchase_view';
        $data['get_debit'] = $this->debit_purchase_model->get_debit();
        $this->load->view('app/template_view', $data);
    }
    function pay() {
      
            $data['getEdit'] = $this->debit_purchase_model->editId();
        $data['content'] = 'app/object/finance/debit_purchase_pay';
        $this->load->view('app/template_view', $data);
    }
    function save() {
            $this->debit_purchase_model->save();
            $this->session->set_flashdata('message', 'Debit has been paid..');
            redirect('app/debit_purchase');
    }
}

?>
