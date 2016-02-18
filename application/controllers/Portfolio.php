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
        
    public function index($name)
	{
          //  $this->load->library('Portfolio','parser');
            $this->load->model('profilelist');
            $this->data['title'] = 'WHAT IS THIS FOR';
            $this->data['pagebody'] = 'portfolio';
            
            
         //   $this->history($name);
         //   $this->holding($name);
 //           $this->load->model('profilelist');
            $recent = $this->ProfileList->some('Player',$name);
            
            $lists = array();
            foreach($recent as $list){
                $this1 = array(
                    'time' => $list->DateTime,
                    'trans' => $list->Trans,
                    'stock' => $list->Stock,
                    'qty' => $list->Quantity                       
                );
                $lists[] = $this1;
            }
            $this->data['ProfileList'] = $lists;
            
           // $holding = $this->portfolio->some('Player',$name);
            $lists2 = array();
            foreach($recent as $list){
                $this1 = array(
                    'trans' => $list->Trans,
                    'stock' => $list->Stock,
                    'qty' => $list->Quantity                       
                );
            $lists2[] = $this1;
            }
            $this->data['PriflieList'] = $lists;
            $this->render();
            
        }
               /*
         public function history($name){
            
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
        */
}
        
        
        
        
        
