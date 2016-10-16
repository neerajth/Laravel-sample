<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Contractor extends Eloquent implements UserInterface, RemindableInterface {
	protected $guarded = array();

	public static $rules = array(
	

		//'contractorid' => 'required',
		 'firstname' => 'required',
		'lastname' => 'required',
		'businessname' => 'required' ,
		'email' => 'required|email|unique:contractors',
		'password' => 'required|AlphaNum|min:8|same:password_confirmation',
		'password_confirmation' => 'required|AlphaNum|min:8',
	   'phone' => '',
		'fax' => '',
		'street1' => 'required',
		'street2' => '',
		'city' => 'required',
		'state' => 'required',
		'zip' => 'required',
		'logo'=>'image|mimes:jpeg,jpg,png,bmp,gif,svg'
	);
	public static $rulesedit = array(
	

		//'contractorid' => 'required',
		 'firstname' => 'required',
		'lastname' => 'required',
		'businessname' => 'required' ,
		'email' => 'required|email',
		///'password' => 'required|min:8|same:password_confirmation',
		//'password_confirmation' => 'required|min:8',
	   'phone' => '',
		'fax' => '',
		'street1' => 'required',
		'street2' => '',
		'city' => 'required',
		'state' => 'required',
		'zip' => 'required',
		'logo'=>'image|mimes:jpeg,jpg,png,bmp,gif,svg'
	);
	public static $storepassword = array(
	
	'old_password' => 'required',
	'new_password' => 'required|min:8|same:confirm_password' ,
	'confirm_password' => 'required|min:8',
	);	
	public static $storebilling = array(
	
	'cardholdername' => 'required',
	'cardno' => 'required|numeric' ,
	'expmonth' => 'required',
	'expyear' => 'required',
	);
	
	
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'contractors';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
		return 'remember_token';
	}

}
