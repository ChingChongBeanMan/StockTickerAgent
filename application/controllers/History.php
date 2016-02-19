<?php
class History extends My_Controller{

     function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->data['pagetitle'] = 'Stocks';
		
	}
    function gendropdown(){
        $this->load->model('Stocks');
        $result = $this->Stocks->all();
        $output = '';
        foreach($result as $row){
            $output .= '<option value =' . $row->Code . '>' . $row->Code . '</option>';
        }
        $this->data['dropdown'] = $output;
    }
    function stockhistory($stock){
      
            $this->load->model('StockList');
            $this->load->model('MovementList');
            $this->load->library('parser');
            $this->data['title'] = 'Stock History';
            $result = $this->StockList->some('Stock',$stock);
            $parse = '';
            foreach($result as $row){
                if($row->Trans == 'buy'){
                    $row->Trans = '/assets/buy.jpg';
                }
                else if($row->Trans == 'sell'){
                    $row->Trans = '/assets/sell.jpg';
                }
               $parse .= $this->parser->parse('stocktransactionstable', $row, true);
                
            }
            $result2 = $this->MovementList->some('Code', $stock);
            $movparse = '';
            foreach($result2 as $row){
                
                if($row->Action == 'down'){
                    $row->Action = 'assets/down.png';
                }
                elseif($row->Action == 'up'){
                    $row->Action = 'assets/up.png';
                }
                elseif($row->Action == 'div'){
                    $row->Action = 'assets/dividend.jpg';
              
                }
                $movparse .= $this->parser->parse('movementtable', $row, true);
            }
           
            
            
            
            
            
            
            
           $this->gendropdown();
           $this->data['intro'] = $stock;
           $this->data['movement_history'] = $movparse; 
           $this->data['stock_transactions'] = $parse;
           $this->data['pagebody'] = 'stockhistory';
           $this->render();

           
    }
    function generalhistory(){
        $this->load->model('StockList');
        $this->load->model('MovementList');
        $this->load->library('parser');
        $this->data['title'] = 'Stock History';
        $result = $this->StockList->all();
        $result2 = $this->MovementList->all();
        $mostRecent = NULL;
        if(empty($result) && empty($result2)){
            $this->stockhistory($mostRecent);
        }
        if(empty($result)){
            $mostRecent = $result2[0]->Code;
        }
        else if(empty($result2)){
            $mostRecent = $result[0]->Stock;
        }
        else{
            if($result[0]->DateTime >= $result2[0]->Datetime){
                $mostRecent = $result[0]->Stock;
            }
            else{
                $mostRecent = $result2[0]->Code;
            }
        }
        $this->data['intro'] = 'Most Recently Changed Stock: ' . $mostRecent;
        $this->stockhistory($mostRecent);
}
}