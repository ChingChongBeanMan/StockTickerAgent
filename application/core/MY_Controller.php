<<<<<<< HEAD
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
    }

    /**
     * Render this page
     */
    function render()
    {
        //Login
        if($this->session->userdata('username')) {
            $this->data['login-menu'] = '<a class="btn btn-primary btn- lg" href="/Portfolio/logout">LOGOUT</a>';//$this->parser->parse('logout_menu', $this->data, true);         
        }
        else {
            $this->data['login-menu'] = '<a class="btn btn-primary btn- lg" href="/Portfolio/login/">LOGIN</a>';//$this-> parser->parse('login_menu', $this->data, true);
        } 

        //$this->data['login-menu'] = $this->parser->parse('login_menu', $this->data, true);

        $x = $this->config->item('menu_choices');
        $x['login-menu'] = $this->data['login-menu'];

        $this->data['menubar'] = $this ->parser->parse('_menubar', $x,true);


		$this->data['content'] = $this ->parser->parse('mainmaster', $this->config->item('menu_choices'),true);
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }
}
=======
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
    }

    /**
     * Render this page
     */
    function render()
    {
        //Login
        if($this->session->userdata('username')) {
            $this->data['login-menu'] = '<button type="button" class="btn btn-primary btn-lg outline">
				<a href="/Portfolio"><font color="white">LOGIN</font></a></button>';      
        }
        else {
            $this->data['login-menu'] = '<button type="button" class="btn btn-primary btn-lg outline">
				<a href="/Portfolio"><font color="white">LOGOUT</font></a></button>';
        } 

        //$this->data['login-menu'] = $this->parser->parse('login_menu', $this->data, true);

        $x = $this->config->item('menu_choices');
        $x['login-menu'] = $this->data['login-menu'];

        $this->data['menubar'] = $this ->parser->parse('_menubar', $x,true);


		$this->data['content'] = $this ->parser->parse('mainmaster', $this->config->item('menu_choices'),true);
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }
}
>>>>>>> 444dcb2020a229d7f8af7f0ac0820b515080b0e8
