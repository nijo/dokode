<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	public function homePage()
	{   
        $this->load->model('User');
        $this->load->model('Files');
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            $file['user'] = $this->shortuser();
            $filesource = $this->Files->return_File();
            $file['file'] = "table";
            $file['source'] = $filesource;
            $file['read'] = "";
            $this->load->view('home_page', $file);
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                $file['user'] = $this->shortuser();
                $filesource = $this->Files->return_File();
                $file['file'] = "table";
                $file['source'] = $filesource;
                $file['read'] = "";
                $this->load->view('home_page', $file);
            }
        }
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        }
	}
    public function logOut()
    {
        unset($_SESSION['id']);
        delete_cookie('id');
        $alertmsg = "";
        $alertarray['alert'] = $alertmsg;
 		$this->load->view('welcome_message', $alertarray);
    }
    public function deleteAcc()
    {
        $this->load->model('User');
        $this->load->model('Files');
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            if($this->input->post('radio') == 'yes'){
                $this->load->model('Comments');
                $this->Comments->add_Comments();
                unset($_SESSION['id']);
                delete_cookie('id');
                $this->load->model('Files');
                $this->Files->delete_All();
                $this->User->delete_Acc();
                $alertmsg = "";
                $alertarray['alert'] = $alertmsg;
                $filesource = $this->Files->return_File();
            	$alertarray['file'] = "table";
            	$alertarray['source'] = $filesource;
                $this->load->view('welcome_message', $alertarray); 
            }
            else if($this->input->post('radio') == 'no'){
                $file['user'] = $this->shortuser();
                $filesource = $this->Files->return_File();
                $file['file'] = "table";
                $file['read'] = "";
                $file['source'] = $filesource;
                $this->load->view('home_page', $file);
            }
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                if($this->input->post('radio') == 'yes'){
                    $this->load->model('Comments');
                    $this->Comments->add_Comments();
                    unset($_SESSION['id']);
                    delete_cookie('id');
                    $this->load->model('Files');
                    $this->User->delete_Acc();
                    $this->Files->delete_All();
                    $alertmsg = "";
                    $alertarray['alert'] = $alertmsg;
                    $filesource = $this->Files->return_File();
            		$alertarray['file'] = "table";
            		$alertarray['source'] = $filesource;
                    $this->load->view('welcome_message', $alertarray); 
                }
                else if($this->input->post('radio') == 'no'){
                    $file['user'] = $this->shortuser();
                    $filesource = $this->Files->return_File();
                    $file['read'] = "";
                	$file['file'] = "table";
                	$file['source'] = $filesource;
                    $this->load->view('home_page', $file);
                }
            }
        }
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        }
    }
    public function loadDelete()
    {
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            $this->load->model('User');
            $this->load->model('Files');
            $file['user'] = $this->shortuser();
            $filesource = $this->Files->return_File();
            $file['file'] = "table";
            $file['source'] = $filesource;
            $this->load->view('delete_account', $file);
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                $this->load->model('User');
                $this->load->model('Files');
                $file['user'] = $this->shortuser();
                $filesource = $this->Files->return_File();
                $file['file'] = "table";
                $file['source'] = $filesource;
                $this->load->view('delete_account', $file);
            }
        }
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        }
        
    }
    public function changePwd()
    {
        $this->load->model('User');
        $this->load->model('Files');
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            $alertarray['alert'] = $this->User->update_Pwd();
            $filesource = $this->Files->return_File();
            $alertarray['file'] = "table";
            $alertarray['source'] = $filesource;
            $alertarray['user'] = $this->shortuser();
            $this->load->view('change_password', $alertarray);
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                $alertarray['alert'] = $this->User->update_Pwd();
                $filesource = $this->Files->return_File();
            	$alertarray['file'] = "table";
            	$alertarray['source'] = $filesource;
                $alertarray['user'] = $this->shortuser();
                $this->load->view('change_password', $alertarray);
            }
        }
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        }
        
    }
    public function loadChange()
    {
        $alertmsg = "";
        $this->load->model('User');
        $this->load->model('Files');
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            $alertarray['alert'] = $alertmsg;
            $filesource = $this->Files->return_File();
            $alertarray['file'] = "table";
            $alertarray['source'] = $filesource;
            $alertarray['user'] = $this->shortuser();
            $this->load->view('change_password', $alertarray); 
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                $alertarray['alert'] = $alertmsg;
                $alertarray['user'] = $this->shortuser();
                $filesource = $this->Files->return_File();
            	$alertarray['file'] = "table";
            	$alertarray['source'] = $filesource;
                $this->load->view('change_password', $alertarray); 
            }
        }
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        }
    }
    public function askHelp()
    {
        $alertarray['alert'] = "";
        $this->load->model('User');
        $this->load->model('Files');
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            if($this->input->post('subject') != ""){
                $id = $_SESSION['id'];
                $email = $this->User->return_Email();
                if($email != "no"){
                    $to = 'nijo1103@gmail.com';
                    $subject = $this->input->post('subject');
                    $txt = $this->input->post('query');
                    $headers = "From: $email";
                    mail($to,$subject,$txt,$headers);
                    $alertarray['alert'] = "yes";
                }
            }
            $filesource = $this->Files->return_File();
            $alertarray['file'] = "table";
            $alertarray['source'] = $filesource;
            $alertarray['user'] = $this->shortuser();
            $this->load->view('help_support', $alertarray); 
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                if($this->input->post('subject') != ""){
                    $id = $_SESSION['id'];
                    $email = $this->User->return_Email();
                    if($email != "no"){
                        $to = 'nijo1103@gmail.com';
                        $subject = $this->input->post('subject');
                        $txt = $this->input->post('query');
                        $headers = "From: $email";
                        mail($to,$subject,$txt,$headers);
                        $alertarray['alert'] = "yes";
                    }
                }
                $filesource = $this->Files->return_File();
            	$alertarray['file'] = "table";
            	$alertarray['source'] = $filesource;
                $alertarray['user'] = $this->shortuser();
                $this->load->view('help_support', $alertarray); 
            }
        }
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        } 
    }
    
    public function deleteFile()
    {
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            if($this->input->get('name') != "" ||$this->input->get('type') != "") {
                $filename = $this->input->get('name');
                $filetype = $this->input->get('type');
                $this->load->model('User');
                $email = $this->User->return_Email();
                $this->load->model('Files');
                if (unlink("/home/sites/nijojob.com/public_html/MyApp/userfiles/$email/$filename.$filetype")){
                    $this->Files->delete_File($filename, $filetype);
                }
                $filesource = $this->Files->return_File();
                $file['file'] = "table";
                $file['source'] = $filesource;
                $file['read'] = "";
                $file['name'] = "";
                $file['email'] = $email;
                $file['user'] = $this->shortuser();
                $this->load->view('home_page', $file);
            }
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                if($this->input->get('name') != "" ||$this->input->get('type') != "") {
                    $filename = $this->input->get('name');
                    $filetype = $this->input->get('type');
                    $this->load->model('User');
                    $email = $this->User->return_Email();
                    $this->load->model('Files');
                    if (unlink("/home/sites/nijojob.com/public_html/MyApp/userfiles/$email/$filename.$filetype")){
                        $this->Files->delete_File($filename, $filetype);
                    }
                    $filesource = $this->Files->return_File();
                    $file['file'] = "table";
                    $file['source'] = $filesource;
                    $file['read'] = "";
                    $file['name'] = "";
                    $file['email'] = $email;
                    $file['user'] = $this->shortuser();
                    $this->load->view('home_page', $file);
                }
            }
        }
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        } 
    }
    public function downloadFile()
    {
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            if($this->input->get('name') != "") {
                $filename = $this->input->get('name');
                $filetype = $this->input->get('type');
                $this->load->model('User');
                $email = $this->User->return_Email();
                $this->load->model('Files');
                $dfile = "/home/sites/nijojob.com/public_html/MyApp/userfiles/$email/$filename.$filetype";
                if (file_exists($dfile)) {
    				header('Content-Description: File Transfer');
    				header('Content-Type: application/octet-stream');
    				header('Content-Disposition: attachment; filename="'.basename($file).'"');
    				header('Expires: 0');
    				header('Cache-Control: must-revalidate');
    				header('Pragma: public');
    				header('Content-Length: ' . filesize($dfile));
    				readfile($dfile);
				}
                $filesource = $this->Files->return_File();
                $file['file'] = "table";
                $file['source'] = $filesource;
                $file['read'] = "";
                $file['name'] = "";
                $file['email'] = $email;
                $file['user'] = $this->shortuser();
                $this->load->view('home_page', $file);
            }
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                if($this->input->get('name') != "") {
                $filename = $this->input->get('name');
                $filetype = $this->input->get('type');
                $this->load->model('User');
                $email = $this->User->return_Email();
                $this->load->model('Files');
                $dfile = "/home/sites/nijojob.com/public_html/MyApp/userfiles/$email/$filename.$filetype";
                if (file_exists($dfile)) {
    				header('Content-Description: File Transfer');
    				header('Content-Type: application/octet-stream');
    				header('Content-Disposition: attachment; filename="'.basename($dfile).'"');
    				header('Expires: 0');
    				header('Cache-Control: must-revalidate');
    				header('Pragma: public');
    				header('Content-Length: ' . filesize($dfile));
    				readfile($dfile);
				}
			} 
			} 
		} 
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        } 
    }
    public function uploadFile()
    {
        $this->load->model('User');
        $this->load->model('Files');
        $email = $this->User->return_Email();
        if ($this->input->cookie('id') != NULL) {
            $_SESSION['id'] = $_COOKIE['id'];
            $config['upload_path']   = "/home/sites/nijojob.com/public_html/MyApp/userfiles/$email/"; 
            $config['allowed_types'] = 'text|html|php|css|javascript'; 
            $config['max_size'] = 1024; 
            $this->load->library('upload', $config);
            if ( !$this->upload->do_upload('userfile')) {
						$filesource = $this->upload->display_errors(); 
						$file['user'] = $this->shortuser();
                    	$file['file'] = "table";
                    	$filesource1 = $this->Files->return_File();
                    	$file['source'] = $filesource1;
                    	$file['read'] = $filesource;
                    	$this->load->view('home_page', $file);
						}
					else { 
						$data = $this->upload->data();  
                    	$filesource = $data['full_path'];
                    	$filename = $data['raw_name'];
                    	$filetyp = $data['file_ext'];
                    	$posi = strpos($filetyp, '.', 0);
                    	$filetype = substr($filetyp, $posi+1);
                    	$this->Files->add_File($filesource, $filename, $filetype);
                    	$file['user'] = $this->shortuser();
                    	$filesource = $this->Files->return_File();
                    	$file['file'] = "table";
                    	$file['read'] = "";
                    	$file['source'] = $filesource;
                    	$this->load->view('home_page', $file);
        	 		} 
        }
        else if (array_key_exists('id', $_SESSION)) {
            if($_SESSION['id']!=""){
                $config['upload_path']   = "/home/sites/nijojob.com/public_html/MyApp/userfiles/$email/"; 
                $config['allowed_types'] = 'text|html|php|css|javascript'; 
                $config['max_size'] = 1024; 
                $this->load->library('upload', $config);
					if ( !$this->upload->do_upload('userfile')) {
						$filesource = $this->upload->display_errors(); 
						$file['user'] = $this->shortuser();
                    	$file['file'] = "table";
                    	$filesource1 = $this->Files->return_File();
                    	$file['source'] = $filesource1;
                    	$file['read'] = $filesource;
                    	$this->load->view('home_page', $file);
						}
					else { 
						$data = $this->upload->data();  
                    	$filesource = $data['full_path'];
                    	$filename = $data['raw_name'];
                    	$filetyp = $data['file_ext'];
                    	$posi = strpos($filetyp, '.', 0);
                    	$filetype = substr($filetyp, $posi+1);
                    	$this->Files->add_File($filesource, $filename, $filetype);
                    	$file['user'] = $this->shortuser();
                    	$filesource = $this->Files->return_File();
                    	$file['file'] = "table";
                    	$file['source'] = $filesource;
                    	$file['read'] = "";
                    	$this->load->view('home_page', $file);
        	 		}           
                }
		} 
        else{
            $alertmsg = "";
            $alertarray['alert'] = $alertmsg;
            $this->load->view('welcome_message', $alertarray);
        } 
    }
}