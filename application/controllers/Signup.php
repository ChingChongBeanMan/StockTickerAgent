<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Signup extends My_Controller{

     function __construct()
	{
		parent::__construct();
                $this->load->library('session');
		$this->data = array();
		$this->data['pagetitle'] = 'Register';
		
	}
    //Checks to see if there is a current session running. 
    public function index()
    {
        $this->data['pagebody'] = 'sign_up';
	$this->render();
        echo "this is the most pointless thing I have ever done";
            
    }
    
   public function register(){
       $this->load->model('Users');
       $curUsers = $this->Users->getUser();
       $dup = false;
       $use = $_POST['username'];
       $pass = $_POST['password'];
       foreach($curUsers->result() as $user){
            if(strtolower($user->username) == strtolower($use)){
               $dup = true;
               break;
            }
       }
       if($dup){
            $this->data['pagebody'] = 'sign_up';
            $this->render();
            echo "it should not pass";
            return;
       }
       echo "Adding user";
        $this->Users->addUser($use,password_hash($pass,PASSWORD_DEFAULT), "player");
   }
}