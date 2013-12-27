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
class Counter extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->user_logged_in();
        $this->load->model('app/counter_model');
    }
    function user_logged_in() 
    {
        if (($this->session->userdata('login') != TRUE) || ($this->session->userdata('panel') != 'ADMC'))
        {
                redirect('app-panel');
        }
     }
    function index() {
        $data['content'] = 'app/object/stock/counter_view';
        $data['get_all_stock'] = $this->counter_model->get_all_stock();
        $data['get_all_item'] = $this->counter_model->get_all_item();
        $data['get_all_purchase_selling'] = $this->counter_model->get_all_purchase_selling();
        //$data['get_all_selling'] = $this->counter_model->get_all_selling();
        $this->load->view('app/template_view', $data);
    }
}

?>
