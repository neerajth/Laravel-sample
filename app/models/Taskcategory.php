<?php

class Taskcategory extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		//'taskcategoryid' => 'required',
		//'jobtypeid' => 'required',
		//'taskparentcategoryid' => 'required',
		'name' => 'required',
		'task' => 'required'
	);
}
