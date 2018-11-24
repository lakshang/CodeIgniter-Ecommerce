<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CartController
 *
 * @author laksh
 */
class CartController extends CI_Controller {

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

    function remove($bookId) {
        if ($bookId === "all") {//if bookid is all remove all the items in the cart
            $this->cart->destroy(); //destroy the cart session
        } else {
            $data = array(
                'rowid' => $bookId,
                'qty' => 0
            );
            $this->cart->update($data); //else remove the specifc row id from the cart
        }
        redirect('CartController');
    }

    function update() {//update cart
        $cart_info = $this->input->post('cart'); //get current cart info
        foreach ($cart_info as $id => $cart) {
            $rowid = $cart['rowid'];
            $price = $cart['price'];
            $amount = $price * $cart['qty'];
            $qty = $cart['qty'];

            $data = array(
                'rowid' => $rowid,
                'price' => $price,
                'amount' => $amount,
                'qty' => $qty
            );
            $this->cart->update($data); //update the cart
        }
        redirect('CartController');
    }

    function order() {
        $this->cart->destroy();
        redirect('IndexController');
    }

}
