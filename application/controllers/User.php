<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Sabre\DAV\Client;
include 'vendor/autoload.php';

class User extends CI_Controller {

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

	public function __construct(){
		parent::__construct();
		if(!isset($this->session->login_status)){
			redirect(site_url('auth?m=Need a Credential!'));
		}
		$this->load->model('VideoModel','video');
	}

	public function index()
	{
        $this->load->view('user/video-control');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(site_url('home'));
	}

	public function uploadForm(){
		
		$this->load->view('user/video-upload');
		
	}

public function uploadProcess(){
	$title = $this->input->post('title');
	$file = $_FILES['video']['name'];
	$base_location = 'http://192.168.43.68/index.php/apps/sharingpath/admin/';
	$setting = array(
		'baseUri' => 'http://192.168.43.68/remote.php/webdav/',
    	'userName' => 'admin',
    	'password' => 'admin'
	);

	$client = new Client($setting);
	$response = $client->request('PUT',$file,$_FILES['video']['name']);
			
	$this->video->insertData(array(
		'title' => $title,
		'location' => $base_location.$file
	));

	$this->session->set_flashdata("<script> window.alert('Upload success'); </script>");
	redirect(site_url('user'));
}

		
}
