<?php
/* database wrapper codebase reuseability  PDO
for the sole reason that we can then define the type of database we will be working with ... MYsql
*/
/* singelton pattern  where you don't instantiate classes by new bd instated you call a get instance */

require_once 'core/init.php';


class UserDirectory {
    private static $_instance = null;
    private $_pdo, $_query, $_error = FALSE, $_results, $_Count = 0;

    private function __construct() {
        try {
            $this -> _pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch(PDOExeption $e) {
            die($e -> getMessage());
        }
    }

    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new UserDirectory();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array()){
        $this-> _error = false;
        if($this-> _query = $this-> _pdo->prepare($sql)) {
            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    $this-> _query->bindValue($x, $param);
                    $x++;
                }            }
            if($this->_query->execute()){
                $this -> _results = $this -> _query -> fetchAll(PDO::FETCH_OBJ);
                $this -> _count = $this -> _query -> rowCount();
            } else {
                $this -> _error =true;
            }
        }

        return $this;
    }

    public function selects($selects, $table, $where = array()) {
        if(count($where) === 3) {
            $operators = array('=', '>', '<', '<=', '>=');
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if(in_array($operator, $operators)) {
                $sql = "{$selects} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this -> query($sql, array($value))-> error()) {
                    return $this;
                }
            }
        }
        return FALSE;
    }

    public function gets($table, $where) {
        return $this -> selects('SELECT *', $table, $where);
    }

    public function delete($table, $where) {
        return $this -> selects('DELETE', $table, $where);
    }

    public function results() {
        return $this -> _results;
    }

    public function first() {
        return $this -> results()[0];
    }

    public function enter($table, $fields = array()) {
        $key = array_keys($fields);
        $val = '';
        $cnt = 1;

        foreach($fields as $field) {
            $val .= '?';
            if($cnt < count($fields)) {
                $val .= ', ';
            }
            $cnt++;
        }

        $sql = "INSERT INTO account (`" . implode('`, `', $key) . "`) VALUES ({$val})";

        if($this -> query($sql, $fields)) {
            return true;
        }
        return false;
    }

    /*  public function update($table, $accountID, $fields) {
              $up = '';
              $counter = 1;

              foreach($fields as $name => $vals) {
                  $up .= "{$name} = ?";
                  if($counter < count($fields)) {
                      $up .= ', ';
                  }
                  $counter++;
              }
              $sql = "UPDATE ($table) SET {$up} WHERE accountID = {$accountID}";

              if(!$this -> query($fields, $sql) -> error()) {
                  return true;
              }
              return false;
      }  */
    public function error() {
        return $this -> _error;
    }

    public function count() {
        return $this -> _count;
    }
}
