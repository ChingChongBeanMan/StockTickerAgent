<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProfileList extends MY_Model2 {
    // constructor
    function __construct() {
        parent::__construct('transactions','Player','DateTime');
    }
    
    function getheldstocks($result){
         $totals = array();
        foreach($result as $list){
            //$totals[$list->Stock]->Name = $list->Stock;
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
        return $totals;

    }
}
