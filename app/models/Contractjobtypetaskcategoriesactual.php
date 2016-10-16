<?php

class Contractjobtypetaskcategoriesactual extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'contractorid' => 'required',
		'taskcategoryid' => 'required',
		'jobtypeid' => 'required',
		'projectid' => 'required'
	);
}
