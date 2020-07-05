<?php
class LogModel extends Model {

    public function __construct(){
        parent:: __construct();
    }

    public $table_name=  "logs";

    public function log_add($bind){

           $this->db->insert($this->table_name, $bind);
    }

    public function list($page, $per_page ){

            $offset = ($page-1)*($per_page);

            $field_name= "id, name, action, date";
            $where= "ORDER BY id DESC LIMIT $offset,$per_page";
     return $this->db->select( $this->table_name, $field_name,'fetchAll', $where);
    }

    public function count(){

    return $this->db->count($this->table_name, "id");
   }
   
}