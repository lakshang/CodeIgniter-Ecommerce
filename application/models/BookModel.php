<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BookModel
 *
 * @author laksh
 */
class BookModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insertBook($book) {//insert book into database
        if ($this->uploadImage() == FALSE) {//image upload fails return FALSE
            return FALSE;
        } else {
            $this->db->insert('book', $book); //else insert book successfully and return TRUE
            if ($this->db->affected_rows() == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function uploadImage() {//upload image to assets/images folder
        $config['upload_path'] = 'assets/images';
        $config['allowed_types'] = 'jpg|jpeg|png';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!($this->upload->do_upload('image'))) {
            return FALSE;
        } else {
            $data = $this->upload->data();
            return $data['file_name'];
        }
    }

    function getAllBooks() {//get all books from database
        $query = $this->db->get('book');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function getByCategory($category) {//get all books based on category
        $query = $this->db->get_where('book', array('bookCategory' => $category));

        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        } else {
            return $data = 'No Record found !';
        }
    }

    function getBook($bookId) {//get a specific book based on the book id
        $query = $this->db->get_where('book', array('bookId' => $bookId));
        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        } else {
            return $data = 'No Record found !';
        }
    }

    function searchBook($criteria) { //search book based on book author or book title
        $query = $this->db->like('bookAuthor', $criteria)->or_like('bookTitle', $criteria)->get('book');

        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        } else {
            return $data = 'No Record found !';
        }
    }

    function getByAuthorTitle($criteria) {//get book by the specific author or title
        $query = $this->db->where('bookTitle', $criteria)->or_where('bookAuthor', $criteria)->get('book');
        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        }
    }

    function update($id, $data) {//update book data
        $this->db->where('bookId', $id);
        $this->db->update('book', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function count($bookId) {//counting the user views based on the book
        $this->db->set('bookViewCount', 'bookViewCount+1', FALSE);
        $this->db->where('bookId', $bookId);
        $this->db->update('book');
    }

    function deleteBook($bookId) {//book delete based on the book id
        $this->db->where('bookId', $bookId);
        $this->db->delete('book');
    }

    function topBook($bookId) {//creates a view to temporary store visitors based on the book id AND gets the top visited books
        $queryCreate = $this->db->query('CREATE OR REPLACE VIEW visitors AS SELECT id,bookId FROM tracking WHERE bookId=' . $bookId);
        if ($queryCreate) {
            $select = array('tracking.bookId, COUNT(tracking.bookId) AS totalViews');
            $topBook = $this->db
                    ->select($select)
                    ->from('tracking')
                    ->join('visitors', 'visitors.id = tracking.id', 'left')
                    ->where(array('tracking.bookId !=' => $bookId))
                    ->group_by('tracking.bookId')
                    ->order_by('totalViews', 'DESC')
                    ->limit(5)
                    ->get()
                    ->result_array();
            return $topBook;
        }
    }

    function topBookDetails($book) {//gets the details of the top visited books
        foreach ($book as $item) {
            $data[] = $item['bookId'];
        }
        $query = $this->db->where_in('bookId', $data)->get('book');
        if ($query) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    function getTopViewBooks() {//get the top viewed books based on general visit count
        $query = $this->db
                ->select('bookTitle, bookViewCount')
                ->from('book')
                ->order_by('bookViewCount', 'DESC')
                ->limit(5)
                ->get()
                ->result();
        return $query;
    }

}
