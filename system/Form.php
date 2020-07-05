<?php
class Form{

    public $key;
    public $values= array();
    public $errors= array();

    public function __construct(){}

    public function post($name){

        $this->values[$name]=   trim($_POST[$name]);
        $this->key=  $name;
        return $this;

    }

    public function isEmpty(){
       if(empty($this->values[$this->key])){
           $this->errors[$this->key]['empty']= "$this->key is required";
       }
       return $this;
    }

    public function length($min, $max){

        $length= strlen($this->values[$this->key]);
        $key_name= ucfirst($this->key);
        if( $length < $min || $length > $max ){
            $this->errors[$this->key]['length']= "$key_name must be $min characters at least";
        }
        return $this;
    }

    public function email(){
        if(!filter_var($this->values[$this->key], FILTER_VALIDATE_EMAIL)){
            $this->errors[$this->key]['email']= "Invalid email format";
        }
        return $this;
    }

    public function password(){

        $uppercase = preg_match('@[A-Z]@', $this->values[$this->key]);
        $lowercase = preg_match('@[a-z]@', $this->values[$this->key]);
        $number    = preg_match('@[0-9]@', $this->values[$this->key]);

        if(!$uppercase || !$lowercase || !$number){
            $this->errors[$this->key]['password'] = "Password must contain uppercase, lowercase and numbers";
        }
        return $this;
    }

    public function confirm_pass($pass){

        if(empty($this->errors[$this->key]['password'])){

            if($this->values[$this->key] != $this->values[$pass]){
                $this->errors[$this->key]['confirm-pass']= "Password is not matched";
            }
        }
        return $this;
    }

    public function date_limit($min, $max){

        if(date($this->values[$this->key]) < $min || date($this->values[$this->key]) > $max ){
            $this->errors[$this->key]['date_error'] = "Invalid date";
        }
        return $this;
    }

    public function submit(){

        if(empty($this->errors)){
            return true;
        }else{
           return false;
             }
    }

}