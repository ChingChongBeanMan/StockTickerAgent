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
		$this->data = array();
		$this->data['pagetitle'] = 'Portfolio';
		
	}
    public function index()
	{

            if ($this->session->userdata('username')) {
                    $this->profile();
                   echo "in";
                    
            }
            else {
                   
                    echo "not hello";
                    $this->generateDropdown();
        }
    }
    public function trade_activity($user) {
        $result = '';
        $query = $this->Transaction->get_player_transaction($user);
     
        foreach ($query->result() as $row) {
          $result .= $this->parser->parse('traderow', (array) $row, true);
        }
        return $this->parser->parse('tradetable', array('rows' => $result), true);
    }


    public function login() {
        if($this->input->post('field-username')) {
                $nData = array('username' => $this->input->post('field-username'));
                $this->session->set_userdata($nData);
                $this->data['login-menu'] = $this->parser->parse("logout_menu", $this->data, true);
                $this->index();
            } else {
                $this->data['pagetitle'] = "Login";
                $this->data['page'] = 'login';
                $this->data['pagecontent'] = 'login';
                $this->data['pagebody'] = 'login';
                $this->render();
              }
        }
    public function logout(){
        $this->session->unset_userdata('username');
        $this->data['login-menu'] = $this->parser->parse("login_menu", $this->data, true);
        $this->index();
    }
    public function profile()
    {
        $this->data['page_title'] = $this->session->userdata('username');
        $this->data['player-activity'] = $this->trade_activity($this->session->userdata('username'));
        $this->data['pagebody'] = 'tradetable';
        $this->render();
     }
    
     public function detail($i)
     {
        $this->data['page_title'] = $i;
        $this->data['player-activity'] = $this->trade_activity($i);
        $this->data['pagebody'] = '/portfolio';
        $this->render();
     }
        
        
    public function generateDropdown(){
        $this->load->model('profilelist');
        $this->load->model('Player');
        $playerresult = $this->Player->all();
        $players = '';
        foreach($playerresult as $row){
            $players .= '<option value =' . $row->Player . '>' . $row->Player . '</option>';
        }
        
        $this->data['playerdropdown'] = $players;
        
    }

        
        
    public function individual($name){
        $this->load->model('profilelist');
        $result = $this->ProfileList->some('Play
            er',$name);
                

        $recent = $this->recentTrans($result);
        
       // $holdingsarray = $this->ProfileList->getheldstocks($result);
        $holdings = $this->holdingData($this->ProfileList->getheldstocks($result));

        $this->data['title'] = 'Portfolio';
        $this->data['pagebody'] = 'portfolio';
        $this->data['ProfileSummary'] = $recent;
        $this->data['HoldingSummary'] = $holdings;
        $this->data['PlayerName'] = $name;
        $this->generateDropdown();
        $this->render();
        
    }
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
        
        
        
        
        
