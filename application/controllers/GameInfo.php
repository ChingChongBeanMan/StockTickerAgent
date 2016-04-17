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
            $this->load->model('Stock');
            $this->data['pagebody'] = 'GameInfo';
            $this->data['temptitle'] = 'Check Status';
            $this->data['temptitle'] = 'Data Check';
            $infosave = $this->GameInfos->getInfo();
            $this->data['information'] = $infosave;
            $url = BSXPATH."data/stocks";
            
            $stockTest = $this->GameInfos->ImportCSV2Array($url);
            $this->data['stockInfo'] = $stockTest;
            
            
            $this->render();
        }
    public function buyStocks($stockName){
        //echo $stockName;
        $url = DATAPATH . '/buy';
        $data = array('team' => 'o11',
                                'token' => 'b218abc762c363ab7a665162c9c391e1',
                                'player' => 'Donald',
                                'stock' => $stockName,
                                'quantity' => '1' );

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }

        var_dump($result);
    }
}