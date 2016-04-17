<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class GameInfos extends MY_Model{
    protected $xml = null;
    protected $Info;// = array();
    protected $game = array();
    
    public function __construct(){

  
    }
    public function xmlConnect(){
        $this->xml = simplexml_load_file(BSXPATH.'status');
        if($this->xml == NULL)
            return false;
        return true;
    }
    public function getInfo(){
        
        
        $this->xml = simplexml_load_file(BSXPATH.'status');

        $this->game['round']    = (int)$this->xml->round;
        $this->game['state']    = (int)$this->xml->state;
        $this->game['current']  = (string)$this->xml->current;
        $this->game['desc']     = (string)$this->xml->desc;
        $this->game['duration'] = (int)$this->xml->duration;
        $this->game['upcoming']=(string)$this->xml->upcoming;
        $this->game['alarm']    = (string)$this->xml->alarm;
        $this->game['now']      = (string)$this->xml->now;  
        $this->game['countdown']= (int)$this->xml->countdown;  
       
         return array($this->game);

    }
    public function getGameStock(){
        $stocks = array();
        $url = BSXPATH."data/stocks";
        $rows = array();
        if(($file = @fopen($url, 'r')))
        {
            $temp = 0;
            while($line = fgetcsv($file)){

                if($line[1] == "name"){
                    continue;
                }
                $rows['code'] = (string)$line[0];
                $rows['name'] = (string)$line[1];
                $rows['category'] = (string)$line[2];
                $rows['value'] = (string)$line[3];
                $stocks[] = $rows;
            }
                
            
            fclose($file);
        }
        
        return $stocks;
    }

public function ImportCSV2Array($filename)
{
    $row = 0;
    $col = 0;
    $thisisretarded = false;
    $handle = @fopen($filename, "r");
    if ($handle) 
    {
        while (($row = fgetcsv($handle, 4096)) !== false) 
        {
            if (empty($fields)) 
            {
                $fields = $row;
                continue;
            }
 
            foreach ($row as $k=>$value) 
            {
                $results[$col][$fields[$k]] = $value;
                $thisisretarded = true;
            }
            $col++;
            unset($row);
        }
        if (!feof($handle)) 
        {
            echo "Error: unexpected fgets() failn";
        }
        fclose($handle);
    }
   if($thisisretarded){
        return $results;
   }
   else{
       return NULL;
   }
   
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