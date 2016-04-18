<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class StockManager extends MY_Controller {

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
                $this->data['pagetitle'] = 'Buy and Sell Stocks';
                $this->restrict(array(ROLE_USER,ROLE_ADMIN));
	}
        function index($message = null){
            $this->data['pagebody'] = 'BuySell';
            $this->getStocks();
            $this->data['message'] = $message;
            $this->render();
        }
        function getStocks(){
            $this->load->model('Stock');
            $url = BSXPATH."data/stocks";
            $this->load->model('GameInfos');
            $stockAll = $this->GameInfos->ImportCSV2Array($url);
            $this->Stock->redoStocks($stockAll);
            $stockList = $this->Stock->all();
            $username = $this->session->userdata('userName');
            
            if(count($stockList) == 0)
            {
                
                return;
                
            }
            
                foreach($stockList as $stock){
                $arr = array('code' => $stock->Code,
                             'name' => $stock->Name,
                             'value' => $stock->Value,
                             'username' => $username);
                
                $stockArr[] = $arr;
            }
            
            $this->data['listStock'] = $stockArr;
        }
    public function getKey(){
            $url = BSXPATH . 'register';
            $data = array('team' => 'o11',
                          'name' => 'Colin',
                          'password' => 'tuesday' );
            $send = array(
                'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($send);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { 
            return NULL;
            
        }
        return $result;  
    }
        
        public function buyStocks($stockName, $quantity, $user){
        //echo $stockName;

        $url = BSXPATH . '/buy';
        $key = $this->getKey();
        $xml = simplexml_load_string($key);
        $total = count((array)$xml);
        if($total == 1){
            $this->index();
            return;
        }
        $realKey = (string)$xml->token;
        $data = array('team' => 'o11',
                      'token' => $realKey,
                      'player' => $user,
                      'stock' => $stockName,
                      'quantity' => $quantity
                );

        $send = array(
            'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($send);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) {
            
            
        }
        $stockcert = simplexml_load_string($result);
        $c = count((array)$stockcert);
        if($c == 1){
            
            //$this->data['message'] = "Stock not purchased";
            $str = (string)$stockcert->message;
            $this->index($str);
        }
        else{
            $token = (string)$stockcert->token;
            $this->load->model('HeldStock');
            $this->HeldStock->addPurchase($stockName, $user, $quantity, $token);
            $str= "Stock Purchased!";
            $this->index($str);
        }
    }
        public function sellStocks($stockName, $quantity, $player){
        //echo $stockName;
        $url = BSXPATH . '/sell';
        $key = $this->getKey();
        $xml = simplexml_load_string($key);
        $total = count((array)$xml);
        if($total == 1){
            $this->index();
            return;
        }
        $realKey = (string)$xml->token;
        $this->load->model('HeldStock');
        $stocks = $this->HeldStock->all();
        $sell = false;
        $sellcode;
        foreach($stocks as $s){
            if($s->Player == $player && $s->Code == $stockName && $s->Amount == $quantity){
                $sell = true;
                $sellcode = $s->RetCode;
                break;
            }
        }
        if(!$sell){
           $this->data['message'] = "You dont own this stock";
           $this->index();
           return;
        }
        
        $data = array('team' => 'o11',
                      'token' => $realKey ,
                      'player' => $player,
                      'stock' => $stockName,
                      'quantity' =>  $quantity,
                      'certificate' => $sellcode);

     
        $send = array(
            'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($send);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) {
            
            
        }

        
    }   
        
        
}