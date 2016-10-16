<?php

class Task extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		//'taskid' => 'required',
		'taskcategoryid' => 'required',
		'contractorid' => 'required',
		'taskname' => 'required',
		'task_unit' => 'required',
		'cost_per_unit' => 'required|numeric|Min:0'
	);
	
	public function status(){
    return $this->hasOne('Unit', 'task_unit');
} 
}
