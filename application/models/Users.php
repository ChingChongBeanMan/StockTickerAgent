<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Users extends MY_Model {
    var $user;
    var $avatar_path;
    var $avatar_path_url;
    // constructor
    function __construct() {
        parent::__construct('users','username');
        $this->gallery_path = realpath(base_url(). 'data/avatar');
        $this->gallery_path_url = base_url().'data/avatar/';
    }
    function addUser($username,$password,$role){
        $this->load->database();
        $this->user = $username;
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
     function getAUser($user){
        $this->load->database();
        $this->db->select('*');
        $this->db->from('Players');
        $userfind = "Player=\"".$user."\"";
        $this->db->where($userfind);
        $qet = $this->db->get();

        return $qet;
    }
    
    
         function do_upload(){

            $config = array(
                // requried variable allowed types is needed also delcared the upload path to gallery path
                'allowed_types' => 'jpg|jpeg|gif|png',
                'upload_path' => $this->avatar_path,
                'max_size' => 3000,
                'file_name' => $this->user
            ); 

            // loads the library and sets where its going to go to
            $this->load->library('upload',$config);
            // this performs the upload operation

            $this->upload->do_upload();
            //returns data about upload ( file location )
            $image_data = $this->upload->data();

            $config = array(
                'source_image' => $image_data['full_path'],
                'new_image' => $this->avatar_path . '/data/avatar',
                'maintain_ration' => true,
                'width' => 250,
                'height' => 220
            );

            $data = array(
              'username' => $this->input->post('username'),
              'category' => $this->input->post('category'),
              'filename' => $image_data['file_name'],
            );

            $this->db->insert('portfolio', $data );

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
         }


        function get_images(){

            $files = scandir($this->avatar_path);
            // substracts these out of array
            $files = array_diff($files, array('.', '..','thumbs'));
            $images = array();

            foreach ($files as $file){
                $images [] = array(
                    'url' => $this->gallery_path_url . $file,
                    'thumb_url' => $this->gallery_path_url . 'thumbs/' .$file
                );
            }
            return $images;
        }
        
}