<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
        function __construct()
	{
		parent::__construct();
                $this->data['pagetitle'] = 'Player Management';
                
        }
        function index(){
            $this->data['pagebody'] = 'PlayerManagement';
            $this->getUsers();
            $this->render();
        }
        function getUsers(){
            $userArr;
            $this->load->model("Users");
            $users = $this->Users->getUser();
           // var_dump($users);
            foreach($users->result() as $use){
                $arr = array('username' => $use->username);
                $userArr[] = $arr;
            }
            $this->data['listPlayer'] = $userArr;
        }
    function edit($user){
        $this->data['pagebody'] = 'EditPlayer';
        $this->data['username'] = $user;
        $this->render();
  }
  function changePass($user){
      $newpass = $_POST['password'];
      $data = array('password' => password_hash($newpass,PASSWORD_DEFAULT));
      $this->db->where('username', $user);
      $this->db->update('users', $data);
      $this->index();
  }
  function delete($user){
      $this->db->where('username', $user);
      $this->db->delete('users');
      $this->index();
  }
}