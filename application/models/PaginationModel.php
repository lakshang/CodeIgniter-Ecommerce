<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaginationModel
 *
 * @author laksh
 */
class PaginationModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function countAllBooks() {
        return $this->db->count_all('book');
    }

//count all the books in the database

    function fetchAllBooks($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('book');

        if ($query->num_rows() > 0) {

            return $query->result();
        }
        return FALSE;
    }

//fetch all the book details based on the limit

    function countByCategory($category) {
        return $this->db->where('bookCategory', $category)->count_all_results('book');
    }

//count all the books per category in the database

    function fetchByCategory($limit, $start, $category) {
        $this->db->limit($limit, $start);
        $query = $this->db->get_where('book', array('bookCategory' => $category));

        if ($query->num_rows() > 0) {

            return $query->result();
        }
        return FALSE;
    }

//fetch all the book details per category based on the limit
}
