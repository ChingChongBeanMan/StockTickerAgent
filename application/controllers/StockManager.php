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
        $context  = stream_context_create($send, $quantity);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { 
            return NULL;
            
        }
        var_dump($result);
        return $result;  
    }
        
        public function buyStocks($stockName){
        //echo $stockName;
        $url = DATAPATH . '/buy';
        $key = $this->getKey();
        $data = array('team' => 'o11',
                      'token' => $key ,
                      'player' => 'Colin',
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

        var_dump($result);
    }
        public function sellStocks($stockName, $quantity){
        //echo $stockName;
        $url = DATAPATH . '/sell';
        $key = $this->getKey();
        $data = array('team' => 'o11',
                      'token' => $key ,
                      'player' => 'Colin',
                      'stock' => $stockName,
                      'quantity' =>  $quantity );

     
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

        var_dump($result);
    }   
        
        
}