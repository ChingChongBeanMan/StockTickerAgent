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
	public function index()
	{
           
            $this->load->database();
            $this->load->library('table');
            $this->load->library('parser');
            $this->load->model('Stocks');
            $this->load->model('Player');
            $qArr = $this->Stocks->all();
            $equityarray =  $this->getEquity();
            $result = '';
            foreach($qArr as $row){
                            
                $result .= $this->parser->parse('maintable', $row, true);             
            }
            
            $qArr = $this->Player->all();
            $result_side = '';
            foreach($qArr as $row){
                $row->Equity  =  $equityarray[$row->Player];
                $result_side .= $this->parser->parse('sidetable', $row, true);             
            }
            
            $main_data['inside_stuff'] = $result;
            $this->data['mainview'] = $this->parser->parse('mainview', $main_data, true);
            
            $side_data['side'] = $result_side;
            $this->data['sideview'] = $this->parser->parse('sideview', $side_data, true);
            
            $this->data['pagebody'] = 'mainmaster';
            $this->render();            
            
	}
        public function getEquity(){
            $this->load->model('ProfileList');
            $this->load->model('Player');
            $this->load->model('Stocks');
            $players = $this->Player->all();
            $stock = $this->Stocks->all();
            $equity = array();
            
            $stockvalues = $this->Player->getstockvalue($stock);
      
            foreach($players as $player){
               
                $resultname = $this->ProfileList->some('Player',$player->Player);

                $heldstocks = $this->ProfileList->getheldstocks($resultname);
                $equity[$player->Player] = 0;
                foreach($heldstocks as $ss){
                    if($ss->Quantity < 0){
                        $ss->Quantity = 0;
                    }
                    $equity[$player->Player] += $ss->Quantity * $stockvalues[$ss->Stock];
                }
                echo $equity[$player->Player];
                echo '</br>';
            }
           
            return $equity;
        }
    
}
