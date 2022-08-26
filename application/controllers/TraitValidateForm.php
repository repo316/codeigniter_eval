<?php

trait TraitValidateForm{

	function validate_form($data=array(),$rules=array()){
		$this->form_validation->set_data($data);
		foreach($rules as $rule){
			$this->form_validation->set_rules($rule['key'],$rule['key'],$rule['rule']);
		}

		 return $this->form_validation->run();
	}

	function validate_user($data=array()){
		return $this->validate_form($data, [
			[
				'key'=>'email',
				'rule'=>'required|valid_email'
			],
			[
				'key'=>'password',
				'rule'=>'trim|required|min_length[5]'
			]
		]);
	}

}
