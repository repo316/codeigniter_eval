<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_request')){
	function get_request($associative = true){
		$tempo_json = file_get_contents('php://input');
		$post = json_decode($tempo_json, $associative);
		return $post??[];
	}
}

if(!function_exists('uuid')){
	function uuid() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
			mt_rand( 0, 0xffff ),
			mt_rand( 0, 0x0fff ) | 0x4000,
			mt_rand( 0, 0x3fff ) | 0x8000,
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}
}
