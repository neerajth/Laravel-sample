<?php

class Unit extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		//'unitid' => 'required',
		'name' => 'required',
		'abbreviation' => 'required'
	);
}
