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
            $this->load->model('profilelist');
            $result = $this->ProfileList->some('Player',$name);
   
            
            
            $recent = $this->recentTrans($result);
            $holdings = $this->holdingData($result);
           
            

            
            $this->data['title'] = 'Portfolio';
            $this->data['pagebody'] = 'portfolio';
            $this->data['ProfileList'] = $recent;
            $this->data['HoldingSummary'] = $holdings;
                          
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
            
            $holdings = array();
            foreach($totals as $list3){
                $this2= array(
                    'stocksum' => $list3->Stock,
                    'qtysum' => $totals[$list3->Stock]->Quantity   
                );
                $holdings[] = $this2;
            }
            return $holdings;
        }
}       
        
        
        
        
        
