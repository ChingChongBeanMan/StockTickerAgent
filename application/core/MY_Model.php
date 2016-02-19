
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Model extends CI_Model {
    protected $_tableName;            // Which table is this a model for?
    protected $_keyField;             // name of the primary key field
                // second part of composite primary key
    // Constructor
    function __construct($tablename = null, $keyfield = 'id') {
        parent::__construct();
        $this->_tableName = $tablename;
        $this->_keyField = $keyfield;
    }

    // Determine if a key exists
    function exists($key1, $key2) {
        $this->db->where($this->_keyField, $key1);
        $query = $this->db->get($this->_tableName);
        if ($query->num_rows() < 1)
            return false;
        return true;
    }
//---------------------------------------------------------------------------
//  Composite functions
//---------------------------------------------------------------------------
    // Return all records associated with a member
    function group($key) {
        $this->db->where($this->_keyField, $key);
        $this->db->order_by($this->_keyField, 'asc');
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
    
    function some_sum($key, $what, $which) {
        $this->db->where($this->_keyField, $key);
        $this->db->where($what, $which);
        $this->db->select_sum($what);
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }    
    function some($what, $which) {
        $this->db->order_by($this->_keyField1, 'desc');
        $this->db->where($what, $which);
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
    function personalAll($key) {
        $this->db->where($this->_keyField, $key);
        $this->db->order_by($this->_keyField, 'desc');
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
    function all() {
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
}


class MY_Model2 extends MY_Model {
       protected $_keyField2;                 // second part of composite primary key
    // Constructor
    function __construct($tablename = null, $keyfield = 'id', $keyfield2 = 'part') {
        parent::__construct($tablename, $keyfield);
        $this->_keyField2 = $keyfield2;
    }

    // Determine if a key exists
    function exists($key1, $key2) {
        $this->db->where($this->_keyField, $key1);
        $this->db->where($this->_keyField2, $key2);
        $query = $this->db->get($this->_tableName);
        if ($query->num_rows() < 1)
            return false;
        return true;
    }
//---------------------------------------------------------------------------
//  Composite functions
//---------------------------------------------------------------------------
    // Return all records associated with a member
    function group($key) {
        $this->db->where($this->_keyField, $key);
        $this->db->order_by($this->_keyField, 'asc');
        $this->db->order_by($this->_keyField2, 'asc');
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
    
    function some_sum($key, $what, $which) {
        $this->db->where($this->_keyField, $key);
        $this->db->where($what, $which);
        $this->db->select_sum($what);
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }    
    function some($what, $which) {
        $this->db->order_by($this->_keyField2, 'desc');
        $this->db->where($what, $which);
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
    function personalAll($key) {
        $this->db->where($this->_keyField, $key);
        $this->db->order_by($this->_keyField, 'desc');
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
    function all() {
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
}
/* End of file */



