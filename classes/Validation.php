<?php

require_once __DIR__.'/validationAbstract.php';

class Validation extends ValidateAbstract {

    public $error = array();
    private $formdata = array();
    private $form_is_valid = 1;

    public function _construct() {

    }

    public function validate() {
        $this->formdata = filter_input_array(INPUT_POST);
    }

    public function valid($name, $label, $valid_type, $custom_msg = NULL, $same_as_control_name=NULL) {
        $validation_type = explode('|', rtrim($valid_type, '|'));
        foreach ($validation_type as $validate)
		{
            if ($validate == "trim")
			{
                $val = trim($this->formdata[$name]);
			}else{
                $is_true = $this->call_validation($validate, $this->formdata[$name]);
                if ($is_true === 1){
                    $val = $this->formdata[$name];
				}elseif ($is_true === 2){
                    $this->set_error($name, "Validation Method Not Exists");
				}else{
                    if (strpos($validate, '[') !== false)
					{
                        $expMethod = explode('[', $validate,2);
                        $validate = $expMethod[0];
                        $arg2 = str_replace(']', '', $expMethod[1]);
                        if (method_exists($this, $validate))
						{
							if($validate=="equalTo"){
								$msg = $this->set_message($validate, $name, $label, $same_as_control_name, $custom_msg);
								$this->set_error($name, $msg);
							}else{
								$msg = $this->set_message($validate, $name, $label, $arg2, $custom_msg);
								$this->set_error($name, $msg);
							}
						}
					}else{
                        $msg = $this->set_message($validate, $name, $label, $this->formdata[$name], $custom_msg);
                        $this->set_error($name, $msg);
                        $val = $this->formdata[$name];
                    }
                }
            }
        }
        return $val;
    }

    private function call_validation($functionName, $value) {
        $respone = 2;
        if (method_exists($this, $functionName)){
            $respone = $this->$functionName($value);
		}else{
            if (strpos($functionName, '[') !== false){
                $expMethod = explode('[', $functionName,2);
                $functionName = $expMethod[0];
                $arg2 = str_replace(']', '', $expMethod[1]);
                if (method_exists($this, $functionName)){
                    if($functionName=="equalTo"){
                        $respone = $this->$functionName($value,$this->formdata[$arg2],$value);
					}else{
                        $respone = $this->$functionName($value,$arg2);
                    }
                }
            }
        }
        return $respone;
    }

    private function set_message($method_name, $name, $label, $val, $message = NULL) {
        if (empty($message)){
            if (empty($label)){
                return "{$name} " . $this->method_msg($method_name, $val);
			}else{
                return "{$label} " . $this->method_msg($method_name, $val);
            }
		}else{
            return $message;
        }
    }

    private function method_msg($method_name, $val = NULL) {
        switch ($method_name) {
            case "numeric": $msg = "is must be in numeric";
                break;
            case "email": $msg = "not valid!";
                break;
            case "alphabetic": $msg = "only alphabets!";
                break;
            case "alphanumeric": $msg = "only alpha numeric!";
                break;
            case "url": $msg = "not valid url";
                break;
            case "phone": $msg = "not valid phone";
                break;
            case "date": $msg = "not valid date";
                break;
            case "equalTo": $msg = "same as $val!";
                break;
            case "min_length": $msg = "minimum characters $val";
                break;
            case "max_length": $msg = "maximum characters $val";
                break;
            default:
                $msg = "is must be required!";
                break;
		}
        return $msg;
    }

    private function set_error($name, $message) {
        $this->form_is_valid = 0;
        $this->error["error_" . $name] = $message;
    }

    public function is_valid() {
        return $this->form_is_valid;
    }

    public function error($error_control) {
        if (isset($this->error[$error_control]) && !empty($this->error[$error_control]))
		{
            return $this->error[$error_control];
		}else{
            return '';
		}
    }

}
