<?php
class AuthModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public $table_name="users";

    public function login($bind){

           $field_name= "id,login,pass";
           $where= "WHERE login = :login AND pass = :pass";
    return $this->db->select($this->table_name, $field_name,'fetch', $where, $bind);

    }

    public function signup($data){

            $this->db->insert($this->table_name, $data);
    }

    public function user_check($bind){

            $field_name= "login";
            $where= "WHERE login=:login";
     return $this->db->select($this->table_name, $field_name,'fetchAll', $where, $bind);
    }

}