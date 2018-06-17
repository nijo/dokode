<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newtext extends CI_Controller {

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
	 * @see https://Common.com/user_guide/general/urls.html
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
    public function newText()
    {
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            $this->load->model('User');
            $this->load->model('Files');
            $filesource = $this->Files->return_File();
            $file['source'] = $filesource;
            $file['data'] = "";
            $file['read'] = "false";
            $file['user'] = $this->shortuser();
            $this->load->view('new_text', $file);
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                $this->load->model('User');
                $this->load->model('Files');
            	$filesource = $this->Files->return_File();
            	$file['source'] = $filesource;
                $file['data'] = "";
                $file['read'] = "false";
                $file['user'] = $this->shortuser();
                $this->load->view('new_text', $file);
            }
        }
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        }
        
    }
    public function openText()
    {
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
                $filename = $this->input->get('name');
                $filetype = "txt";
                $this->load->model('User');
                $email = $this->User->return_Email();
                $myfile = fopen("/home/nijojob/public_html/MyApp/userfiles/$email/$filename.$filetype", "r");
                $data = fread($myfile, filesize("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype"));
                fclose($myfile);
                $this->load->model('Files');
            	$filesource = $this->Files->return_File();
            	$file['source'] = $filesource;
                $file['data'] = $data;
                $file['read'] = "nocursor";
                $file['name1'] = $filename;
                $file['email'] = $email;
                $file['user'] = $this->shortuser();
                $this->load->view('open_text', $file);
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                    $filename = $this->input->get('name');
                    $filetype = "txt";
                    $this->load->model('User');
                    $email = $this->User->return_Email();
                    $myfile = fopen("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype", "r");
                    $data = fread($myfile, filesize("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype"));
                    fclose($myfile);
                    $this->load->model('Files');
            		$filesource = $this->Files->return_File();
            		$file['source'] = $filesource;
                    $file['data'] = $data;
                    $file['read'] = "nocursor";
                    $file['name1'] = $filename;
                    $file['email'] = $email;
                    $file['user'] = $this->shortuser();
                    $this->load->view('open_text', $file);
            }
        }
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        } 
    }
    public function sharedText()
    {
    	if($this->input->get('name') != "") {
    		$filename = $this->input->get('name');
    		$filetype = $this->input->get('type');
    		$email = $this->input->get('email');
			$myfile = fopen("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype", "r");
        	$data = fread($myfile, filesize("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype"));
        	fclose($myfile);
        	$file['data'] = $data;
        	$file['read'] = "nocursor";
        	$file['name'] = $filename;
			$this->load->view('shared_text', $file);
		}
    }
    public function saveText()
    {
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            $filedata = $this->input->post('data');
            $filename = $this->input->post('filename');
            $filetype = "txt";
            $this->load->model('User');
            $email = $this->User->return_Email();
            if (!file_exists("/home/nijojob/public_html/Common/userfiles/$email")) {
                mkdir("/home/nijojob/public_html/Common/userfiles/$email", 0755, true);
            }
            $myfile = fopen("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype", "w");
            fwrite($myfile, $filedata);
            fclose($myfile);
            $filesource = "/home/nijojob/public_html/Common/userfiles/".$email."/".$filename.".".$filetype;
            $this->load->model('Files');
            $this->Files->add_File($filesource, $filename, $filetype);
            $file['data'] = $filedata;
            $file['read'] = "nocursor";
            $file['name1'] = $filename;
            $file['email'] = $email;
            $file['user'] = $this->shortuser();
            $this->load->view('open_text', $file);
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                $filedata = $this->input->post('data');
                $filename = $this->input->post('filename');
                $filetype = "txt";
                $this->load->model('User');
                $email = $this->User->return_Email();
                if (!file_exists("/home/nijojob/public_html/Common/userfiles/$email")) {
                    mkdir("/home/nijojob/public_html/Common/userfiles/$email", 0755, true);
                }
                $myfile = fopen("/home/nijojob/public_html/Common/userfiles/$email/$filename.$filetype", "w");
                fwrite($myfile, $filedata);
                fclose($myfile);
                $filesource = "/home/nijojob/public_html/Common/userfiles/".$email."/".$filename.".".$filetype;
                $this->load->model('Files');
                $this->Files->add_File($filesource, $filename, $filetype);
                $file['data'] = $filedata;
                $file['read'] = "nocursor";
                $file['name1'] = $filename;
                $file['email'] = $email;
                $file['user'] = $this->shortuser();
                $this->load->view('open_text', $file);
            }
        }
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        } 
    }
}