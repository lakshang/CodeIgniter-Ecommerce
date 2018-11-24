<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author laksh
 */
class IndexController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('PaginationModel');
        $this->load->model('CategoryModel');
        $this->load->model('TrackingModel');
    }

    public function index() {//Index function including Pagination parameters
        $data['category'] = $this->CategoryModel->getCategories();
        $option = $this->input->get('category');
        if (!isset($option)) {
            $config = array();
            $config['base_url'] = base_url('IndexController/index/');
            $config['total_rows'] = $this->PaginationModel->countAllBooks();
            $config['per_page'] = 6;
            $config['num_links'] = round($config['total_rows'] / $config['per_page']);
            $config['uri_segment'] = 3;
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = "</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['results'] = $this->PaginationModel->fetchAllBooks($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();

            //Session Allocation for Tracking
            $this->allocateId();


            $this->load->view('home', $data);
        }
    }

    public function category() {//Different category load function, including Pagination parameters
        $this->allocateId();
        $data['category'] = $this->CategoryModel->getCategories();
        $option = $this->uri->segment(3);
        $config = array();
        $config['base_url'] = base_url('IndexController/category/') . $option;
        $config['total_rows'] = $this->PaginationModel->countByCategory($option);
        $config['per_page'] = 6;
        $config['uri_segment'] = 4;
        $config['num_links'] = round($config['total_rows'] / $config['per_page']);
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['results'] = $this->PaginationModel->fetchByCategory($config['per_page'], $page, $option);
        $data['links'] = $this->pagination->create_links();
        $this->load->view('home', $data);
    }

    function search() {//Search function
        $criteria = $this->input->post('book_search');
        $this->load->model('BookModel');
        if (!empty($criteria)) {
            $data['category'] = $this->CategoryModel->getCategories();
            $data['results'] = $this->BookModel->searchBook($criteria);
            $data['links'] = "";
            $this->load->view('home', $data);
        }else{
            redirect('IndexController');
        }
    }

    function allocateId() {
        if (!$this->session->has_userdata('user_id')) {
            $this->session->set_userdata('user_id', uniqid());
        }
    }

}
