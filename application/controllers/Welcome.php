<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

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
		//$this->data = array();
		$this->data['pagetitle'] = 'Main Page';
		//$this->load->library('parser');
	}
        //Loads the page
	public function index()
	{
           //Load library and models
            $this->load->database();
            $this->load->library('table');
            $this->load->library('parser');
            $this->load->model('Stocks');
            $this->load->model('Player');
            $qArr = $this->Stocks->all();
            //Call to get equity for each plager
            $equityarray =  $this->getEquity();
            $result = '';
            //parse through all stocks and put in table
            foreach($qArr as $row){
                            
                $result .= $this->parser->parse('maintable', $row, true);             
            }
            
            $qArr = $this->Player->all();
            $result_side = '';
            //Parse through all players, add the equity to each player
            foreach($qArr as $row){
                $row->Equity  =  $equityarray[$row->Player];
                $result_side .= $this->parser->parse('sidetable', $row, true);             
            }
            //Set data
            $main_data['inside_stuff'] = $result;
            $this->data['mainview'] = $this->parser->parse('mainview', $main_data, true);
            
            $side_data['side'] = $result_side;
            $this->data['sideview'] = $this->parser->parse('sideview', $side_data, true);
            
            $this->data['pagebody'] = 'mainmaster';
            $this->render();            
            
	}//Gets the equity for each player
          public function getEquity(){
            $this->load->model('ProfileList');
            $this->load->model('Player');
            $this->load->model('Stocks');
            //Get list of all players
            $players = $this->Player->all();
            //Get list of all stocks
            $stock = $this->Stocks->all();
            $equity = array();
            //Get the values of each stock
            $stockvalues = $this->getstockvalue($stock);
            //Loop through each player
            foreach($players as $player){
               
                $resultname = $this->ProfileList->some('Player',$player->Player);
                //Look up the stocks each player holds
                $heldstocks = $this->ProfileList->getheldstocks($resultname);
                $equity[$player->Player] = 0;
                //Check if negative holdings -- set to 0
                foreach($heldstocks as $ss){
                    if($ss->Quantity < 0){
                        $ss->Quantity = 0;
                    }
                    //Add the value of held stocks to each players account
                    $equity[$player->Player] += $ss->Quantity * $stockvalues[$ss->Stock];
                }
            }
           
            return $equity;
        }
        function getstockvalue($result){
            $values = array();     
            foreach($result as $stock){
                $values[$stock->Code] = $stock->Value;
            }
            return $values;
        }
    
}
