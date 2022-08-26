<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'TraitValidateForm.php';

class Activity extends CI_Controller{

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
			'user_activity_model',
		]);
		$this->load->library([
			'Response',
			'form_validation'
		]);
	}

	function get_conversations(){
		$response=get_request();
		try{
			$validated=$this->validate_form($response, [
				[
					'key'=>'uid',
					'rule'=>'trim|required'
				]
			]);
			if(!$validated){
				echo $this->response->json(400);
				return false;
			}

			$user_exists=$this->user_model->get($response["uid"]);
			if(!$user_exists){
				echo $this->response->json(404);
				return false;
			}

			$code=404;
			$res=array();
			$all_convos=$this->user_activity_model->get_by("uid", $user_exists->id);
			if(sizeof($all_convos)>0){
				$code=200;
				$res = array_map(function($row){
					return array(
						"id"=>$row->id,
						"messageFrom"=>$row->message_from,
						"value"=>$row->message_text,
						"timestamp"=>intval($row->timestamp),
					);
				}, $all_convos);
			}
			echo $this->response->json($code, $res);
			return true;
		}catch(\Exception $e){
			log_message('error', $e->getMessage());
			echo $this->response->json(500);
		}

		return true;
	}
}
