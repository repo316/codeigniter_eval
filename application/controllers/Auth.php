<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'TraitValidateForm.php';

class Auth extends CI_Controller{
	use TraitValidateForm;

	public function __construct(){
		parent::__construct();

		$this->load->database();
		$this->load->helper([
			'url',
			'myhelper'
		]);
		$this->load->model([
			'user_model',
		]);
		$this->load->library([
			'Response',
			'form_validation'
		]);
	}

	public function index(){
		$this->load->view('welcome_message');
	}

	public function login(){
		$response=get_request();

		$validated=$this->validate_user($response);

		if(!$validated){
			echo $this->response->json(400);
			return false;
		}

		$user=$this->user_model->user($response['email'], $response['password']);

		$code=404;
		$res=array();
		if($user){
			$code=200;
			$res['token']=uuid();
		}

		echo $this->response->json($code, $res);
		return false;
	}

	public function registro(){
		$response=get_request();

		$validated=$this->validate_user($response);

		if(!$validated){
			echo $this->response->json(400);
			return false;
		}

		$userId=$this->user_model->create([
			'email'=>strtolower($response['email']),
			'password'=>$response['password'],
		]);

		$code=404;
		$res=array();
		if($userId){
			$code=200;
			$res['message']='Registro correctamente.';
		}

		echo $this->response->json($code, $res);
		return false;
	}

	public function user_mantenimiento(){
		$users=GT::query('users');
		$users->set_theme('datatables');
		$users->set_subject('Registro');
		$users->required_fields('email');
		$users->columns('email', 'password');
		$output=$users->render();

		$this->load->view('auth.php', (array)$output);
	}
}
