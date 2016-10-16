<?php

class Projecttype extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
	'name' => 'required'
	);
}
