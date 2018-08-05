<?php
class Data { 
    public $_db;
    public function __construct($user = null) {
        $this->_db = DB::getInstance();
    }
 
    public function getdata($table, $where) { # $where => username == dhpradeep
        $check =  $this->_db->action('SELECT *', $table, $where);
        return $check; 
    }
    
    public function deletedata($table,$where) {
        $check = $this->_db->action('DELETE ',$table,$where);
        return $check;
    }

    public function getmultipledata($query,$params = array())
    {
        $check = $this->_db->query($query,$params);
        return $check;
    }

    public function getsomedata($table, $data, $where)
    {
        $check =  $this->_db->action($data, $table, $where);
        return $check;
    } 
}