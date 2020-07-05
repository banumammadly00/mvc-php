<?php
class GalleryModel extends Model{

    public function __construct(){
        parent:: __construct();
    }

    public $table_name= "gallery";

    public function images($bind, $page,  $per_page ){

           $offset = ($page-1)*($per_page);

           $field_name= "id,user_id,created,image";
           $where= "WHERE user_id= :user_id ORDER BY id DESC LIMIT $offset,$per_page";
    return $this->db->select($this->table_name, $field_name,'fetchAll', $where, $bind);

    }

    public function count(){

   return $this->db->count($this->table_name, "id");
    }

    public function image_by_id($bind){

           $field_name= "id,user_id,image";
           $where= "WHERE id=:id AND user_id= :user_id";
    return $this->db->select($this->table_name, $field_name,'fetch', $where, $bind);
    }

    public function upload_images($bind){

          $this->db->insert($this->table_name,$bind);
    }

    public function delete_image($bind){

           $where= "WHERE id=:id AND user_id= :user_id";
    return $this->db->delete($this->table_name,$where,$bind);
    }

}