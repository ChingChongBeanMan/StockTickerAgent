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
            $sql = ("SELECT Name, Value FROM stocks");
            $qArr = $this->db->query($sql);
            $result = '';
            foreach($qArr->result() as $row){
                $result .= $this->parser->parse('maintable', $row, true);             
            }
            
            //$parms['inside_stuff'] = $result;
            //$this->parser->parse('mainview', $parms);
                
            //$this->data['inside_stuff'] = $result;
            $sql = ("SELECT * FROM players");
            $qArr = $this->db->query($sql);
            $result_side = '';
            foreach($qArr->result() as $row){
                $result_side .= $this->parser->parse('sidetable', $row, true);             
            }
            
            $main_data['inside_stuff'] = $result;
            $this->data['mainview'] = $this->parser->parse('mainview', $main_data, true);
            
            $side_data['side'] = $result_side;
            $this->data['sideview'] = $this->parser->parse('sideview', $side_data, true);
            
            $this->data['pagebody'] = 'mainmaster';
            $this->render();
            
            
            
            
            
            
            /*            
            $this->load->library('table');
            $this->load->library('parser');          

            $Stock = $this->getStock();
            $Player = $this->getPlayer();
            
   //         $this->data['stocklist'] = $Stock;           
  //          $this->data['playerlist'] = $Player;
            
            $maintable['stocklist'] = $Stock;
            $sidetable['playerlist'] = $Player;
            $this->data['inside_stuff'] = $this->parser->parse('inside_stuff', $maintable, true);

//            $this->data['mainview'] = 'mainview';
            $this->data['mainview'] = $this->parser->parse('mainview', $main_data, true);
            
            $this->data['side'] = $this->parser->parse('side', $sidetable, true);

 //           $this->data['sideview'] = 'sideview';
            $this->data['sideview'] = $this->parser->parse('sideview', $side_data, true);
*/
            
            
	}
       /*
       public function getStock(){
            $this->load->model('stock');
            $result = $this->Stock->all();

            $list = array();
            foreach($result as $list){
                    $this = array(
                            'name' => $list->Name,
                            'Value' => $list->Value		
                    );
                    $list[] = $this;
            }
            return $list;
        }
    
        public function getPlayer(){
            $this->load->model('player');
            $result = $this->Player->all();

            $list = array();
            foreach($result as $list){
                    $this = array(
                            'Player' => $list->Profile,
                            'Cash' => $list->Cash		
                    );
                    $list[] = $this;
            }
            return $list;
           }
        */
}
