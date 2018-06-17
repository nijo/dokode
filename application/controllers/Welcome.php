<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
    }
    public function shortuser() 
    {
    	$this->load->model('User');
    	$user = $this->User->return_User();
        $pos = strrpos($user, ' ', 0);
        $posi = strpos($user, ' ', 0);
        if($pos != $posi) {
        	$file = substr($user, 0, 1).substr($user, $posi+1,  1).substr($user, $pos+1,  1);
        } 
        else {
        	$file = substr($user, 0, 1).substr($user, $posi+1,  1);
        }  
        return $file;
    } 
	public function welcomeScreen()
	{
		if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            $file['user'] = $this->shortuser();
            $this->load->model('Files');
            $filesource = $this->Files->return_File();
            $file['file'] = "table";
            $file['read'] = "";
            $file['source'] = $filesource;
            $this->load->view('home_page', $file);
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                $file['user'] = $this->shortuser();
                $this->load->model('Files');
                $filesource = $this->Files->return_File();
                $file['file'] = "table";
                $file['read'] = "";
                $file['source'] = $filesource;
                $this->load->view('home_page', $file);
            }
        }
        else{
         if($this->input->get('confirm')!=""){
            $confirm = $this->input->get('confirm');
            $email = $this->input->get('email');
            $this->load->model('User');
            $this->User->confirm_User($confirm, $email);
        }
        $alertmsg = "";
        $alertarray['alert'] = $alertmsg;
		$this->load->view('welcome_message', $alertarray);
        }
	}
	public function logIn()
	{
        $this->load->model('User');
        if($this->User->log_User()) {
				$file['user'] = $this->shortuser();
                $this->load->model('Files');
                $filesource = $this->Files->return_File();
                $file['file'] = "table";
                $file['read'] = "";
                $file['source'] = $filesource;
                $this->load->view('home_page', $file);
		} 
    }
    public function forgotPwd()
    {
        if($this->input->post('email') == "" && $this->input->get('email') == "" && $this->input->post('new-password') == ""){
            $selectarray['alert'] = "";
            $selectarray['select'] = 'email';
            $this->load->view('forgot_password', $selectarray);
        }
        else if($this->input->post('email') != ""){
            $this->load->model('User');
            $flag = $this->User->check_Email();
            if($flag == "no"){
                $selectarray['select'] = 'email';
                $selectarray['alert'] = $flag;
                $this->load->view('forgot_password', $selectarray); 
            }
            else if($flag == "yes"){
                    $to = $this->input->post('email');
                    $subject = "Reset your password!!";
                    $txt = "Please click on the link provided to reset your password : http://nijojob.heliohost.org/MyApp/index.php/welcome/forgotPwd?email=$to";
                    $headers = "From: nijo1103@gmail.com";
                    mail($to,$subject,$txt,$headers);
                $selectarray['select'] = 'email';
                $selectarray['alert'] = 'sent';
                $this->load->view('forgot_password', $selectarray); 
            }
        }
        else if($this->input->get('email') != ""){
            $email = $this->input->get('email');
        	$selectarray['select'] = 'password';
            $selectarray['alert'] = $email;
            $this->load->view('forgot_password', $selectarray); 
        }
        else if($this->input->post('new-password') != ""){
        	$selectarray['select'] = 'password';
            $selectarray['alert'] = 'yes';
            $this->load->view('forgot_password', $selectarray);
        	$this->load->model('User');
            $this->User->reset_Pwd();
        } 
    }
}
