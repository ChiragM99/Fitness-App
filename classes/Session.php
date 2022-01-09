<?php
class Session {

    //Check if session exists
    public static function exists($name) {
        //If the token is set return rtue
        return (isset($_SESSION[$name])) ? TRUE : FALSE;
    }

    //Return the value of the session and its name
    public static function put($name, $value) {
        return $_SESSION[$name] = $value;
    }

    // Get a value of the session
    public static function get($name) {
        return $_SESSION[$name];
    }

    //Delete token
    public static function delete($name) {
        //Check if token exists
        if(self::exists($name)) {
            //Unset it
            unset($_SESSION[$name]);
        }
    }

    public static function flash($name, $string = '') {
        if(self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        }
    }
}
