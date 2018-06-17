<?php
    // system/application/models/user.php

    class User extends CI_Model {

        function __construct()
        {
            // Call the Model constructor
            parent::__construct();
        }

        public function add_User()  {	
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            $dobhtml = strtotime($this->input->post('dob'));
            $dofb = date("Y-m-d",$dobhtml);
            if($password == $cpassword){
                $query = $this->db->query("SELECT * FROM Users WHERE email = '$email';");
                $row = $query->row();
                if (isset($row)){
                    $alertmsg="E-mail address already taken!!!";
                    $alertarray['alert'] = $alertmsg;
                    $this->load->view('sign_up', $alertarray);
                }
                else{
                    $query = $this->db->query("INSERT INTO Users (Name, Email, Password, DOB) VALUES ('$name','$email','$password','$dofb')");
                    $query = $this->db->query("SELECT * FROM Users WHERE email = '$email';");
                    $row = $query->row();
                    $password = md5(md5($row->id).$row->Password);
                    $query = $this->db->query("UPDATE Users SET password = '$password' WHERE id = $row->id");
                    $id = md5($row->id);
                        $to = $email;
                        $subject = "Congrats on signing up to MyApp";
                        $txt = "Please click on the link provided to confirm your e-mail id : http://nijojob.heliohost.org/MyApp/index.php/welcome/welcomeScreen?email=$to&confirm=$id";
                        $headers = "From: nijo1103@gmail.com";
                        mail($to,$subject,$txt,$headers);
                    $alertmsg="e-mail";
                    $alertarray['alert'] = $alertmsg;
                    $this->load->view('sign_up', $alertarray);
                }
            }
            else{
                $alertmsg="Passwords does not match!!!";
                $alertarray['alert'] = $alertmsg;
                $this->load->view('sign_up', $alertarray);
            }
        }
        public function log_User() {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $query = $this->db->query("SELECT * FROM Users WHERE email LIKE '$email';");
            $row = $query->row();
            if (isset($row)){
                $passwd = $row->Password;
                $password = md5(md5($row->id).$password);
                if($passwd == $password){
                    $confirm = $row->Confirmed;
                    if($confirm == TRUE){
                        $_SESSION['id'] = $row->id;
                        if ($this->input->post('signed') == 1) {
                            $cookie = array(
                                'name' => 'id',
                                'value' => $row->id,
                                'expire' => time()+60*60*24*365,
                            ); 
                            $this->input->set_cookie($cookie);
                        }
                        return true;
                    }
                    else{
                        $alertmsg="Please confirm your e-mail";
                        $alertarray['alert'] = $alertmsg;
                        $this->load->view('welcome_message', $alertarray);
                    }
                }
                else{
                    $alertmsg="Please check your password";
                    $alertarray['alert'] = $alertmsg;
                    $this->load->view('welcome_message', $alertarray);
                }
            }
            else{
                    $alertmsg="Please check your email";
                    $alertarray['alert'] = $alertmsg;
                    $this->load->view('welcome_message', $alertarray);
            }
        }
        public function confirm_User($confirm,$email){
            $query = $this->db->query("SELECT * FROM Users WHERE email LIKE '$email';");
            $row = $query->row();
            if($confirm == md5($row->id))
            {
                $query = $this->db->query("UPDATE Users SET confirmed = '1' WHERE id = $row->id");
            }
        }
        public function update_Pwd()
        {
            $id = $_SESSION['id'];
            $opassword = $this->input->post('current-password');
            $npassword = $this->input->post('new-password');
            $password = md5(md5($id).$npassword);
            $opassword = md5(md5($id).$opassword);
            $query = $this->db->query("SELECT * FROM Users WHERE id LIKE '$id';");
            $row = $query->row();
            if($opassword == $row->Password){
                $query = $this->db->query("UPDATE Users SET Password = '$password' WHERE id = $row->id");
                $flag = "yes";
            }
            else{
                $flag = "no";
            }
            return $flag;
        }
        public function delete_Acc()
        {
            $id = $_SESSION['id']; 
            $query = $this->db->query("SELECT * FROM Users WHERE id LIKE '$id';");
            $row = $query->row();
            if($id = $row->id){
                $query = $this->db->query("DELETE FROM Users WHERE id LIKE '$id' LIMIT 1;");
            }
        }
        public function check_Email()
        {
            $email = $this->input->post('email');  
            $query = $this->db->query("SELECT * FROM Users WHERE email LIKE '$email';");
            $row = $query->row();
            if (isset($row)){
                $flag = "yes" ;
            }
            else{
                $flag = "no";
            }
            return $flag;
        }
        public function return_Email()
        {
            $id = $_SESSION['id'];  
            $query = $this->db->query("SELECT * FROM Users WHERE id LIKE '$id';");
            $row = $query->row();
            if (isset($row)){
                $flag = $row->Email;
            }
            else{
                $flag = "no";
            }
            return $flag;
        }
        public function return_User()
        {
            $id = $_SESSION['id'];  
            $query = $this->db->query("SELECT * FROM Users WHERE id LIKE '$id';");
            $row = $query->row();
            if (isset($row)){
                $flag = $row->Name;
            }
            else{
                $flag = "no";
            }
            return $flag;
        }
        public function reset_Pwd()
        {
            $email = $this->input->post('hidden');
            $query = $this->db->query("SELECT * FROM Users WHERE email LIKE '$email';");
            $row = $query->row();
            $npassword = $this->input->post('new-password');
            $password = md5(md5($row->id).$npassword);
			$query = $this->db->query("UPDATE Users SET Password = '$password' WHERE id = $row->id");
        }
    }
?>