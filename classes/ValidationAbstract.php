<?php

abstract class ValidateAbstract {

    protected function required($value) {
        $val = trim($value);
        return (empty($val)) ? 0 : 1;
    }

   
    protected function numeric($value) {
        return !(empty($value)) ? ((preg_match("/^([0-9]*)$/", $value)) ? 1 : 0) : 0;
      
    }

    protected function email($value) {
        return !(empty($value)) ? ((filter_var($value, FILTER_VALIDATE_EMAIL)) ? 1 : 0) : 0;
    }

    protected function alphabetic($value) {
        return !(empty($value)) ? ((preg_match("/^[a-zA-Z ]*$/", $value)) ? 1 : 0) : 0;
    }

    protected function alphanumeric($value) {
        return !(empty($value)) ? ((preg_match("/^[-_a-zA-Z0-9. ]*$/", $value)) ? 1 : 0) : 0;
    }

    protected function url($value) {
        return !(empty($value)) ? ((filter_var($value, FILTER_VALIDATE_URL)) ? 1 : 0) : 0;
    }

    
    protected function phone($value) {
        return !(empty($value)) ? ((preg_match("/^\+?[0-9\-]+\*?$/", $value)) ? 1 : 0) : 0;
    }

  
    protected function date($value) {
        $val = date("Y-m-d", strtotime($value));
        return ($val == "1970-01-01" || $val == "0000-00-00") ? 0 : 1;
    }


    protected function equalTo($value1, $value2) {
        return !(empty($value1)) ? (($value1 == $value2) ? 1 : 0) : 0;
    }

   
    protected function min_length($value1, $value2) {
        return !(empty($value1)) ? ((strlen($value1) <= $value2) ? 1 : 0) : 0;
    }

    protected function max_length($value1, $value2) {
        return !(empty($value1)) ? ((strlen($value1) >= $value2) ? 1 : 0) : 0;
    }

}
?>
