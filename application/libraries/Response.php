<?php

class Response{

	private function message($code=404){
		$mess = [
			200 => 'Success',
			400 => 'Bad Request',
			404 => 'Not Found',
			500 => 'Internal Server Error'
		];

		return isset($mess[$code])?$mess[$code]:'Unknown error';
	}

	public function json($code=400,$payload=array()) {
		header('Content-Type: application/json; charset=utf-8');
		return json_encode(array(
			'code'=>$code,
			'message'=>$this->message($code),
			'payload'=>$payload,
		));
	}
}
