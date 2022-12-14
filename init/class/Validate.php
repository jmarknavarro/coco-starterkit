<?php
class Validate{
    private $_passed = false,
            $_errors = array(),
            $_db = null;

        public function __construct(){
            $this->_db = DB::getInstance();
        }

        public function check($source, $items =array()){
            foreach ($items as $item => $rules) {
                foreach ($rules as $rule => $rule_value) {
                    $value = trim($source[$item]);
                    $item = escape($item);

                    if($rule=== 'required' && empty($value)){
                        if($rule_value == 'true'){
                            $this->addError(strtoupper($item)." is required.");
                    
                          }else {
                            $this->addError(strtoupper($rule_value)." is required.");
                        }
                        
                    } else if(!empty($value)){
                        switch($rule){
                            case 'min':
                                if(strlen($value) < $rule_value){
                                    $this->addError(strtoupper($item)." must be minimum of {$rule_value} character");
                                }
                            break;
                            case 'max':
                                if(strlen($value) > $rule_value){
                                    $this->addError(strtoupper($item)." must be minimum of {$rule_value} character");
                                }
                            break;
                            case 'matches':
                                if($value != $source[$rule_value]){
                                    $this->addError(strtoupper($rule_value)." must match ".strtoupper($item));
                                }
                            break;
                            case 'matches_sesssion':
                                if($value != $_SESSION[$rule_value]){
                                    $this->addError("Invalid Transaction ID");
                                }
                            break;
                            case 'unique':
                                $check = $this->_db->get($rule_value, array($item,'=',$value));
                                if($check->count()){
                                    $this->addError(strtoupper($value)." is already exists.");
                                }
                            break;
                            case 'numeric':
                                if(!preg_match('/^[0-9]+(\\.[0-9]+)?$/', $value)){
                                    $this->addError(strtoupper($item)." must input numbers only");
                                }
                            break;
                            case 'schoolyear':
                                if(!preg_match('/^\d{4}-\d{4}$/', $value)){
                                    $this->addError("Please follow school year format: (XXXX-XXXX)");
                                }
                            break;
                            case 'maxnumber':
                                if (($value < 1 || $value > $rule_value)) {
                                    $this->addError("Please only type numbers from 1 to {$rule_value}.");
                                }
                            break;
                        }

                    }
                }
            }
            if(empty($this->_errors)){
                $this->_passed =true;
            }
            return $this;
        }
        private function addError($errors){
            $this->_errors[] = $errors;

        }
        public function errors(){
            return $this->_errors;
        }

        public function passed(){
            return $this->_passed;
        }

}
 ?>
