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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


    public function __construct(){
        parent::__construct();
        // $this->load->model('VideoModel','video');
        // $config = array(
        //     'hostname' => '192.168.43.239',
        //     'username' => 'root',
        //     'password' => '123160044'
        // );
        // $this->ftp->connect($config);
        // $this->ftp->mirror('/asset/video/', '/mnt/redflix/');
    }

	public function index(){
		$this->load->view('home/home');
    }
    
    public function videoPost(){
    
        $video = $this->video->getData(array('vid_id' => '1'));   
        $this->load->view('home/video-post' , $video);
    }

    public function videoPlayer($id){

        $video = $this->video->getData(array('vid_id' => $id));       
        
        $this->load->view('video/video-player', array('video' => $video));
    }
}
