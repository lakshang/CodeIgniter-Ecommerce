<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryModel
 *
 * @author laksh
 */
class CategoryModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($data) {

        $this->db->insert('category', $data);

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }//insert new category to database

    function getCategories() {
        $query = $this->db->get('category');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }//get all categories in the database

    function deleteCatgegory($category) {
        $this->db->where('category', $category);
        $this->db->delete('category');
    }//delete category based on the category name

}
