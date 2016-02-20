<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//the model for stcok 
class Main extends MY_Model {
    // constructor
    function __construct() {
        parent::__construct('stocks','Name');
    }

}