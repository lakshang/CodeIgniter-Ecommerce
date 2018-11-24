<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author laksh
 */
class AdminController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('CategoryModel');
        $this->load->model('BookModel');
    }

    function index() {
        if ($this->session->logged) {//Check whether the session is logged in
            $this->load->view('adminPanel'); //Load the admin panel
        } else {
            $this->load->view('login'); //Else load the login page
        }
    }

    function login() {
        $user = array('username' => $this->input->post('username'), 'password' => ($this->input->post('password'))); //get the parameters from the view
        if ($this->UserModel->getUser($user)) {//Admin login exists in database
            $this->session->set_userdata($user); //Setting session with the username
            $this->session->set_userdata('logged', true); //Setting logged session variable true
        } else {
            $this->session->set_flashdata('error_message', 'Invalid Username/ Password'); //Login unsucessful scenario
        }
        redirect('AdminController');
    }

    function logout() {
        $this->session->sess_destroy(); //Destroy the existing session
        redirect('AdminController/index');
    }

    function category() {
        if ($this->session->logged) {
            $this->load->view('addCategoryForm');
        } else {
            $this->load->view('login');
        }
    }

    function add_category() {
        if ($this->session->logged) {//Check if logged in 
            $insert = array('category' => $this->input->post('book_category')); //Get book category from the view
            if ($this->CategoryModel->insert($insert)) {//If category insert is successful
                $this->session->set_flashdata('category_added', 'Category Insert Successful!'); //Setting session flash data with the success message
            } else {
                $this->session->set_flashdata('error_message', 'Category already exists !'); //Setting session flash data with the error message
            }
            redirect('AdminController/category');
        } else {
            $this->load->view('login');
        }
    }

    function book() {
        if ($this->session->logged) {//Check if logged in 
            $data['allCategory'] = $this->CategoryModel->getCategories(); //Get all the book categories
            $this->load->view('addBookForm', $data);
        } else {
            $this->load->view('login');
        }
    }

    function add_book() {
        if ($this->session->logged) {//Check if logged in
            $filename = $this->BookModel->uploadImage(); //Upload the image.
            $book = array('bookAuthor' => $this->input->post('author'), //Get the insert book parameters from the view
                'bookKeywords' => $this->input->post('keywords'),
                'bookTitle' => $this->input->post('title'),
                'bookPrice' => $this->input->post('price'),
                'bookImage' => $filename,
                'bookDescription' => $this->input->post('desc'),
                'bookCategory' => $this->input->post('category')
            );


            if ($this->BookModel->insertBook($book)) {//If book insert successful
                $this->session->set_flashdata('book_added', 'Book Insert Successful !'); //Setting session flash data with the success message
            } else {
                $this->session->set_flashdata('error_message', 'Book Insert Failed'); //Setting session flash data with the error message
            }
            redirect('AdminController/book');
        } else {
            $this->load->view('login');
        }
    }

    function view_book() {
        if ($this->session->logged) {
            $this->load->view('viewBookDetails');
        } else {
            $this->load->view('login');
        }
    }

    function search_book() {
        if ($this->session->logged) {//Check if logged in
            $searchValue = $this->input->post('author'); //Get the search parameter
            $data['result'] = $this->BookModel->getByAuthorTitle($searchValue); //Pass the parameter to the model

            $this->load->view('viewBookDetails', $data);
        } else {
            $this->load->view('login');
        }
    }

    function edit_book() {
        if ($this->session->logged) {//Check if logged in
            $id = $this->input->post('id'); //Get the book id to be editted
            $data['book'] = $this->BookModel->getBook($id); //Pass the book id to the model 
            $data['category_book'] = $this->CategoryModel->getCategories(); //Get all the categories  
            $this->load->view('viewBookDetails', $data);
        } else {
            $this->load->view('login');
        }
    }

    function update_book() {
        if ($this->session->logged) {//Check if logged in
            $id = $this->input->post('id'); //Get the update parameter
            $data = array('bookTitle' => $this->input->post('title'), //Get the values to be updated
                'bookPrice' => $this->input->post('price'),
                'bookDescription' => $this->input->post('desc'),
                'bookAuthor' => $this->input->post('author'),
                'bookCategory' => $this->input->post('category'));

            $this->BookModel->update($id, $data); //Pass the values to the model
            redirect('AdminController/view_book');
        } else {
            $this->load->view('login');
        }
    }

    function delete_book() {
        if ($this->session->logged) {//Check if loggen in
            $id = $this->uri->segment(3); //URI parameter 3 contians with the book id to be deleted
            if ($this->BookModel->deleteBook($id)) {//Perform the delete
                redirect('AdminController/index');
            } else {
                redirect('AdminController/index');
            }
        } else {
            $this->load->view('login');
        }
    }

    function delete_category() {
        if ($this->session->logged) {//Check if loggen in
            $category = $this->uri->segment(3); //URI parameter 3 contians with the book id to be deleted
            if ($this->CategoryModel->deleteCategory($category)) {//Perform the delete
                redirect('AdminController/index');
            } else {
                redirect('AdminController/index');
            }
        } else {
            $this->load->view('login');
        }
    }

    function statistics() {//View general visiting statistics
        $data = $this->BookModel->getTopViewBooks(); //Get the top 5 viewed books
        $response->cols[] = array('id' => '', 'label' => 'Topping', 'pattern' => '', 'type' => 'string');
        $response->cols[] = array('id' => '', 'label' => 'Views', 'pattern' => '', 'type' => 'number');
        foreach ($data as $items) {
            $response->rows[]['c'] = array(array('v' => $items->bookTitle, 'f' => null), array('v' => (int) $items->bookViewCount, 'f' => NULL));
        }
        echo json_encode($response);
    }

}
