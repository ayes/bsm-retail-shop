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
class Cash_book extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->user_logged_in();
        $this->load->model('app/cash_book_model');
    }
    function user_logged_in() 
    {
        if (($this->session->userdata('login') != TRUE) || ($this->session->userdata('panel') != 'ADMC'))
        {
                redirect('app-panel');
        }
     }
    function index() {
        $data['content'] = 'app/object/cash/cash_book_view';
        $data['get_cash_book'] = $this->cash_book_model->get_cash_book();
        $this->load->view('app/template_view', $data);
    }
    function search()
    {
         $data['content'] = 'app/object/cash/cash_book_view';
        $data['get_cash_book'] = $this->cash_book_model->search_cash();
        $this->load->view('app/template_view', $data);
    }
}

?>
