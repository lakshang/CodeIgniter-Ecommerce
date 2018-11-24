<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserModel
 *
 * @author laksh
 */
class UserModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getUser($user) {

        $this->db->where('username', $user['username']);
        $this->db->where('password', $user['password']);
        $this->db->from('login');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }//get the admin user details from the database

}
