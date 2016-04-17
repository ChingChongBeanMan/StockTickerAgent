<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//the model for stcok
class Stock extends MY_Model {
    // constructor
    function __construct() {
        parent::__construct('stocks','Name');
    }

    public function redoStocks($stockList){
         $this->load->database();
         $this->db->truncate('stocks');

         foreach($stockList as $stock){
           
             
            $data = array(
            'Code'      => $stock['code'] ,
            'Name'      => $stock['name'] ,
            'Category'  => $stock['category'] ,
            'Value'     => $stock['value']
            );
        $this->db->insert('stocks', $data);
         }
    }
    public function redoMovement($stockList){
         if(is_null($stockList)){
            return;
        }
         $this->load->database();
         $this->db->truncate('movements');
         
         foreach($stockList as $stock){
           
             
            $data = array(
            'Datetime'      => date('r', $stock['datetime']) ,
            'Code'      => $stock['code'] ,
            'Action'  => $stock['action'] ,
            'Amount'     => $stock['amount']
            );
        $this->db->insert('movements', $data);
         }
    }
    
    public function redoTransactions($stockList){
        
        if(is_null($stockList)){
            return;
        }
        
         $this->load->database();
         $this->db->truncate('transactions');

         foreach($stockList as $stock){
           
             
            $data = array(
            'Datetime'      => date('r', $stock['datetime']) ,
            'Player'      => $stock['player'] ,
            'Stock'     => $stock['stock'] ,
            'Trans'     => $stock['trans'] ,
            'Quantity'  => $stock['quantity']
            );
        $this->db->insert('transactions', $data);
         }
    }
}