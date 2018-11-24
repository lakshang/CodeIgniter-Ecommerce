<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TrackingModel
 *
 * @author laksh
 */
class TrackingModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

//allocate a unique user id to each visting user

    function bookVisited($id, $bookId) {
        $data = array('id' => $id, 'bookId' => $bookId);
        $this->db->insert('tracking', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        if ($this->db->error()) {
            return FALSE;
        }
    }

//mark the visited book the database

    function validate($id, $bookId) {
        $query = $this->db->get_where('tracking', array('id' => $id, 'bookId' => $bookId));

        if ($query->num_rows() > 0) {

            return TRUE;
        } else {
            return FALSE;
        }
    }

//validating the user to avoid duplicate visits
}
