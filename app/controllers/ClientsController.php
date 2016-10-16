<?php

class ClientsController extends BaseController {

	/**
	 * Client Repository
	 *
	 * @var Client
	 */
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
		$id = Auth::id();
		$searchinput = isset($input['search']) && !empty($input['search'])? $input['search']: "" ;
		if($searchinput!=''){
			/**	$datasearch = Client::where('contractorid','=',Auth::id())
								->where(function ($query) use ($searchinput) {
								$query->where('firstname', 'LIKE', "%{$searchinput}%")
								->orwhere('lastname', 'LIKE', "%{$searchinput}%")
								->orwhere('second_firstname', 'LIKE', "%{$searchinput}%")
								->orwhere('second_lastname', 'LIKE', "%{$searchinput}%")->get();
								})->get();	**/			
		}else{	
			//$datasearch = Client::where('contractorid','=',Auth::id())->get();
		}
		//$clients = $datasearch->sortBy(function($datasearch){return $datasearch->lastname;});
		$clients = Client::where('contractorid','=',Auth::id())
								->where(function ($query) use ($searchinput) {
								$query->where('firstname', 'LIKE', "%{$searchinput}%")
								->orwhere('lastname', 'LIKE', "%{$searchinput}%")
								->orwhere('second_firstname', 'LIKE', "%{$searchinput}%")
								->orwhere('second_lastname', 'LIKE', "%{$searchinput}%")->get();
								})->orderBy('lastname','ASC')->paginate(10);
								
		
		/**
		if(isset($input['search']) && !empty($input['search'])){
			$clients = Client::where('contractorid','=',Auth::id())->where('firstname','LIKE','%'.$taskname.'%')->orderBy('lastname', 'DESC')->get();
		}else{
			$clients=Client::where('contractorid','=',Auth::id())->where('firstname','LIKE','%'.$taskname.'%')->where('lastname','LIKE','%'.$taskname.'%')->orderBy('lastname', 'DESC')->get();
		}
		**/
	///	$clients = Client::select(DB::raw('concat (firstname," ",lastname) as full_name'))->where('contractorid','=',Auth::id())->orderBy('lastname', 'ASC')->get();
		
			//echo'<pre/>';print_r($clients);
		return View::make('clients.index', compact('clients'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	
		$id = Auth::id();
		$state = State::lists('statename', 'id');	
		return View::make('clients.create', compact('result','id','state'));
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		//print_r($input); die;
		$user = new Client;
		$validation = Validator::make($input, Client::$rules);
		
		
		if(isset($input['project']) && $input['project'] == "project"){
		if ($validation->passes())
		{
		$user->contractorid = $input['contractorid']; 
		$user->firstname = $input['firstname']; 
		$user->lastname = $input['lastname']; 
		$user->second_firstname = $input['second_firstname']; 
		$user->second_lastname = $input['second_lastname']; 
		$user->phone = $input['phone']; 
		$user->email = $input['email'];
		$user->street1 = $input['street1'];
		$user->street2 = $input['street2'];
		$user->city = $input['city'];
		$user->statecity = $input['statecity'];
		$user->zip = $input['zip'];
		//$user->Gender = $input['Gender'];
		$user->client_note = $input['client_note'];
		$user->save();
		//$this->client->create($input);
		return Redirect::route('projects.create');
		}
		
		}else{
		if ($validation->passes())
		{
		//$this->client->create($input);
		$user->contractorid = $input['contractorid']; 
		$user->firstname = $input['firstname']; 
		$user->lastname = $input['lastname']; 
		$user->second_firstname = $input['second_firstname']; 
		$user->second_lastname = $input['second_lastname']; 
		$user->phone = $input['phone']; 
		$user->email = $input['email'];
		$user->street1 = $input['street1'];
		$user->street2 = $input['street2'];
		$user->city = $input['city'];
		$user->statecity = $input['statecity'];
		$user->zip = $input['zip'];
		//$user->Gender = $input['Gender'];
		$user->client_note = $input['client_note'];
		$user->save();
		return Redirect::route('clients.index',array('?action'=>'created_client'));
		}
		}	
		return Redirect::route('clients.create')
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$client = $this->client->findOrFail($id);
		$state = State::find($client->statecity);
		return View::make('clients.show', compact('client','state'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$client = $this->client->find($id);
		  $state = State::lists('statename', 'id');
		if (is_null($client))
		{
			return Redirect::route('clients.index');
		}

		return View::make('clients.edit', compact('client','state'));
	}
	
	/* public function send($id)
	{
		$client = $this->client->find($id);
		$state = State::lists('statename', 'id');
		return View::make('clients.send', compact('client','state'));
	} */
	

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{	
		$input = array_except(Input::all(), '_method');
		$data = array_except(Input::all(), '_method');
	
		$loginemail= Client::where('id','=',$id)->get();
		$clientemail= Client::where('email','=',$loginemail['0']->email)->get();
		$inputemail= Client::where('email','=',$input['email'])->get();
		/* if(isset($input['status']) && $input['status'] == 'clientemail'){
			
			try{
				Mail::send('emails.welcome', $data, function($message)
				{
					//$message->from('vikaushal22@gmail.com', 'Laravel');
					//$message->to('vikaushal22@gmail.com');
					//$message->attach($pdf);
					
					$message->to('vikaushal22@gmail.com', 'Vikash Kaushal')->subject('Welcome!');
				});
			}catch(Exception $e){
					echo "error :"; print_r($e); die;
			}
			return Redirect::route('clients.index',array('?success_message'=>'Email has been successfully sent.'));
		}else{ */
		$validation = Validator::make($input, Client::$rulesedit);
		
		if ($validation->passes())
		{			
			$client = $this->client->find($id);
			$client->update($input);
			return Redirect::route('clients.show',array($id ,'?success_message'=>'Updated successfully!'));
			
		}

		return Redirect::route('clients.edit', $id)
			->withInput()
			->withErrors($validation);
		/* } */
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->client->find($id)->delete();

		return Redirect::route('clients.index',array('?action'=>'deleted_client'));
	}

}
