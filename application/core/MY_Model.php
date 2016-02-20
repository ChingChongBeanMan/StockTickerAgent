<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


//the model of table which has 1 primary key
class MY_Model extends CI_Model {
    protected $_tableName;            // Which table is this a model for?
    protected $_keyField;             // name of the primary key field

    // Constructor
    function __construct($tablename = null, $keyfield = 'id') {
        parent::__construct();
        $this->_tableName = $tablename;
        $this->_keyField = $keyfield;
    }

    //get all value from the table if $what is $which
    function some($what, $which) {
        $this->db->order_by($this->_keyField1, 'desc');
        $this->db->where($what, $which);
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
    
    //get all value in certain column's desc order
    function allInOrder($what) {
        $this->db->order_by($what, 'desc');
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
    
    //get all value from table
    function all() {
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
}

// the model for table which has 2 primary key
class MY_Model2 extends MY_Model {
       protected $_keyField2;                 // second part of composite primary key

    // Constructor
    function __construct($tablename = null, $keyfield = 'id', $keyfield2 = 'part') {
        parent::__construct($tablename, $keyfield);
        $this->_keyField2 = $keyfield2;
    }

    //get al
    function some($what, $which) {
        $this->db->order_by($this->_keyField2, 'desc');
        $this->db->where($what, $which);
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }

}
/* End of file */



