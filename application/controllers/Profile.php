<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

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
        public function __construct()
	{
		parent::__construct();
		//$this->data = array();
		$this->data['pagetitle'] = 'Profile';
		//$this->load->library('parser');
	}
        public function get_holdings($name){
          
            $sql = ("SELECT Stock, Trans, Quantity FROM transactions WHERE Player = ?");
            $qArr = $this->db->query($sql, array($name));
            $totals = array_map();
            foreach($qArr->result() as $row){
            }
        }
        public function history($name){
            $this->load->database();
            $this->load->library('table');
            $this->load->library('parser');
            $sql = ("SELECT DateTime, Stock, Trans, Quantity FROM transactions WHERE Player = ?");
            $qArr = $this->db->query($sql, array($name));
            $result = '';
            foreach($qArr->result() as $row){
                $result .= $this->parser->parse('profiletransactions', $row, true);
                
            }
            $main_data['profile_table'] = $result;
            $this->data['profiletable'] = $this->parser->parse('profiletable', $main_data, true);
            $this->data['pagebody'] = 'profilepage';
            $this->render();
        }
	public function index()
	{
            if ($this->session->userdata('username')) {
                    $this->profile();
            }
            else {
                    $this->login(); 
        }
       
    }
    public function login() {
        if($this->input->post('field-username')) {
                $nData = array('username' => $this->input->post('field-username'));
                $this->session->set_userdata($nData);
                $this->data['login-menu'] = $this->parser->parse("logout_menu", $this->data, true);
                $this->index();
            } else {
                $this->data['pagetitle'] = "Login";
                $this->data['page'] = 'login';
                $this->data['pagecontent'] = 'login';
                $this->data['pagebody'] = 'login';
                $this->render();
              }
        }
    public function logout(){
        $this->session->unset_userdata('username');
        $this->data['login-menu'] = $this->parser->parse("login_menu", $this->data, true);
        $this->index();
    }


	public function profile() { 
        $this->data['pagetitle'] = $this->session->userdata('username');
        $this->data['player-activity'] = $this->trade_activity($this->session->userdata('username'));
        $this->data['pagecontent'] = 'profilepage';
        $this->data['pagebody'] = 'profilepage';
        $this->data['page'] = 'profilepage';
        $this->render();
    } 
}
