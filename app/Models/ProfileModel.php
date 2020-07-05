<?php
class ProfileModel extends Model{

    public function __construct(){
        parent:: __construct();
    }

    public $table_name= "users";

    public function user_info($bind){

           $field_name= "id, login, mobile, email, role, birthday, about, image";
           $where= "WHERE login= :login AND pass = :pass";
    return $this->db->select( $this->table_name, $field_name,'fetch', $where, $bind);
   }

   public function user_edit($bind){

           $set=   "SET mobile=:mobile, role=:role, email=:email, birthday=:birthday, about=:about";
           $where= "WHERE login=:login AND pass=:pass";
    return $this->db->update($this->table_name, $set, $where, $bind);
   }

   public function file_edit($bind){

           $set=   "SET image=:image";
           $where= "WHERE login = :login AND pass = :pass";
    return $this->db->update($this->table_name, $set, $where, $bind);
}

}