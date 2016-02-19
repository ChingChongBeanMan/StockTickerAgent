
<?php
class Transaction extends CI_Model {
    public $player;
    public $cash;
    public function __construct()
    {
            parent::__construct();
    }
    /*
     *      * Gets all the entries from the players table
     *           */
    function get_all()
     {
       $query = $this->db->query('SELECT * FROM transaction ORDER BY Datetime DESC');
       return $query;
     }
     function details($i)
     {
       $query = $this->db->query('SELECT * FROM transactions WHERE Stock = "' . $i .'" ORDER BY Datetime DESC');
       return $query;
     }
     function get_player_transaction($i)
     {
        $query = $this->db->query('SELECT DateTime, Stock, Trans, Quantity FROM transactions where Player = "' . $i. '" ORDER BY DateTime DESC');
        return $query;
     }
}
