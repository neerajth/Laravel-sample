<?php

class UnitsController extends BaseController {

	/**
	 * Unit Repository
	 *
	 * @var Unit
	 */
	protected $unit;

	public function __construct(Unit $unit)
	{
		$this->unit = $unit;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	/* if(Session::get('usertype') == "administrator"){ */
		//$units = $this->unit->all();
		$units = Unit::where('contractorid','=',Auth::id())->paginate(15);
		
		return View::make('units.index', compact('units'));
		/* }else{
		//return Redirect::to('units.index',array('?success_message'=>'Unit created successfully!'));
		return Redirect::to('dashboard');
		} */
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		/* if(Session::get('usertype') == "administrator"){ */
			return View::make('units.create');
		/* }else{
			return Redirect::to('dashboard');
		}	 */
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		//print_r($input);die;
		$validation = Validator::make($input, Unit::$rules);

		if ($validation->passes())
		{
			//$this->unit->create($input);
			if(isset($input['taskid'])){
			$objunit = new Unit();
			$objunit->contractorid = Auth::id();
			$objunit->name = $input['name'];
			$objunit->abbreviation = $input['abbreviation'];
			$objunit->save();
			return Redirect::to('tasks/'.$_REQUEST['taskid'].'/edit')->with('success_message','Unit created successfully!');
			}else{
			$objunit = new Unit();
			$objunit->contractorid = Auth::id();
			$objunit->name = $input['name'];
			$objunit->abbreviation = $input['abbreviation'];
			$objunit->save();
			return Redirect::route('units.index',array('?success_message'=>'Unit created successfully!'));
			}
			
		}

		return Redirect::route('units.create')
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
		if(Session::get('usertype') == "administrator"){
			$unit = $this->unit->findOrFail($id);
			return View::make('units.show', compact('unit'));
		}else{
			return Redirect::to('dashboard');
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
		/* if(Session::get('usertype') == "administrator"){ */
			$unit = $this->unit->find($id);
			if (is_null($unit))
			{
				return Redirect::route('units.index');
			}
			return View::make('units.edit', compact('unit'));
		/* }else{
			return Redirect::to('dashboard');
		}	 */
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
		$validation = Validator::make($input, Unit::$rules);

		if ($validation->passes())
		{
			$unit = $this->unit->find($id);
			$unit->update($input);

			return Redirect::route('units.index',array('?success_message'=>'Unit updated successfully!'));
		}

		return Redirect::route('units.edit', $id)
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
	
		$this->unit->find($id)->delete();

		return Redirect::route('units.index',array('?success_message'=>'Unit removed successfully!'));
	}

}
