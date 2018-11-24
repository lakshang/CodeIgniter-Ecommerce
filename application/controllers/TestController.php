<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestController
 *
 * @author laksh
 */
class TestController extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('cart');
    }

    function add() {
        $insert = array(//Get the values
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'qty' => 1);
        
        
        
        $this->cart->insert($insert); //Cart insert 
        redirect('IndexController'); //redirect to indexController if successful
    }

}
