<?php

class DB {
    private static $_instance = null;
    public $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_lastid,
            $_count = 0;

    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array()) {
        $this->_error = false;

        if($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if(count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            
            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
                $this->_lastid = $this->_pdo->lastInsertId();
            } else {
                $this->_error = true;
            }
        }
 
        return $this;
    }

    public function action($action, $table, $where = array()) {
        if(count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<='); #these are only available operators in sql

            $field = $where[0]; # username
            $operator = $where[1]; # =,<,>,<=
            $value = $where[2]; # dhpradeep

            if(in_array($operator, $operators)) {
                # select * from users where username = dhpradeep
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                //echo $sql; 
                if(!$this->query($sql, array($value))->error()) { #if that is not an error
                    return $this;
                }
            }
        }
        return false;
    }

    public function insert($table, $fields = array()) {
        $keys = array_keys($fields);
        $values = null;
        $x = 1;

        foreach($fields as $field) {
            $values .= '?';
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }
 
    public function update($table, $id, $fields) {
        $set = '';
        $x = 1;

        foreach($fields as $name => $value) {
            $set .= "{$name} = ?";
            if($x < count ($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
        if(!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    public function delete($table, $where) {
        return $this->action('DELETE ', $table, $where);
    }

    public function get($table, $where) { # $where => username == dhpradeep
        return $this->action('SELECT *', $table, $where);
    }

    public function results() {
        return $this->_results;
    }

    public function first() {
        $data = $this->results();
        return $data[0];
    }

    public function count() {
        return $this->_count;
    }

    public function error() {
        return $this->_error;
    }
}