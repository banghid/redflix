<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

	public function akun(){
		$user_id = $this->session->user_id;
		$email = $this->session->email;
		$nama = $this->session->nama;
		$this->load->view('user/akun',array(['user_id'=>$user_id,'email'=>$email,'nama'=>$nama]));
	}
}
