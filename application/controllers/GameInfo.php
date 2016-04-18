<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GameInfo extends MY_Controller {
        protected $defaultInfo;
        protected $defaultData;
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
                $data['pagetitle'] = 'Game Status';
                $temp = array();
                $temp['round']    = '-';
                $temp['state']    = '-';
                $temp['current']  = '-';
                $temp['desc']     = '-';
                $temp['duration'] = '-';
                $temp['upcoming']='-';
                $temp['alarm']    = '-';
                $temp['now']      = '-';  
                $temp['countdown']= '-';  
                $this->defaultData = array($temp);
                $this->defaultInfo = array('code'=>'-',
                                           'name'=>'-',
                                           'category'=>'-',
                                           'value'=>'-');
	}
        
        
        
        //Loads the page
	public function index()
	{
           //Load library and models
            $this->load->database();
            $this->load->model('GameInfos');
            $this->load->model('Stock');
            $this->data['pagebody'] = 'GameInfo';
            $this->data['temptitle'] = 'Check Status';
            $this->data['temp2title'] = 'Data Check';
            if($this->GameInfos->xmlConnect()){
                $infosave = $this->GameInfos->getInfo();
                $this->data['information'] = $infosave;
                $url = BSXPATH."data/stocks";

                $stockTest = $this->GameInfos->ImportCSV2Array($url);
                $this->data['stockInfo'] = $stockTest;

            }
            else{
                
                $this->data['information'] = $this->defaultInfo;
                $this->data['stockInfo']=$this->defaultInfo;
            }
                
            $this->render();
        }
    
}