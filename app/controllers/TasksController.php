<?php

class TasksController extends BaseController {

	/**
	 * Task Repository
	 *
	 * @var Task
	 */
	protected $task;

	public function __construct(Task $task)
	{
		$this->task = $task;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$id=Auth::id();
		$input = Input::all();
		$searchinput = isset($input['search']) && !empty($input['search'])? $input['search']: "" ;
		
		$tasks= Task::where('contractorid','=',Auth::id())->where('taskname', 'LIKE', "%{$searchinput}%")->paginate(15);
		
		//$tasks= Task::where('contractorid','=',Auth::id())->paginate(15);
		return View::make('tasks.index', compact('tasks'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$id = Auth::id();
		$unit = Unit::where('contractorid','=',Auth::id())->lists('name', 'id');
		return View::make('tasks.create', compact('id','unit'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Task::$rules);

		if ($validation->passes())
		{
			$input['description'] = preg_replace("/(\r\n)+|(\n|\r)+/", "<br />", $input['description']);
			$this->task->create($input);

			return Redirect::route('tasks.index',array('?success_message'=>'Task created successfully!'));
		}

		return Redirect::route('tasks.create')
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
		$task = $this->task->findOrFail($id);

		return View::make('tasks.show', compact('task'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$task = $this->task->find($id);
		$id = Auth::id();
		$unit = Unit::where('contractorid','=',Auth::id())->lists('name', 'id');
		if (is_null($task))
		{
			return Redirect::route('tasks.index');
		}

		return View::make('tasks.edit', compact('task','id','unit'));
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
		$validation = Validator::make($input, Task::$rules);

		if ($validation->passes())
		{
			$input['description'] = preg_replace("/(\r\n)+|(\n|\r)+/", "<br />", $input['description']);
			$task = $this->task->find($id);
			$task->update($input);

			return Redirect::route('tasks.index',array('?success_message'=>'Task updated successfully!'));
		}

		return Redirect::route('tasks.edit', $id)
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
		$this->task->find($id)->delete();

		return Redirect::route('tasks.index',array('?success_message'=>'Task removed successfully!'));
	}

}
