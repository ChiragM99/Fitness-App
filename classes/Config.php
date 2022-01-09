<?php
class Config {
    public static function get($path = null) {
        if($path) {
            $config = $GLOBALS['config'];
      //Take character to explode and reutrn an array
            $path = explode('/', $path);

            foreach($path as $bits) {
                if(isset($config[$bits])) {
                  //Set config to required bit(set host to bit)
                    $config = $config[$bits];
                }
            }
            return $config;
        }
        return false;
  }
}
