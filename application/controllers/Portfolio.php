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
            }
            else {
                    $this->login(); 
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
     public function holding($name){
        $this->load->model('portfolio');
        $holding = $this->portfolio->some('Player',$name);
        $list = array();
        foreach($history as $list){
            $this1 = array(
               'trans' => $list->Trans,
               'stock' => $list->Stock,
               'qty' => $list->Quantity                       
        );
            $lists[] = $this1;
        }
            $this->data['lists'] = $lists;
            $this->render();
        } 
 
        public function holdingData($result){
            $totals = array();
            foreach($result as $list){
               if($list->Trans == "buy"){
                    if (array_key_exists($list->Stock, $totals)) {
                        $totals[$list->Stock]->Quantity += $list->Quantity;
                    } else {
                        $totals[$list->Stock] = clone $list;
                    }
                } else {
                   if (array_key_exists($list->Stock, $totals)) {
                        $totals[$list->Stock]->Quantity -= $list->Quantity;
                    } else {
                        $totals[$list->Stock] = clone $list;
                        $totals[$list->Stock]->Quantity *= -1;
                    }
                }
            }
            
        }
}       
        
        
        
        
        
