 <?php
class History extends My_Controller{

     function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->data['pagetitle'] = 'Stocks';
		
	}
    //Generates the dropdown menu for user to select different stocks
    function gendropdown(){
        $this->load->model('Stocks');
        //Get all stocks
        $result = $this->Stocks->all();
        $output = '';
        //Loop through stocks, add to view
        foreach($result as $row){
            $this1 = array(
               'stockname' => $row->Code,   
            );
            $lists[] = $this1; 
        }
        //Set data
        $this->data['dropdown'] = $lists;
    }
    //Gets a users stock history
    function stockhistory($stock){
        //Load models
        $this->load->model('StockList');
        $this->load->model('MovementList');
        $this->load->model('Stock');
        $this->load->model('GameInfos');
        $this->load->library('parser');
        $this->data['title'] = 'Stock History';
        $url = BSXPATH."data/stocks";
        $stockAll = $this->GameInfos->ImportCSV2Array($url);
        $this->Stock->redoStocks($stockAll);
        $url = BSXPATH."data/movement";
        $stockTest = $this->GameInfos->ImportCSV2Array($url);
        $this->Stock->redoMovement($stockTest);
        $url = BSXPATH."data/transaction";
        $transactions = $this->GameInfos->ImportCSV2Array($url);
        $this->Stock->redoTransactions($transactions);
        $this->db->select('*');
        $this->db->from('movements');
        $this->db->join('stocks', 'movements.code = stocks.code' );
        $query = $this->db->get();
         //var_dump($query->result());
        //Query to get a users stock history
        $result = $this->StockList->some('Stock',$stock);
        $parse = '';
        //Loop through, check for buy/sell for image and add to data
        foreach($result as $row){
            if($row->Trans == 'buy'){
                $row->Trans = '/assets/buy.png';
            }
            else if($row->Trans == 'sell'){
                $row->Trans = '/assets/sell.png';
            }
           $parse .= $this->parser->parse('stocktransactionstable', $row, true);

        }
        //Get all stock movements for given stock
        $result2 = $this->MovementList->some('Code', $stock);
        $movparse = '';
        //Parse the movements into table
        foreach($result2 as $row){
            //check which type of movement and assign image
            if($row->Action == 'down'){
                $row->Action = 'assets/down.png';
            }
            elseif($row->Action == 'up'){
                $row->Action = 'assets/up.png';
            }
            elseif($row->Action == 'div'){
                $row->Action = 'assets/div.png';

            }
            $movparse .= $this->parser->parse('movementtable', $row, true);
        }
        //Call to generate the dropdown menu. set data and render
       $this->gendropdown();
       $this->data['intro'] = $stock;
       $this->data['movement_history'] = $movparse; 
       $this->data['stock_transactions'] = $parse;
       $this->data['pagebody'] = 'stockhistory';
       $this->render();


    }
    //Call to get history if no stock specified
    function generalhistory(){
        //Load models
        $this->load->model('ProfileList');
        $this->load->model('MovementList');
        $this->load->library('parser');
        $this->data['title'] = 'Stock History';  
        //Get the list of all transactions
        $result = $this->ProfileList->allInOrder("DateTime");
        //Get all movements
        $result2 = $this->MovementList->allInOrder("DateTime");
        $mostRecent = NULL;
        
        //Check for the most recent entry
        if(empty($result) && empty($result2)){
            $this->stockhistory($mostRecent);
        }
        if(empty($result)){
            $mostRecent = $result2[0]->Code;
        }
        else if(empty($result2)){
            $mostRecent = $result[0]->Stock;
        }
        else{
            if($result[0]->DateTime >= $result2[0]->Datetime){
                $mostRecent = $result[0]->Stock;
            }
            else{
                $mostRecent = $result2[0]->Code;
            }
        }
        //Call history on the most recent stock
        $this->data['intro'] = 'Most Recently Changed Stock: ' . $mostRecent;
        $this->stockhistory($mostRecent);
}
}