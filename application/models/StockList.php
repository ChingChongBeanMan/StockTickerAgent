<?php


class stockList extends MY_Model2 {
    // constructor
    function __construct() {
        parent::__construct('transactions','Stock','DateTime');
    }
    
}
