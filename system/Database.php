<?php
class Database extends PDO{

    public function __construct(){
        $db= "mysql:dbname=mvc_db;host=localhost";
        $user= 'root';
        $password= '';
        parent:: __construct($db,$user,$password);
    }

    public function select($table_name, $field_name,$fetch_type, $where=null, $bind=array()){

       $fetchMode = PDO::FETCH_ASSOC;

              $sql= "SELECT $field_name FROM $table_name $where ";
              $data=$this->prepare($sql);
    if($where){
     foreach ($bind as $key => $value) {
              $data->bindValue($key, $value);
        }
              $data->execute();
      return  $data->$fetch_type($fetchMode);

    }else{
              $data->execute();
      return  $data->$fetch_type($fetchMode);
    }
    }

    public function insert($table_name, $values) {

        $field_keys = implode(",", array_keys($values));
        $field_values = ":" . implode(", :", array_keys($values));

        $sql = "INSERT INTO $table_name($field_keys) VALUES($field_values)";
        $data = $this->prepare($sql);

        foreach ($values as $key => $value){
                $data->bindValue(":$key", $value);
         }

        return $data->execute();

    }

    public function update($table_name, $set, $where, $bind=array()){

        $sql= "UPDATE $table_name $set $where";
        $data=$this->prepare($sql);
        foreach ($bind as $key => $value){
            $data->bindValue($key, $value);
        }
        return $data->execute();
    }

    public function delete($table_name, $where, $bind=array()){

        $sql= "DELETE FROM $table_name $where";
        $data= $this->prepare($sql);
        foreach ($bind as $key => $value){
            $data->bindValue($key, $value);
        }
        return $data->execute();

    }

    public function count($table_name,$field_name, $where=null, $bind=array()){

        $sql= "SELECT COUNT($field_name) FROM $table_name $where";
        $data=$this->prepare($sql);

        if($where){
            foreach ($bind as $key => $value) {
                    $data->bindValue($key, $value);
              }
                    $data->execute();
            return  $data->fetchColumn();
        }else{
                    $data->execute();
            return  $data->fetchColumn();
        }
    }

    public function search($table_name, $field_name, $fetch_type, $where=null, $bind=array()){

        $fetchMode = PDO::FETCH_ASSOC;
        $sql= "SELECT $field_name FROM $table_name $where";
        $data= $this->prepare($sql);

        foreach ($bind as $key => $value){
        $data->bindValue(":$key", '%'.$value.'%');
        }

                $data->execute();
        return  $data->$fetch_type($fetchMode);
    }
}