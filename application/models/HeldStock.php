<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HeldStock extends MY_Model2 {
    // constructor
    function __construct() {
        parent::__construct('heldStock','Player');
    }
    public function addPurchase($stock, $player, $amount, $code){
        $this->load->database();
        $data = array(
            'Player'      => $player ,
            'Code'      => $stock ,
            'Amount'  => $amount ,
            'RetCode'     => $code
            );
        $this->db->insert('heldstock', $data);
    }
}