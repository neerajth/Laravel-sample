<?php

class Project extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		//'projectid' => 'required',
	//	'clientid' => 'required',
	//	'contractorid' => 'required',
		'name' => 'required',
		//'description' => 'required',
		//'proposal' => 'required'
	);
	public static $rule = array( 
		//'name' => '',
		//'description' => ''
		);
		
	public static $rulesinfo = array( 
		'clientname' => 'required',
		//'description' => 'required'
		);	
		public static $ruletype = array( 
		'name' => 'required',
		//'description' => 'required'
		);	
		
}
