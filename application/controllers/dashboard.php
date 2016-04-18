<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
        public $username;
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
                $this->data['pagetitle'] = 'Dashboard';
                
	}
        //Loads the page
	public function index()
	{
           //Load library and models
            $this->load->database();
            $this->load->model('Users');
            $this->data['pagebody'] = 'UserInfo';
            $infosave = $this->Users->getAUser("test");
            $this->username = "test";
            $user = array();
            $user['avatar']="<img src='../assets/avatar.jpg' width=\"150\">";
            $user['username']=$this->session->userdata('username');
            $user['cash']="1000";
            $user['role']= $this->session->userdata('userRole');
            
            $this->data['userInformation'] = array($user);    
            
            $this->render();
        }
        
        public function upload(){
 
            $config['upload_path']= "../asset/avatar";
            $config['allowed_types']= 'jpg|jpeg|gif|png';
            $config['file_name'] = $this->user;
            $config['max_size'] = 3000;
            $this->load->library('upload', $config);
            
            if($this->upload->do_upload()){
               $file_data = $this->upload->data();
               $data['avatar'] = base_url().'/asset/avatar/'.$username;
               echo "upload success";
            }
                
 
        }

}