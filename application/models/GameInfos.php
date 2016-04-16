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
    public function getInfo(){
         $this->xml = simplexml_load_file(BSXPATH.'status');//, "SimpleXMLElement", LIBXML_NOENT);

           $bsx = $this->xml;


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
            while($line = fgetcsv($file)){
                
                $row = count($line);
                $rows['code'] = (string)$line[0];
                $rows['name'] = (string)$line[1];
                $rows['category'] = (string)$line[2];
                $rows['value'] = (string)$line[3];
                $stocks[] = array($rows);
            }
                
            
            fclose($file);
        }
        
        return array($rows);
    }

public function ImportCSV2Array($filename)
{
    $row = 0;
    $col = 0;
 
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
 
    return $results;
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