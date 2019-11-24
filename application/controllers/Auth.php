<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
        $this->load->model('UserModel','user');
    }

	public function index()
	{
        if(isset($_GET['m'])){
            $this->load->view('auth/login',array('message' => $this->input->get('m')));
        }else $this->load->view('auth/login');
		
    }
    
    public function authenticate(){
        $where = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );

        $email_check = $this->user->getData(array('email'=>$where['email']));

        $user = $this->user->authenticate($where);

        if($user){
            if(password_verify($where['password'], $user['password'])){
                $data = array(
                    'nama' => $user['nama'],
                    'email' => $user['email'],
                    'login_status' => TRUE
                );
                $this->session->user_data($data);
                redirect(base_url('user'));
            }else redirect('auth?m=Password Salah');
    
        }else{
            redirect('auth?m=Email Tidak Ditemukan');
        }

    }

    public function register(){
        if(isset($_POST['email'])){
            $data = array(
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'password' => password_hash( $this->input->post('password'), PASSWORD_DEFAULT)
            );
            $this->user->insertData($data);
            redirect('auth?m=You Can Login Now');
        }else $this->load->view('auth/register');
    }
}
