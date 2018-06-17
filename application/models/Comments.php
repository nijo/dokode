<?php
    // system/application/models/user.php

    class Comments extends CI_Model {

        function __construct()
        {
            // Call the Model constructor
            parent::__construct();
        }
        
        public function add_Comments()
        {
            $id = $_SESSION['id'];
            $query = $this->db->query("SELECT * FROM Users WHERE id LIKE '$id';");
            $row = $query->row();
            $email = $row->Email;
            $comments = $this->input->post('comments');
            $query = $this->db->query("INSERT INTO Comments (id, Email, Comments) VALUES ('$id','$email','$comments')"); 
        }
    }
?>