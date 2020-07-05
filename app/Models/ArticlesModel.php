<?php
class ArticlesModel extends Model{

    public function __construct(){
        parent:: __construct();
    }

    public $table_name= "articles";

    public function list($bind, $page, $per_page ){

            $offset = ($page-1)*($per_page);

            $field_name= "id, title,lead, updated, user_name, user_id,image, status";
            $where= "WHERE user_id=:user_id ORDER BY id DESC LIMIT $offset,$per_page";
     return $this->db->select( $this->table_name, $field_name,'fetchAll', $where, $bind);
    }

    public function count(){

     return $this->db->count($this->table_name, "id");
    }

    public function article_by_id($bind){

            $field_name= "id, title,lead, body, image, updated, user_name, user_id, status";
            $where= "WHERE id=:id";
     return $this->db->select($this->table_name, $field_name,'fetch', $where, $bind);
    }

    public function article_insert($bind){

            $this->db->insert($this->table_name,$bind);
    }

    public function article_update($bind){

            $set=   "SET title=:title,lead=:lead, body=:body, image=:image, updated=:updated, status=:status , user_name=:user_name";
            $where= "WHERE id=:id";
     return $this->db->update($this->table_name, $set, $where, $bind);
    }

    public function status_edit($bind){

            $set=   "SET status=:status";
            $where= "WHERE id=:id";
     return $this->db->update($this->table_name, $set, $where, $bind);
    }

    public function delete_article($bind){

            $where= "WHERE id=:id";
     return $this->db->delete($this->table_name,$where,$bind);
    }

    public function article_search($bind, $page, $per_page ){

            $offset = ($page-1)*($per_page);

            $field_name= "id, title,lead, body, image, updated, user_name, user_id, status";
            $where= "WHERE id LIKE :id OR title LIKE :title OR lead LIKE :lead Or body LIKE :body ORDER BY id DESC LIMIT $offset,$per_page";
     return $this->db->search($this->table_name, $field_name, 'fetchAll', $where, $bind);
    }
}