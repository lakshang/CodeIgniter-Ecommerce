<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductController
 *
 * @author laksh
 */
class ProductController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {//Loads product details page all with the data retrieved from the Book Model
        $bookId = $this->uri->segment(3);
        if ($bookId) {
            $this->load->model('BookModel');
            $data['book'] = $this->BookModel->getBook($bookId);
            $this->load->model('TrackingModel');
            if (!$this->TrackingModel->validate($this->session->user_id, $bookId)) {

                $this->TrackingModel->bookVisited($this->session->user_id, $bookId);
                $this->BookModel->count($bookId);
            }
            $data['topBooks'] = ($this->BookModel->topBook($bookId));
            if ($this->BookModel->topBookDetails($data['topBooks'])) {
                $data['topBooksDetails'] = $this->BookModel->topBookDetails($data['topBooks']);
            }
            $this->load->view('productPage', $data);
        } else {
            redirect('IndexController');
        }
    }

}
