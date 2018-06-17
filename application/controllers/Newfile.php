<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newfile extends CI_Controller {

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
	 * @see https://MyApp.com/user_guide/general/urls.html
	 */
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }
    public function shortuser() 
    {
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
    public function newFile()
    {
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            $this->load->model('User');
            $file['file'] = $this->input->get('file');
            $file['data'] = "";
            $this->load->model('Files');
            $filesource = $this->Files->return_File();
            $file['source'] = $filesource;
            $file['read'] = "false";
            $file['user'] = $this->shortuser();
            $this->load->view('new_file', $file);
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                $this->load->model('User');
                $file['file'] = $this->input->get('file');
                $file['data'] = "";
                $this->load->model('Files');
            	$filesource = $this->Files->return_File();
            	$file['source'] = $filesource;
                $file['read'] = "false";
                $file['user'] = $this->shortuser();
                $this->load->view('new_file', $file);
            }
        }
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        }
    }
    public function openFile()
    {
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
                $filename = $this->input->get('name');
                $filetype = $this->input->get('type');
                $this->load->model('User');
                $email = $this->User->return_Email();
                $myfile = fopen("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype", "r");
                $data = fread($myfile, filesize("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype"));
                fclose($myfile);
                $this->load->model('Files');
                $filesource = $this->Files->return_File();
                $file['file'] = $filetype;
                $file['data'] = $data;
                $file['source'] = $filesource;
                $file['read'] = "nocursor";
                $file['name1'] = $filename;
                $file['email'] = $email;
                $file['user'] = $this->shortuser();
                $this->load->view('open_file', $file);
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                    $filename = $this->input->get('name');
                    $filetype = $this->input->get('type');
                    $this->load->model('User');
                    $email = $this->User->return_Email();
                    $myfile = fopen("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype", "r");
                    $data = fread($myfile, filesize("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype"));
                    fclose($myfile);
                    $this->load->model('Files');
                $filesource = $this->Files->return_File();
                	$file['source'] = $filesource;
                    $file['file'] = $filetype;
                    $file['data'] = $data;
                    $file['read'] = "nocursor";
                    $file['name1'] = $filename;
                    $file['email'] = $email;
                    $file['user'] = $this->shortuser();
                    $this->load->view('open_file', $file);
            }
        }
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        }
    }
    public function sharedFile()
    {
    	if($this->input->get('name') != "") {
    		$filename = $this->input->get('name');
    		$filetype = $this->input->get('type');
    		$email = $this->input->get('email');
			$myfile = fopen("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype", "r");
        	$data = fread($myfile, filesize("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype"));
        	fclose($myfile);
        	$file['file'] = $filetype;
        	$file['data'] = $data;
        	$file['read'] = "nocursor";
        	$file['name'] = $filename;
			$this->load->view('shared_file', $file);
		}
    }
    public function saveFile()
    {
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            $filedata = $this->input->post('data');
            $filename = $this->input->post('filename');
            $ofiletype = $this->input->post('filetype');
            $this->load->model('User');
            $email = $this->User->return_Email();
            if (!file_exists("/home/nijojob/public_html/Common/userfiles/$email")) {
                mkdir("/home/nijojob/public_html/Common/userfiles/$email", 0755, true);
            }    
            if($ofiletype == "htmlmixed") {
                $filetype = "html";
            } 
            else if($ofiletype == "css") {
                $filetype = "css";
            }
            else if($ofiletype == "javascript") {
                $filetype = "js";
            }
            else if($ofiletype == "php") {
                $filetype = "php";
            }
            $myfile = fopen("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype", "w");
            fwrite($myfile, $filedata);
            fclose($myfile);
            $filesource = "/home/nijojob/public_html/Common/userfiles/".$email."/".$filename.".".$filetype;
            $this->load->model('Files');
			if($myfile) {
            	$this->Files->add_File($filesource, $filename, $filetype);
            } 
            $filesource = $this->Files->return_File();
            $file['source'] = $filesource;
            $file['file'] = $filetype ;
            $file['data'] = $filedata;
            $file['read'] = "nocursor";
            $file['name1'] = $filename;
            $file['email'] = $email;
            $file['user'] = $this->shortuser();
            $this->load->view('open_file', $file);
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                $filedata = $this->input->post('data');
                $filename = $this->input->post('filename');
                $ofiletype = $this->input->post('filetype');
                $this->load->model('User');
                $email = $this->User->return_Email();
                if (!file_exists("/home/nijojob/public_html/Common/userfiles/$email")) {
                    mkdir("/home/nijojob/public_html/Common/userfiles/$email", 0755, true);
                }    
                if($ofiletype == "htmlmixed") {
                    $filetype = "html";
                } 
                else if($ofiletype == "css") {
                    $filetype = "css";
                }
                else if($ofiletype == "javascript") {
                    $filetype = "js";
                }
                else if($ofiletype == "php") {
                    $filetype = "php";
                }
                $myfile = fopen("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype", "w");
                fwrite($myfile, $filedata);
                fclose($myfile);
                $filesource = "/home/nijojob/public_html/Common/userfiles/".$email."/".$filename.".".$filetype;
                $this->load->model('Files');
                if($myfile) {
            		$this->Files->add_File($filesource, $filename, $filetype);
            	}
                $filesource = $this->Files->return_File();
                $file['source'] = $filesource;
                $file['file'] = $filetype ;
                $file['data'] = $filedata;
                $file['read'] = "nocursor";
                $file['name1'] = $filename;
                $file['email'] = $email;
                $file['user'] = $this->shortuser();
                $this->load->view('open_file', $file);
            }
        }
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        } 
    }
    public function displayPHP() {
        $str = $this->input->get('data');
    	eval("?> $str <?php ");
    } 
}