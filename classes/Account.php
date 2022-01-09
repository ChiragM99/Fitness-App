<?php
class Account {

    private $_ud, $_data, $_isLoggedIn, $_sessionName,$_accID;

    public function __construct($account = null) {
        $this -> _ud = UserDirectory::getInstance();
        $this -> _sessionName = Config::get('session/session_name');

        if(!$account) {
            if(Session::exists($this -> _sessionName)) {
                $account = Session::get($this -> _sessionName);
                $this-> _accID = $account;
                if($this -> find($account)) {

                    $this -> _isLoggedIn = TRUE;
                } else {
                    //process logout
                }
            }
        } else {
            $this -> find($account);
        }
    }

    public function create($fields = array()) {
        if(!$this -> _ud -> enter('account', $fields)) {
            throw new Exception('There was a problem creating an account');
        }
    }

    public function find($account = null) {
        if($account) {
            $field = (is_numeric($account)) ? 'accountID' : 'userName';
            $data = $this -> _ud -> gets('account', array($field, '=', $account));

            if($data -> count()) {
                $this -> _data = $data -> first();
                return TRUE;
            }
        }
        return FALSE;
    }

    public function login($username = null, $password = null) {
        $account =$this -> find($username);
        if($account)
        {
            if(password_verify($password, $this -> data() -> password))
            {
                Session::put($this -> _sessionName, $this -> data() -> accountID);
                return true;
            }
        }
        return false;
    }

    public function hasPermission($key) {
        $permission = $this -> _ud -> gets('permissions', array('accountID', '=', $this -> data() -> permission));
        if($permission) {
            $permissions = json_decode($permission -> first() -> permissions, true);
            if($permissions[$key] == true) {
                return true;
            }
        }
        return false;
    }

    public function exists() {
        return (!empty($this -> _data)) ? true : false;
    }

    public function update($fields = array(), $accountID = null) {

        if(!$accountID && $this -> isLoggedIn()) {
            $accountID = $this -> data() -> accountID;
        }

        if(!$this-> _ud -> update('account', $accountID, $fields)) {
            throw new Exception('There was a problem updating.');
        }
    }

    public function isLoggedIn() {
        return $this-> _isLoggedIn;
    }

    public function getaccID() {
        return $this-> _accID;
    }

    public function logout() {
        Session::delete($this -> _sessionName);
    }

    public function data() {
        return $this -> _data;
    }

}
