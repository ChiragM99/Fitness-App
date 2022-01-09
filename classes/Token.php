
<?php
//Token should be same as sesssion to ensure user actions are not performed by another session
//Generates token then deletes it when loading page to ensure session = token
class Token {
    public static function generate() {
        return Session::put(Config::get('session/token_name'), md5(uniqid()));
    }
//Checks if token exists to get it from the session and if its the same as the token in the form
    public static function check($token) {
        $tokenName = Config::get('session/token_name');
        //If token = session, return true(deleteit) and token applied to form is = to token name
        if(Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }
}
