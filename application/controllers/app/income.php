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
class Income extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->user_logged_in();
        $this->load->model('app/income_model');
    }
    function user_logged_in() 
    {
        if (($this->session->userdata('login') != TRUE) || ($this->session->userdata('panel') != 'ADMC'))
        {
                redirect('app-panel');
        }
     }
    function index() {
        $data['content'] = 'app/object/report/income_view';
        $data['get_income'] = $this->income_model->get_income();
        $this->load->view('app/template_view', $data);
    }
}

?>
