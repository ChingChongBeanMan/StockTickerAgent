<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GameInfo extends MY_Controller {

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
                $this->data['pagetitle'] = 'Game Status';
	}
        //Loads the page
	public function index()
	{
           //Load library and models
            $this->load->database();
            $this->load->model('GameInfos');
            $this->data['pagebody'] = 'GameInfo';
            $this->data['temptitle'] = 'Check Status';
            $infosave = $this->GameInfos->getInfo();
            $testparse = $this->parser->parse('GameInfo',$infosave, true);
            $this->data['information'] = $testparse;
            $this->data['information'] = $infosave;
             $this->render();
        }
    
}
