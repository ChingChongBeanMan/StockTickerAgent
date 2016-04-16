<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class GameInfos extends MY_Model{
    protected $xml = null;
    protected $Info = array();
    protected $game = array();

    public function __construct(){
         $this->xml = simplexml_load_file(BSXPATH.'status');
         
        $game['round']    = (int)$bsx->round;
        $game['state']    = (int)$bsx->state;
        $game['current']  = (string)$bsx->current;
        $game['desc']     = (string)$bsx->desc;
        $game['duration'] = (int)$bsx->duration;
        $game['upcomming']=(string)$bsx->upcomming;
        $game['alarm']    = (string)$bsx->alarm;
        $game['now']      = (string)$bsx->now;  
        $game['countdown']= (int)$bsx->countdown;  
        foreach($this->xml->bsx as $bsx){

            $this->Info[];
            echo "HELLP". $bsx;
        }
    }
    public function getInfo(){
        return $game;
    }
}

class bsxForm extends CI_Model{
    
    protected $round = null;
    protected $state;
    protected $desc;
    protected $current;
    protected $duration;
    protected $upcomming;
    protected $alarm;
    protected $now;
    protected $countdown;
    
    public function __construct($bsx){
        $this->round    = (int)$bsx->round;
        $this->state    = (int)$bsx->state;
        $this->current  = (string)$bsx->current;
        $this->desc     = (string)$bsx->desc;
        $this->duration = (int)$bsx->duration;
        $this->upcomming=(string)$bsx->upcomming;
        $this->alarm    = (string)$bsx->alarm;
        $this->now      = (string)$bsx->now;  
        $this->countdown= (int)$bsx->countdown;  
    }
}