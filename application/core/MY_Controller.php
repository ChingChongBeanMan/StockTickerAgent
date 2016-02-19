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

        //Login
        if($this->session->userdata('username')) {
            $this->data['login-menu'] = $this->parser->parse('logout_menu', $this->data, true);         
        }
        else {
            $this->data['login-menu'] = $this->parser->parse('login_menu', $this->data, true);
        } 
    }

    /**
     * Render this page
     */
    function render()
    {
        $this->data['menubar'] = $this ->parser->parse('_menubar', $this->config->item('menu_choices'),true);
		$this->data['content'] = $this ->parser->parse('mainmaster', $this->config->item('menu_choices'),true);
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }
}
