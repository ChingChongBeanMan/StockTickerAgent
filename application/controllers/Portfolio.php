<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Portfolio extends My_Controller{

     function __construct()
	{
		parent::__construct();
                $this->load->library('session');
		$this->data = array();
		$this->data['pagetitle'] = 'Portfolio';
		
	}
    //Checks to see if there is a current session running. 
    public function index()
	{

            if ($this->session->userdata('username')) {
                   $this->individual($this->session->userdata('username'));
            }
            else {
                   $this->individual('');
        }
    }
    //Creates a session variable based on a user name
    public function showLogin(){
        $this->data['pagetitle'] = "Login";
        $this->data['page'] = 'login';
    //    $this->data['pagecontent'] = 'login';
        $this->data['pagebody'] = 'login';
        
        $this->render();
    }
    public function login() {
        $this->load->helper('url');
           
        if(!$this->input->post('field-username')) {
                       
            $this->showLogin();
        }
        
        $this->load->model("Users");
        $use = $this->input->post('field-username');
        $pass = $this->input->post('field-password');
        $allUsers = $this->Users->getUser();
        $exist = false;
        foreach($allUsers->result() as $user){
            if(strtolower($user->username) == strtolower($use)){
                
                if(password_verify($pass,$user->password)){
                    
                    $nData = array('username' => $this->input->post('field-username'));
                    $this->session->set_userdata($nData);
                    $this->session->set_userdata('userName',$user->username);
                    $this->session->set_userdata('userRole',$user->role);
                    $this->data['login-menu'] = $this->parser->parse("logout_menu", $this->data, true);
                    header("dashboard.php");
                    redirect("/dashboard");
                    return;
                }
                else{
                    
                    $this->showLogin();
                    return;
                }
                
            }
            
                
        }

    }
    //Destroys user session
    public function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('userRole');
        $this->data['login-menu'] = $this->parser->parse("login_menu", $this->data, true);
        $this->index();
    }
    //Displays profile for a current user
    public function profile()
    {
        $this->data['page_title'] = $this->session->userdata('username');
        $this->data['player-activity'] = $this->individual($this->session->userdata('username'));
        $this->data['pagebody'] = 'tradetable';
     }
    //Displays profile for a specific user
     public function detail($i)
     {
        $this->data['page_title'] = $i;
        $this->data['player-activity'] = $this->invidividual($i);
        $this->data['pagebody'] = '/portfolio';
        $this->render();
     }
        
    //Generates a dropdown list of all users in data base    
    public function generateDropdown(){
        $this->load->model('profilelist');
        $this->load->model('Player');
        $playerresult = $this->Player->all();
        foreach($playerresult as $row){
            $this1 = array(
               'playername' => $row->Player,
                
            );
            $lists[] = $this1; 
        }
        $this->data['playerdropdown'] = $lists;
    }

    //Gets the individual data of the user 
    public function individual($name){
        $this->load->model('profilelist');
        $result = $this->ProfileList->some('Player',$name);
                

        $recent = $this->recentTrans($result);
        
        $holdings = $this->holdingData($this->ProfileList->getheldstocks($result));

        $this->data['title'] = 'Portfolio';
        $this->data['pagebody'] = 'portfolio';
        $this->data['ProfileSummary'] = $recent;
        $this->data['HoldingSummary'] = $holdings;
        $this->data['PlayerName'] = $name;
        //##################################
        //move to ####/dashboard
        //#################################
        $this->render();
        
        
    }
    //Gets the recent transactions of the user
    public function recentTrans($result){
        $lists = array();
        foreach($result as $list){
            $this1 = array(
                'time' => $list->DateTime,
                'trans' => $list->Trans,
                'stock' => $list->Stock,
                'qty' => $list->Quantity
            );
            $lists[] = $this1;
        }
        return $lists;
    }
    //Gets the holdings info of the user 
    public function holdingData($totals){
        $holdings = array();
        foreach($totals as $list2){
            $this2 = array(
                'stocksum' => $list2->Stock,
                'qtysum' => $totals[$list2->Stock]->Quantity
            );
            $holdings[] = $this2;
        }
        return $holdings;
    }
}       
