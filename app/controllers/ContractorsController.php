<?php

class ContractorsController extends BaseController {

	/**
	 * Contractor Repository
	 *
	 * @var Contractor
	 */
	protected $contractor;

	public function __construct(Contractor $contractor)
	{
		$this->contractor = $contractor;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Session::get('usertype') == "administrator"){
			$contractors= Contractor::where('usertype','=','contractor')->get();
			return View::make('contractors.index', compact('contractors'));
		}else{
			return Redirect::to('dashboard');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	  if(Session::get('usertype') == "contractor"){
		return Redirect::to('dashboard');
	}else{  
		$state = State::lists('statename', 'id');	
		return View::make('contractors.create', compact('state'));
	}	
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	
	$input = Input::all();
	$user = new Contractor;	
		$validation = Validator::make($input, Contractor::$rules);
		if ($validation->passes())
		{
		///print_r("here"); die;
		if($input['file'] != ""){
		$file = Input::file('file');
		$filename = $file->getClientOriginalName();
		}else{ $filename = "";}
		$user->firstname = $input['firstname']; 
		$user->lastname = $input['lastname']; 
		$user->email = $input['email'];
		$user->password = Hash::make($input['password']);
		$user->password = Hash::make($input['password_confirmation']);	
		$user->businessname = $input['businessname'];		
		$user->street1 = $input['street1'];	
		$user->street2 = $input['street2'];	
		$user->city = $input['city'];		
		$user->state = $input['state'];	
		$user->zip = $input['zip'];	
		$user->phone = $input['phone'];	
		$user->fax = $input['fax'];	
		$user->usertype = "contractor";
		$user->logo = $filename;
		$user->remember_token = $input['_token'];
		$user->save();
		//	$this->contractor->create($input);
		$lastjobtypeid = DB::getPdo()->lastInsertId();
		if($input['file'] != ""){
		$file = Input::file('file');
		$destinationPath = 'uploads/logo/';
		$filename = $file->getClientOriginalName();
		$ext = $file->getClientOriginalExtension();
		$uploadSuccess = Input::file('file')->move($destinationPath, $filename);
	/* 	
		$destination = 'uploads/logo/'.$lastjobtypeid.'.'.$ext;
		$img = Image::make($destinationPath . $filename)->resize(75)->save($destination); */
		
		File::copy($destinationPath . $filename, $destinationPath . $lastjobtypeid.'.'.$ext);	
		}
			
			$contractortype= Contractor::where('ID','=',Auth::id())->get();
			if  ( isset( $contractortype[0] ) && $contractortype[0]->usertype == "administrator" )
			{
				return Redirect::to('admin');
			}
			else
			{
				return Redirect::to('login');
			}
		}
		return Redirect::to('register')->withInput()->withErrors($validation);
		//return Redirect::route('contractors.create')->withInput()->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$contractortype= Contractor::where('ID','=',Auth::id())->get();
		
		if  ( isset( $contractortype[0] ) && $contractortype[0]->usertype == "administrator" )
		{
			$contractor = $this->contractor->findOrFail($id);
			$state = State::find($contractor->state);
			return View::make('contractors.showadmin', compact('contractor','state'));
		}
		else
		{
			
			$contractor = $this->contractor->findOrFail($id);
			$state = State::find($contractor->state);
			return View::make('contractors.show', compact('contractor','state'));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$contractor = $this->contractor->find($id);
		$state = State::lists('statename', 'id');
		if (is_null($contractor))
		{
			return Redirect::route('contractors.index');
		}

		return View::make('contractors.edit', compact('contractor','state'));
	}

	public function editadmin($id)
	{
		if(Session::get('usertype') == "contractor"){
			return Redirect::to('dashboard');
		}else{  
			$contractor = $this->contractor->find($id);
			 $state = State::lists('statename', 'id');
			if (is_null($contractor))
			{
				return Redirect::route('contractors.index');
			}
			return View::make('contractors.editadmin', compact('contractor','state'));	
		}	
	}
 
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		
		
		$loginemail= Contractor::where('ID','=',$id)->get();
		$clientemail= Contractor::where('email','=',$loginemail['0']->email)->get();
		$inputemail= Contractor::where('email','=',$input['email'])->get();
			
				$validation = Validator::make($input, Contractor::$rulesedit);

				if ($validation->passes())
				{
				//$objproject = Project::find($id);
				//print_r($input);die;
				if($input['logo'] != ""){
				$file = Input::file('logo');
				$destinationPath = 'uploads/logo/';
				$filename = $file->getClientOriginalName();
				$ext = $file->getClientOriginalExtension();
				//print_r($destinationPath.Auth::id().'.'.$ext); die;
				$uploadSuccess = Input::file('logo')->move($destinationPath, $filename);
				//Image::make($destinationPath.''.$filename)->resize(130,75)->save($destinationPath.'test.png');
				//print_r($destinationPath.Auth::id().'.'.$ext); die;
				//print_r($img); die;
				}else{
				$filename = $input['logoold'];
				}
				//print_r($input); die;
					if($loginemail['0']->email == $input['email']){
					
							$contractor = $this->contractor->find($id);
							$contractor->firstname = $input['firstname']; 
							$contractor->lastname = $input['lastname']; 
							$contractor->email = $input['email'];
							$contractor->businessname = $input['businessname'];		
							$contractor->street1 = $input['street1'];	
							$contractor->street2 = $input['street2'];	
							$contractor->city = $input['city'];		
							$contractor->state = $input['state'];	
							$contractor->zip = $input['zip'];	
							$contractor->phone = $input['phone'];	
							$contractor->fax = $input['fax'];	
							$contractor->usertype = "contractor";
							$contractor->logo = $filename;
							$contractor->remember_token = $input['_token'];
							$contractor->save();
							//$contractor->update($input);
					//$lastjobtypeid = DB::getPdo()->lastInsertId();
					  if($input['logo'] != ""){
					
						$destination = 'uploads/logo/'.Auth::id().'.'.$ext;
						/* $img = Image::make($destinationPath.$filename)->resize(null,75, function ($constraint) { $constraint->aspectRatio(); $constraint->upsize();})->save($destination); */
						
						//Image::make($destinationPath.''.$filename)->resize(130,75)->save($destinationPath.'test.png');
						//echo $destinationPath."<br>";
						//echo $destinationPath.$filename;
						
						////Image::make($destinationPath.$filename)->resize(80)->save($destination);
						
 						/* $img = Image::make($destinationPath.$filename);
						$widthR    = $img->width();
						$heightR   = $img->height();
						$newheight =70;
						$newwidth = round(($widthR/$heightR) * 70);
						$img->resize($newwidth, $newheight)->save($destination); */
						
						////////////////////// image resize via PHP GD cause fileinfo is not enabled on server.
						
						list($width, $height) = getimagesize($destinationPath.$filename);
						$size = getimagesize($destinationPath.$filename);
						$modheight =70;
						$modwidth = round(($width/$height) * 70);
						if ($height > 70) 
						{
								$tn = imagecreatetruecolor($modwidth, $modheight);
								
								
								if ($size['mime'] == "image/png")
								{
									$image = imagecreatefrompng($destinationPath.$filename);
									imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height);
									imagepng($tn, $destination, 9); 
								}
								if ($size['mime'] == "image/jpeg")
								{
									$image = imagecreatefromjpeg($destinationPath.$filename);
									imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height);
									imagejpeg($tn, $destination, 100);
								}
								
								if ($size['mime'] == "image/gif")
								{
									$image = imagecreatefromgif($destinationPath.$filename);
									imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height);
									imagegif($tn, $destination, 100); 
								}
								
						}
						
						//File::copy($destinationPath . $filename, $destinationPath . $id.'.'.$ext);
						
					}  
							return Redirect::route('contractors.show',array($id ,'?success_message'=>'Updated successfully!'));
					
					}else{
				
						if(count($inputemail) == '0'){
							$contractor = $this->contractor->find($id);
							$contractor->firstname = $input['firstname']; 
							$contractor->lastname = $input['lastname']; 
							$contractor->email = $input['email'];
							$contractor->businessname = $input['businessname'];		
							$contractor->street1 = $input['street1'];	
							$contractor->street2 = $input['street2'];	
							$contractor->city = $input['city'];		
							$contractor->state = $input['state'];	
							$contractor->zip = $input['zip'];	
							$contractor->phone = $input['phone'];	
							$contractor->fax = $input['fax'];	
							$contractor->usertype = "contractor";
							$contractor->logo = $filename;
							$contractor->remember_token = $input['_token'];
							$contractor->save();
							if($input['logo'] != ""){
							/* $destination = 'uploads/logo/'.Auth::id().'.'.$ext;
							$img = Image::make($destinationPath.$filename)->resize(null,75, function ($constraint) { $constraint->aspectRatio(); $constraint->upsize();})->save($destination);  */
							File::copy($destinationPath . $filename, $destinationPath . $id.'.'.$ext); 
							}
							//$contractor->update($input);
							return Redirect::route('contractors.show',array($id ,'?success_message'=>'Updated successfully!'));
						}	
						
						return Redirect::route('contractors.edit',$id)->withInput()->with('success', 'Email already exist.');
					}	
					
				} 
			//print_r("else here"); die; 
		return Redirect::route('contractors.edit', $id)
			->withInput()
			->withErrors($validation);
	}
	
	

	/**
	 * Change password.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function changepassword()
	{
		$contractor=Contractor::Where('id',Auth::id())->get();
		return View::make('contractors.changepassword', compact('contractor'));
	}
	public function storepassword()
	{
		$input = Input::all();
		$validation = Validator::make($input, Contractor::$storepassword);
		if ($validation->passes())
		{
			$contractor	=Contractor::Where('id',Auth::id())->get();
			$oldpass	=$input['old_password'];
			$pass	=$input['new_password'];
			$id=$contractor[0]->id;
			//print_r($id);die;
			if(Hash::check($oldpass,$contractor[0]->password)){
			
				$contractor = Contractor::find(Auth::id());
				$contractor->password = Hash::make($pass);
				$contractor->save();
			
				return Redirect::to('contractors/'.$id)->with('global','Your password has been changed');
			}else{
				return Redirect::route('contractors.changepassword')
			->with('global','Your old password is incorrect');
			}
			return Redirect::route('contractors.changepassword')
			->with('global','Your old password is incorrect');
			
		return Redirect::route('dashboard');
		}
		return Redirect::route('contractors.changepassword')
			->withInput()
			->withErrors($validation);
		print_r($input);die;
		
	}
	 /* Billing information the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function billingifo()
	{
		$contractor=Contractor::Where('id','=',Auth::id())->get();
		return View::make('contractors.billingifo', compact('contractor'));
	}
	public function storebillingifo()
	{
		$input = Input::all(); 
		//print_r($input);die;
		$validation = Validator::make($input, Contractor::$storebilling);
		if ($validation->passes())
		{
			 $contractor = Contractor::find(Auth::id());
			$contractor->cardholdername =$input['cardholdername']; 
			$contractor->cardno =$input['cardno'];
			$contractor->expmonth = $input['expmonth']; 
			$contractor->expyear = $input['expyear']; 
			$contractor->save();
			return Redirect::to('contractors/'.Auth::id())->with('global','Your Billing information has been saved');
		}
		return Redirect::route('contractors.billingifo')
			->withInput()
			->withErrors($validation);
	}
	 /**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->contractor->find($id)->delete();

		return Redirect::route('contractors.index');
	}

}
