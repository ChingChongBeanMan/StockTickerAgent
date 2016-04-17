<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Users extends MY_Model {
    // constructor
    function __construct() {
        parent::__construct('users','username');
    }
 function addUser($username,$password,$role){
        $this->load->database();
        
        $data = array(
            'username'      => $username ,
            'password'      => $password ,
            'role'          => $role ,
        );
        $this->db->insert('users', $data); 
    }
    function getUser(){
        $this->load->database();
        $this->db->select('*');
        $this->db->from('users');
        $qet = $this->db->get();
        return $qet;
    }
   
}