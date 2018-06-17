<?php
    //system/application/models/user.php

    class Files extends CI_Model {

        function __construct()
        {
            // Call the Model constructor
            parent::__construct();
        }
        public function add_File($filesource, $filename, $filetype){
            $id = $_SESSION['id'];
            $datetime = date('m/d/Y h:i:s', time());
            $dobhtml = strtotime($datetime);
            $datetime = date("Y-m-d H:i:s",$dobhtml);
            $query = $this->db->query("SELECT * FROM Files WHERE id LIKE '$id' AND Name LIKE '$filename' AND Type LIKE '$filetype';");
            if($query->num_rows() > 0){
                $query = $this->db->query("UPDATE Files SET LastUpdated = '$datetime' WHERE id LIKE '$id' AND Name LIKE '$filename' AND Type LIKE '$filetype';");
            }
            else{
                $query = $this->db->query("INSERT INTO Files (id, Name, DateCreated, LastUpdated, DataSource, Type) VALUES ('$id', '$filename', '$datetime', '$datetime', '$filesource', '$filetype')");
            }
        }
        public function return_File(){
            $id = $_SESSION['id']; 
            $query = $this->db->query("SELECT * FROM Files WHERE id LIKE '$id';");
            if($query->num_rows() > 0){
                $row = $query->result();
                return $row;
            }
            else{
                $row = "No";
                return $row;
            }
        }
        public function delete_File($filename, $filetype){
            $id = $_SESSION['id'];
            $query = $this->db->query("DELETE FROM Files WHERE id LIKE '$id' AND Name LIKE '$filename' AND Type LIKE '$filetype';");
        }
        public function delete_All(){
            $id = $_SESSION['id'];
            $query = $this->db->query("DELETE FROM Files WHERE id LIKE '$id';");
        }
    }
?>