<?php

class Client extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		//'clientid' => 'required',
		'contractorid' => 'required',
		'firstname' => 'required',
		'lastname' => 'required',
		//'email' => 'required',
		//'email' => 'required |unique:clients',
		
		'phone' => 'required',
		//'Gender'   => 'required|in:male,female',
		'street1' => 'required',
		//'street2' => 'required',
		'city' => 'required',
		'statecity' => 'required',
		'zip' => '',
		'client_note' => ''
		
	);
	public static $rulesedit = array(
		//'clientid' => 'required',
		'contractorid' => 'required',
		'firstname' => 'required',
		'lastname' => 'required',
		//'email' => 'required',
		
		'phone' => 'required',
		//'Gender'   => 'required|in:male,female',
		'street1' => 'required',
		//'street2' => 'required',
		'city' => 'required',
		'statecity' => 'required',
		'zip' => '',
		'client_note' => ''
		
	);
	
	 public function getFullNameAttribute()
    {
        return $this->attributes['firstname'] . ' ' . $this->attributes['lastname'];
    }
}
