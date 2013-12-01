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
class Return_purchase extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->user_logged_in();
        $this->load->model('app/return_purchase_model');
    }
    function user_logged_in() 
    {
        if (($this->session->userdata('login') != TRUE) || ($this->session->userdata('panel') != 'ADMC'))
        {
                redirect('app-panel');
        }
     }
    function index() {
        $data['content'] = 'app/object/return/return_purchase_view';
        $data['get_return_purchase'] = $this->return_purchase_model->get_return_purchase();
        $this->load->view('app/template_view', $data);
    }
    function returned() {
      
            $data['getEdit'] = $this->return_purchase_model->editId();
        $data['content'] = 'app/object/return/return_purchase_returned';
        $this->load->view('app/template_view', $data);
    }
    function save() {
            $this->return_purchase_model->save();
            $this->session->set_flashdata('message', 'Purchase has been return..');
            redirect('app/return_purchase');
    }
}

?>
