<?php
class Validation {
    private $_passed = false,
            $_errors = array(),
            $_ud = null;

    public function __construct() {
        $this -> _ud = UserDirectory::getInstance();
    }

    public function check($source, $items = array()) {
        foreach($items as $item => $rules) {
            foreach($rules as $rule => $rule_value) {
                $value = trim($source[$item]);
                $item = escape($item);
                $disp_text = $rules['disp_text'];
                if($rule === 'required' && empty($value)) {
                    $this -> addError("{$disp_text} is required");
                } else if(!empty($value)) {
                    switch($rule) {
                        case 'min':
                            if(strlen($value) < $rule_value) {
                                $this -> addError("{$disp_text} must be a minimum of {$rule_value} characters");
                            }

                        break;
                        case 'max':
                            if(strlen($value) > $rule_value) {
                                $this -> addError("{$disp_text} must be a maximum of {$rule_value} characters");
                            }

                        break;
                        case 'matches':
                            if($value != $source[$rule_value]) {
                                $this -> addError("{$rule_value} must match {$disp_text}");
                            }

                        break;
                        case 'unique':
                            $check = $this -> _ud -> gets($rule_value, array($item, '=', $value));
                            if($check -> count()) {
                                $this -> addError("{$disp_text} already exists.");
                            }
                        break;
                    }
                }
            }
        }

        if(empty($this -> _errors)) {
            $this -> _passed = true;
        }
        return $this;
    }

    private function addError($error) {
        $this -> _errors[] = $error;
    }

    public function errors() {
        return $this -> _errors;
    }

    public function passed() {
        return $this -> _passed;
    }
}
