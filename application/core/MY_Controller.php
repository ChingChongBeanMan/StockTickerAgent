<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */
    function __construct()
    {
        parent::__construct();
        $this->data['title'] = 'Stocks';
        $this->errors = array();
        $this->data['pagetitle'] = 'Stock Game';
	$this->load->helper('html');
        $this->load->helper('url');
    }

    /**
     * Render this page
     */
    function render()
    {
        //Login
        if($this->session->userdata('username')) {
            $this->data['login-menu'] = '<button type="button" class="btn btn-primary btn-lg outline">
				<a href="/Portfolio/logout"><font color="white">LOGOUT</font></a></button>';      
        }
        else {
            $this->data['login-menu'] = '<button type="button" class="btn btn-primary btn-lg outline">
				<a href="/Portfolio/login"><font color="white">LOGIN</font></a></button>';
        } 

        //$this->data['login-menu'] = $this->parser->parse('login_menu', $this->data, true);

        $x = $this->config->item('menu_choices');
        $x['login-menu'] = $this->data['login-menu'];
        $choicesss = array('menudata' => $this->makemenu());
        $this->data['menubar'] = $this ->parser->parse('_menubar', $choicesss,true);


	$this->data['content'] = $this ->parser->parse('mainmaster', $this->config->item('menu_choices'),true);
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }
     function restrict($roleNeeded = null){
         
            $userRole = $this->session->userdata('userRole');
            if ($roleNeeded != null) {
                if (is_array($roleNeeded)) {
                    if (!in_array($userRole, $roleNeeded))
                    {
                        redirect("/");
                        return;
                    }
                } else if ($userRole != $roleNeeded) {
                    redirect("/");
                    return;
                }
            }
        }
        function makemenu()
	{
		$choices = array();
                $choices[] = array('name' => "Main", 'link' => '/index.php');
                $choices[] = array('name' => "History", 'link' => '/history');
                $choices[] = array('name' => "Portfolio", 'link' => '/portfolio');

                if($this->session->userdata('userRole') == NULL){
                    $choices[] = array('name' => "Login", 'link' => '/Portfolio/login');
                    return $choices;
                }
                if($this->session->userdata('userRole') == 'player'){
                    $choices[] = array('name' => "GameInfo", 'link' => '/gameinfo');
                    $choices[] = array('name' => "Logout", 'link' => '/Portfolio/logout');
                    return $choices;
                      
                }
                if($this->session->userdata('userRole') == 'admin'){
                    $choices[] = array('name' => "GameInfo", 'link' => '/gameinfo');
                    $choices[] = array('name' => "admin", 'link' => '/admin');
                    $choices[] = array('name' => "Buy and Sell", 'link' => '/stockmanager');
                    $choices[] = array('name' => "Logout", 'link' => '/Portfolio/logout');
                    return $choices;
                      
                }
                return 'joseph';
		
	}
       
}

