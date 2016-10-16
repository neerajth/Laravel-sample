<?php

class ProjectsController extends BaseController {

	/**
	 * Project Repository
	 *
	 * @var Project
	 */
	 
	protected $project;
	
	public function __construct(Project $project)
	{
		$this->project = $project;
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
		$allowed_columns = ['name', 'tille'];
		$sort = in_array(Input::get('sort'), $allowed_columns) ? Input::get('sort') : 'id';
		$order = Input::get('order') === 'asc' ? 'asc' : 'desc';
		$taskname=isset($input['search']) && !empty($input['search'])? $input['search']: "" ;
		$projects= Project::where('contractorid','=',Auth::id())->where('name','LIKE','%'.$taskname.'%')->orderBy($sort, $order)->paginate(15);

		return View::make('projects.index', compact('projects'));
	}
	public function clientprojects($id)
	{
		$contractorid = Auth::id();
		$projects= Project::where('contractorid','=',Auth::id())->where('clientid','=',$id)->orderBy('id','dsec')->paginate(15);
		return View::make('projects.clientprojects', compact('projects'));
	} 

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$id = Auth::id();
		$listclient= Client::where('contractorid','=',Auth::id())->get();
		return View::make('projects.create', compact('listclient'));
	}
	
	public function projectinfo()
	{
		$input = Input::all();
		 $validation = Validator::make($input, Project::$rulesinfo);
		if ($validation->passes())
		{
		Session::put('clientid', $input['clientname']);
		$projectslist= Jobtype::where('contractorid','=',Auth::id())->lists('name','id');
		return View::make('projects.projectinfo', compact('projectslist'));
		}
		return Redirect::route('projects.create')->withInput()
			->withErrors($validation); 
		
	}
	 
	public function projectJobType()
	{
	
		$input = Input::all();
		
		 $validation = Validator::make($input, Project::$rules);
		if ($validation->passes())
		{ 
		Session::put('name', $input['name']);
		Session::put('description', $input['description']);
		Session::put('projecttype', $input['typeid']);
		
		$id = Auth::id();
		$listjobtypes= Jobtype::where('contractorid','=',Auth::id())->get();
		return View::make('projects.projectjobtype', compact('listjobtypes'));
		 }
		$id = Auth::id();
		$listjobtypes= Jobtype::where('contractorid','=',Auth::id())->get();
		return View::make('projects.projectjobtype', compact('listjobtypes'));
		
	} 
	
	public function projecthistory($id_p)
	{
		
		$projectid = Estimate::where('id','=', $id_p)->Pluck('projectid');
		$estimate = Estimate::find($id_p);
		$estimate->total = str_replace(',','',str_replace('$','',$_REQUEST['tolal']));
		$estimate->percentage = $_REQUEST['multi'];
		$estimate->proposal = $_REQUEST['proposal'];
		/**
		$estimate->down_payment = $_REQUEST['dp'];
		$estimate->completion_foundation = $_REQUEST['cf'];
		$estimate->delivery_cabinets = $_REQUEST['dc'];
		$estimate->final_payment = $_REQUEST['fp'];
		**/
		$estimate->save(); 
		
		DB::statement("DELETE draw_schedule FROM draw_schedule where projectid = ".$projectid." and estimateid = ".$id_p."");
		$draw = json_decode($_REQUEST['draw']);
		$draw_value ="";
		if(count($draw[0])>0){
			for($i=0; $i<count($draw[0]); $i++){
			
				$drawLab = $draw[0][$i] != '' ? $draw[0][$i] : null ;
				$drawVal = $draw[1][$i] != '' ? $draw[1][$i] : 0 ;
				if($i==0){
					$draw_value .= "(".$projectid.",".$id_p.",'".$drawLab."',".$drawVal.")";
				}else{
					$draw_value .= ",(".$projectid.",".$id_p.",'".$drawLab."',".$drawVal.")";
				}	
			}
			DB::statement("INSERT into draw_schedule (`projectid`, `estimateid`, `draw_label`, `draw_value`) values ".$draw_value );
		}
		
		if($_REQUEST['urls'] == 'estimates'){
			return Redirect::to('estimates');
		}else{
			return Redirect::to('projects/'.$projectid.'?active=1');
		}
	}
	
	public function spec($id_p)
	{
		$id = Auth::id();
		//die($id_p);
		$projects= Project::where('contractorid','=',Auth::id())->get();
		$project = $projects->find($id_p);
		// return View::make('projects.spec', compact('id','project'));
					
		//echo '<pre/>';print_r($specific);die; 
		if(isset($_REQUEST['status']) && $_REQUEST['status']=="pdf"){
			/**
			 $pdf = App::make('dompdf');
			$pdf->loadHTML('<h1>Hello World!!</h1>');
			$pdf = PDF::loadView('projects.spec', compact('project'));
			$pdf->loadhtml('<div>hello</div>')->setPaper('a4')->setOrientation('landscape')->setWarnings(false);
				**/
			//$designation = "uploads/estimates/".Auth::id().'/';
			$designation = "uploads/estimates/";
			$filename='Estimate-'.date('M-d-Y').'-'.date('H-m-s').'.pdf';
			$estimate= new Estimate;
			$estimate->contractorid = Auth::id();
			$estimate->projectid = $id_p;
			$estimate->title = $filename;
			$estimate->file = $filename;
			$estimate->total = str_replace(',','',str_replace('$','',$_REQUEST['tolal']));
			//$estimate->legend = $_REQUEST['legend'];
			$estimate->percentage = $_REQUEST['multi'];
			$estimate->proposal = $_REQUEST['proposal'];
			/**
			$estimate->down_payment = $_REQUEST['dp'];
			$estimate->completion_foundation = $_REQUEST['cf'];
			$estimate->delivery_cabinets = $_REQUEST['dc'];
			$estimate->final_payment = $_REQUEST['fp'];
			**/
			$estimate->save();
			
			$lastjobtypeid = DB::getPdo()->lastInsertId();
			
			$draw = json_decode($_REQUEST['draw']);
			$draw_value ="";
			if(count($draw[0])>0){
				for($i=0; $i<count($draw[0]); $i++){
				
					$drawLab = $draw[0][$i] != '' ? $draw[0][$i] : null ;
					$drawVal = $draw[1][$i] != '' ? $draw[1][$i] : 0 ;
					if($i==0){
						$draw_value .= "(".$id_p.",".$lastjobtypeid.",'".$drawLab."',".$drawVal.")";
					}else{
						$draw_value .= ",(".$id_p.",".$lastjobtypeid.",'".$drawLab."',".$drawVal.")";
					}	
				}
				DB::statement("INSERT into draw_schedule (`projectid`, `estimateid`, `draw_label`, `draw_value`) values ".$draw_value );
			}
		
			$specific = Specification::where('projectid','=',$id_p)->where('contractorid', Auth::id())->get(); 
			
			foreach($specific as $specifics){
			
			$sepcchistory= new Sepchistories;
			$sepcchistory->	estimateid = $lastjobtypeid;
			$sepcchistory->contractorid = Auth::id();
			$sepcchistory->clientid = $specifics->clientid;
			$sepcchistory->projectid = $specifics->projectid;
			$sepcchistory->jobtypeid = $specifics->jobtypeid;
			$sepcchistory->taskcategoryid = $specifics->taskcategoryid;
			$sepcchistory->taskid = $specifics->taskid;
			$sepcchistory->jobtype_title = $specifics->jobtype_title;
			$sepcchistory->taskcategory_title = $specifics->taskcategory_title;
			$sepcchistory->task_title = $specifics->task_title;
			$sepcchistory->estimate = $specifics->estimate;
			$sepcchistory->qty = $specifics->qty;
			$sepcchistory->cost_per_unit = $specifics->cost_per_unit;
			$sepcchistory->actual = $specifics->actual;
			$sepcchistory->over_under = $specifics->over_under;
			$sepcchistory->subtotal = $specifics->subtotal;
			$sepcchistory->description = $specifics->description;
			$sepcchistory->ordering = $specifics->ordering;
			$sepcchistory->save();
			}
			
			//$pdf=PDF::loadView('projects.spec', compact('project'))->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->save($designation.$filename);
			//$subtotals= Specification::where('contractorid','=',Auth::id())->where('projectid','=',$id_p)->sum('subtotal');
			//print_r($subtotals);die;
			return Redirect::to('projects/'.$id_p.'?active=1');
			
		}
		
		if(isset($_REQUEST['status']) && $_REQUEST['status']=="email"){
			$data =array('hello','welcome');
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
			return Redirect::route('projects.show',$id_p);			
		}		
		return Redirect::route('projects.show',$id_p);		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	 
	public function description(){
	//die("here");
	
	$input = array_except(Input::all(), '_method');

	// if(isset($input) && !empty($input)){
	//print_r($input['name']); die;
	$sepobject = Specification::find($input['id']);
	if ( isset($input['from']) && $input['from'] == "loaddesc" )
	{
		$textareaDesc = str_replace('<br />', PHP_EOL, $sepobject->description);
		print(json_encode(array('descriptiontext'=>$textareaDesc)));
		die;
	}
	$sepobject->description = $input['name'];
	$sepobject->save(); 
	$descdtail=Specification::where('id','=',$input['id'])->Pluck('description');
		
		print_r (json_encode(array('specid'=>$input['id'],'descdtail'=>$descdtail)));
	
	}
	
	public function historydescription(){
	//die("here");
	
		$input = array_except(Input::all(), '_method');

		// if(isset($input) && !empty($input)){
		//print_r($input['name']); die;
		$sepobject = Sepchistories::find($input['id']);
		if ( isset($input['from']) && $input['from'] == "loaddesc" )
		{
			$textareaDesc = str_replace('<br />', PHP_EOL, $sepobject->description);
			print(json_encode(array('descriptiontext'=>$textareaDesc)));
			die;
		}
		$sepobject->description = $input['name'];
		$sepobject->save(); 
		$descdtail=Sepchistories::where('id','=',$input['id'])->Pluck('description');
			
			print_r (json_encode(array('specid'=>$input['id'],'descdtail'=>$descdtail)));
	
	}
	
	public function updatedescription(){
	$input = array_except(Input::all(), '_method');
	$sepobject = Specification::find($input['sepid']);
	$sepobject->description = $input['description'];
	$sepobject->save(); 
	echo "<script>window.close();</script>";
	print_r($input);
	die($input);
	
	}
	public function store()
	{
		$input = Input::all();
		//print_r($input);die;
		$validation = Validator::make($input, Project::$rule);

		if ($validation->passes())
		{
			$objproject = new Project;
			$objproject->contractorid = Auth::id();
			$objproject->clientid = Session::get('clientid');
			$objproject->name = $input['name'];
			$objproject->description = $input['description'];
			$objproject->save();
			$lastprojectid = DB::getPdo()->lastInsertId(); 
			if(isset($input["jobtypeid"])){
				foreach ( $input["jobtypeid"]  as $jtid ) 
				{ 
					$tcids=Contractjobtypetaskcategoriesdefault::where('jobtypeid', '=', $jtid)->where('contractorid', '=', Auth::id())->get();
					foreach ( $tcids  as $tcid ) 
					{ 
						$objjobtypetca = new Contractjobtypetaskcategoriesactual;
						$objjobtypetca->contractorid = Auth::id();
						$objjobtypetca->projectid = $lastprojectid; 
						$objjobtypetca->jobtypeid = $jtid;
						$objjobtypetca->taskcategoryid = $tcid->taskcategoryid;
						$objjobtypetca->save();
					}	
				}
				foreach ( $input["jobtypeid"]  as $jtid ) 
				{ 
					$tcids=Contractjobtypetaskcategoriesdefault::where('jobtypeid', '=', $jtid)->where('contractorid', '=', Auth::id())->get();
					foreach ( $tcids  as $tcid ) 
					{ 
						$tids=Tasksincategoriesdefault::where('taskcategoryid', '=', $tcid->taskcategoryid)->where('contractorid', '=', Auth::id())->get(); 
						$counter=1;
						foreach ( $tids  as $tid ) 
						{
						
						$objjobtypetca = new Specification;
						$objjobtypetca->contractorid = Auth::id();
						$objjobtypetca->clientid = Session::get('clientid');
						$objjobtypetca->projectid = $lastprojectid; 
						$objjobtypetca->jobtypeid = $jtid;
						
						$objjobtypetca->jobtype_title = Jobtype::where('id', '=', $jtid)->Pluck('name');
						
						$objjobtypetca->taskcategoryid = $tcid->taskcategoryid;
						$objjobtypetca->ordering = $counter;
						
						$objjobtypetca->taskcategory_title = Taskcategory::where('id', '=', $tcid->taskcategoryid)->Pluck('name');
						
						$objjobtypetca->taskid = $tid->taskid;
						
						$objjobtypetca->task_title =  Task::where('id', '=', $tid->taskid)->Pluck('taskname');
						$objjobtypetca->cost_per_unit =  Task::where('id', '=', $tid->taskid)->Pluck('cost_per_unit');
						$objjobtypetca->description =  Task::where('id', '=', $tid->taskid)->Pluck('description');
						
						$objjobtypetca->save();
						}
						
					}	
				}
			}
			//$this->project->create($input);

			return Redirect::route('projects.index');
		}

		return Redirect::route('projects.create')
			->withInput()
			->withErrors($validation);
	}
	/**
	 * Display the specified old resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
public function showsepc($id)
	{
		$input = Input::all();
			/**
			if(isset($_REQUEST['o']) && isset($_REQUEST['o'])){
			$order = $_REQUEST['o'];
			$sorting= $_REQUEST['s'];
			}else{
			$order = 'asc';
			$sorting= 'id';
			}**/
		$taskname=isset($input['search']) && !empty($input['search'])? $input['search']: "" ;
		//$specification = Sepchistories::where('estimateid','=',$id)->where('contractorid', Auth::id())->groupBy('jobtypeid')->orderBy($sorting, $order)->get();
		//$project = $this->project->findOrFail($_REQUEST['id']);
		$urls = isset($input['urls']) && !empty($input['urls'])? $input['urls']: "" ;
		
		$specification = Sepchistories::where('estimateid','=',$id)->where('contractorid', Auth::id())->where('task_title','LIKE','%'.$taskname.'%')->groupBy('jobtypeid')->get();
		$estimates= Estimate::where('contractorid', Auth::id())->where('id',$id)->get();
		$estimatesProjectId= Estimate::where('contractorid', Auth::id())->where('id',$id)->Pluck('projectid');
		$project = $this->project->findOrFail($estimatesProjectId);
		//print_r($estimates);
		return View::make('projects.showsepc', compact('project','estimates','specification','id','urls'));
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$input = Input::all();
		//print_r($input); //die;
		$project = $this->project->findOrFail($id);
			/**if(isset($_REQUEST['o']) && isset($_REQUEST['o'])){
			$order = $_REQUEST['o'];
			$sorting= $_REQUEST['s'];
			}else{
			$order = 'asc';
			$sorting= 'id';
			}**/
			$taskname=isset($input['search']) && !empty($input['search'])? $input['search']: "" ;
		$specification = Specification::where('projectid','=',$id)->where('contractorid', Auth::id())->where('task_title','LIKE','%'.$taskname.'%')->groupBy('jobtypeid')->get();
		//$specification = Specification::where('task_title','LIKE','%'.$taskname.'%')->groupBy('jobtypeid')->orderBy($sorting, $order)->get();
		
		
		
		$tasks= Contractjobtypetaskcategoriesactual::where('projectid','=',$id)->where('contractorid', Auth::id())->groupBy('jobtypeid')->get();
		//echo '<pre/>';print_r($specification); die;
		$noteslist= Note::where('projectid','=',$id)->where('contractorid', Auth::id())->orderBy('id', 'DESC')->get();
		$resources= Resource::where('projectid','=',$id)->where('contractorid', Auth::id())->orderBy('id', 'DESC')->get();
		$invoices= Invoice::where('projectid','=',$id)->where('contractorid', Auth::id())->orderBy('id', 'DESC')->get();
		$estimates= Estimate::where('projectid','=',$id)->where('contractorid', Auth::id())->orderBy('id', 'DESC')->get();
		
		return View::make('projects.show', compact('project','tasks','noteslist','resources','invoices','estimates','specification','id'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$project = $this->project->find($id);
		$listclient= Client::where('contractorid', Auth::id())->lists('firstname','id');
		$actualpro= Contractjobtypetaskcategoriesactual::where('contractorid', Auth::id())->where('projectid','=',$id)->groupBy('jobtypeid')->get();
		/**
		$delquery = "";
		for($i=0; $i<count($actualpro); $i++){
			if($i==0){
				$delquery .= " id != '{$actualpro[$i]->jobtypeid}' ";
			}else{
				$delquery .= "and id != '{$actualpro[$i]->jobtypeid}' ";
			} 
		}
		$listjobtypes = DB::select("select * FROM jobtypes where contractorid = '".Auth::id()."' and ".$delquery." ");
		**/
		$listjobtypes= Jobtype::where('contractorid', Auth::id())->get();
		$projectslist= Projecttype::lists('name','id'); 
		
		if (is_null($project)){
			return Redirect::route('projects.index');
		}

		return View::make('projects.edit', compact('project','listclient','actualpro','listjobtypes','projectslist'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updatespecification()
	{
		$input = array_except(Input::all(), '_method');
		
		$value 	= $input['value'];
		
		$decrypt= strrev(base64_decode(base64_decode(base64_decode($input['crypto']))));
		$explode = explode('|', $decrypt);
		
		//print_r($value); echo "<br><pre>";  print_r($explode); die;
		
		$columnName = $explode[0];
		$rowId = $explode[1];
		// print_r($columnName);die;
		//print_r($rowId);  
		$sepvalue = Specification::where('id','=',$rowId)->get();
	
		if($columnName == "actual"){
			if($value == "" || $value == 0){
				$over= "";
				$sub= $sepvalue[0]->estimate;
				$estvalue= $sepvalue[0]->estimate;
			}else{
				$over= $sepvalue[0]->estimate - $value;
				$sub= $value;
				$estvalue= $sepvalue[0]->estimate;
			}
		}elseif($columnName == "qty"){
				$estvalue= $explode[2] * $value;
				if($sepvalue[0]->actual =="" || $sepvalue[0]->actual==0){
					$over= "";
					$sub= $explode[2] * $value;
				}else{
					$over= $sepvalue[0]->estimate - $sepvalue[0]->actual;
					$sub=	$sepvalue[0]->actual;
				}
		}elseif($columnName == "cost_per_unit"){
			$estvalue= $value*$sepvalue[0]->qty;
			if($sepvalue[0]->actual =="" || $sepvalue[0]->actual==0){
					$over= "";
					$sub= $value*$sepvalue[0]->qty;
				}else{
					$over= ($value*$sepvalue[0]->qty) - $sepvalue[0]->actual;
					$sub=	$sepvalue[0]->actual;
				}
		
		}elseif($columnName == "ordering"){
		$estvalue= $sepvalue[0]->estimate;
		$over= $sepvalue[0]->over_under;
		$sub= $sepvalue[0]->subtotal;
		}
	//	print_r($rowId." ".$estvalue ." ". $over." ".$sub); die;	
		$objproject = Specification::find($rowId);
		$objproject->$columnName = $value;
		$objproject->estimate = $estvalue;
		$objproject->over_under = $over;
		$objproject->subtotal = $sub;
		$objproject->save(); 
	
		$specifics = Specification::where('id','=',$rowId)->get(); 
		//$costpunit= Task::where('id', $specifics[0]->taskid)->Pluck('cost_per_unit');
		$tolal=Specification::where('contractorid','=',Auth::id())->where('projectid','=',$specifics[0]->projectid)->sum('subtotal');
		$totalofjobtype=Specification::where('contractorid','=',Auth::id())->where('projectid','=',$specifics[0]->projectid)->where('jobtypeid','=',$specifics[0]->jobtypeid)->sum('subtotal');
		$totaloftc=	Specification::where('contractorid','=',Auth::id())->where('projectid','=',$specifics[0]->projectid)->where('jobtypeid','=',$specifics[0]->jobtypeid)->where('taskcategoryid','=',$specifics[0]->taskcategoryid)->sum('subtotal');
		
		$aj_estimate = str_replace('$-','-$','$'.number_format($specifics[0]->estimate, 2));
		$aj_actual = str_replace('$-','-$','$'.number_format($specifics[0]->actual, 2));
		$aj_over_under = str_replace('$-','-$','$'.number_format($specifics[0]->over_under, 2));
		$aj_subtotal = str_replace('$-','-$','$'.number_format($specifics[0]->subtotal, 2));
		$aj_total = str_replace('$-','-$','$'.number_format($tolal, 2));
		$aj_totalofjobtype = str_replace('$-','-$','$'.number_format($totalofjobtype, 2));
		$aj_totaloftc = str_replace('$-','-$','$'.number_format($totaloftc, 2));
		
		print_r (json_encode(array('result1'=>$rowId,'costunit'=>$specifics[0]->cost_per_unit,'jobid'=>$specifics[0]->jobtypeid,'tcid'=>$specifics[0]->taskcategoryid,'qty'=>$specifics[0]->qty,'estimate'=>$aj_estimate,'actual'=>$aj_actual,'over_under'=>$aj_over_under,'subtotal'=>$aj_subtotal,'total'=>$aj_total,'total_val'=>$tolal,'totalofjobtype'=>$aj_totalofjobtype,'totaloftc'=>$aj_totaloftc))); 
	}
	public function updatespecarchive()
	{
	
		$input = array_except(Input::all(), '_method');
		
		$value 	= $input['value'];
		
		$decrypt= strrev(base64_decode(base64_decode(base64_decode($input['crypto']))));
		$explode = explode('|', $decrypt);
		$columnName = $explode[0];
		$rowId = $explode[1];
		// print_r($columnName);die;
		//print_r($rowId); die; 
		$sepvalue = Sepchistories::where('id','=',$rowId)->get();
	
		if($columnName == "actual"){
			if($value == "" || $value == 0){
				$over= "";
				$sub= $sepvalue[0]->estimate;
				$estvalue= $sepvalue[0]->estimate;
			}else{
				$over= $sepvalue[0]->estimate - $value;
				$sub= $value;
				$estvalue= $sepvalue[0]->estimate;
			}
		}elseif($columnName == "qty"){
				$estvalue= $explode[2] * $value;
				if($sepvalue[0]->actual =="" || $sepvalue[0]->actual==0){
					$over= "";
					$sub= $explode[2] * $value;
				}else{
					$over= $sepvalue[0]->estimate - $sepvalue[0]->actual;
					$sub=	$sepvalue[0]->actual;
				}
		}elseif($columnName == "cost_per_unit"){
			$estvalue= $value*$sepvalue[0]->qty;
			if($sepvalue[0]->actual =="" || $sepvalue[0]->actual==0){
					$over= "";
					$sub= $value*$sepvalue[0]->qty;
				}else{
					$over= ($value*$sepvalue[0]->qty) - $sepvalue[0]->actual;
					$sub=	$sepvalue[0]->actual;
				}
		
		}elseif($columnName == "ordering"){
		$estvalue= $sepvalue[0]->estimate;
		$over= $sepvalue[0]->over_under;
		$sub= $sepvalue[0]->subtotal;
		}
		//print_r($rowId." ".$estvalue ." ". $over." ".$sub); die;	
		$objproject = Sepchistories::find($rowId);
		$objproject->$columnName = $value;
		$objproject->estimate = $estvalue;
		$objproject->over_under = $over;
		$objproject->subtotal = $sub;
		$objproject->save(); 
	///print_r("here");die;
		$specifics = Sepchistories::where('id','=',$rowId)->get(); 
		//$costpunit= Task::where('id', $specifics[0]->taskid)->Pluck('cost_per_unit');
		
		$tolal=Sepchistories::where('contractorid','=',Auth::id())->where('projectid','=',$specifics[0]->projectid)->where('estimateid','=',$specifics[0]->estimateid)->sum('subtotal');
		$totalofjobtype=Sepchistories::where('contractorid','=',Auth::id())->where('projectid','=',$specifics[0]->projectid)->where('estimateid','=',$specifics[0]->estimateid)->where('jobtypeid','=',$specifics[0]->jobtypeid)->sum('subtotal');
		$totaloftc=Sepchistories::where('contractorid','=',Auth::id())->where('projectid','=',$specifics[0]->projectid)->where('estimateid','=',$specifics[0]->estimateid)->where('jobtypeid','=',$specifics[0]->jobtypeid)->where('taskcategoryid','=',$specifics[0]->taskcategoryid)->sum('subtotal');
		
		$aj_estimate = str_replace('$-','-$','$'.number_format($specifics[0]->estimate, 2));
		$aj_actual = str_replace('$-','-$','$'.number_format($specifics[0]->actual, 2));
		$aj_over_under = str_replace('$-','-$','$'.number_format($specifics[0]->over_under, 2));
		$aj_subtotal = str_replace('$-','-$','$'.number_format($specifics[0]->subtotal, 2));
		$aj_total = str_replace('$-','-$','$'.number_format($tolal, 2));
		$aj_totalofjobtype = str_replace('$-','-$','$'.number_format($totalofjobtype, 2));
		$aj_totaloftc = str_replace('$-','-$','$'.number_format($totaloftc, 2));
		
		print_r (json_encode(array('result1'=>$rowId,'costunit'=>$specifics[0]->cost_per_unit,'jobid'=>$specifics[0]->jobtypeid,'tcid'=>$specifics[0]->taskcategoryid,'qty'=>$specifics[0]->qty,'estimate'=>$aj_estimate,'actual'=>$aj_actual,'over_under'=>$aj_over_under,'subtotal'=>$aj_subtotal,'total'=>$aj_total,'total_val'=>$tolal,'totalofjobtype'=>$aj_totalofjobtype,'totaloftc'=>$aj_totaloftc))); 
		
	}
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Project::$rules);

		if ($validation->passes())
		{
			$objproject = Project::find($id);
			$objproject->clientid = $input['clientid'];
			$objproject->name = $input['name'];
			$objproject->description = $input['description'];
			$objproject->save(); 
			
			//Contractjobtypetaskcategoriesactual::where('Projectid', $id)->delete();
			//Specification::where('Projectid', $id)->delete();	
			
			$listjobtypes= Jobtype::where('contractorid', Auth::id())->get();
			if(isset($input["jobtypeid"])){
				$inputJT = $input["jobtypeid"];
			}else{
				$inputJT = array();
			}
			foreach($listjobtypes as $key =>  $jt){
				 if(!in_array($jt->id,$inputJT)){
					Contractjobtypetaskcategoriesactual::where('projectid', $id)->where('contractorid', '=', Auth::id())->where('jobtypeid', '=', $jt->id)->delete();
					Specification::where('projectid', $id)->where('contractorid', '=', Auth::id())->where('jobtypeid', '=', $jt->id)->delete();	
				 }
			}							 
			
			foreach ( $inputJT  as $jtid ) 
			{ 
				$count1 = DB::table('contractjobtypetaskcategoriesactuals')->select(DB::raw('count(*) as count'))->where('projectid', '=', $id)->where('contractorid', '=', Auth::id())->where('jobtypeid', '=', $jtid)->get();
				
				$count2 = DB::table('specifications')->select(DB::raw('count(*) as count'))->where('projectid', '=', $id)->where('contractorid', '=', Auth::id())->where('jobtypeid', '=', $jtid)->get();
				
				if($count1[0]->count == 0){
					$tcids=Contractjobtypetaskcategoriesdefault::where('jobtypeid', '=', $jtid)->where('contractorid', '=', Auth::id())->get();
					 foreach ( $tcids  as $tcid ){ 
						$objjobtypetca = new Contractjobtypetaskcategoriesactual;
						$objjobtypetca->contractorid = Auth::id();
						$objjobtypetca->projectid = $id; 
						$objjobtypetca->jobtypeid = $jtid;
						$objjobtypetca->taskcategoryid = $tcid->taskcategoryid;
						$objjobtypetca->save();
					}	
				}
				if($count2[0]->count == 0){
					$tcids=Contractjobtypetaskcategoriesdefault::where('jobtypeid', '=', $jtid)->where('contractorid', '=', Auth::id())->get();
					foreach ( $tcids  as $tcid ){ 
						$tids=Tasksincategoriesdefault::where('taskcategoryid', '=', $tcid->taskcategoryid)->where('contractorid', '=', Auth::id())->get(); 
						$counter=1;
						foreach ( $tids  as $tid ) 
						{
						$objjobtypetca = new Specification;
						$objjobtypetca->contractorid = Auth::id();
						$objjobtypetca->clientid = $input['clientid'];
						$objjobtypetca->projectid = $id; 
						$objjobtypetca->jobtypeid = $jtid;
						$objjobtypetca->taskcategoryid = $tcid->taskcategoryid;
						$objjobtypetca->taskid = $tid->taskid;
						$objjobtypetca->ordering = $counter;
						$objjobtypetca->jobtype_title = Jobtype::where('id', '=', $jtid)->Pluck('name');
						$objjobtypetca->taskcategory_title = Taskcategory::where('id', '=', $tcid->taskcategoryid)->Pluck('name');
						$objjobtypetca->task_title =  Task::where('id', '=', $tid->taskid)->Pluck('taskname');
						$objjobtypetca->cost_per_unit =  Task::where('id', '=', $tid->taskid)->Pluck('cost_per_unit');
						$objjobtypetca->save();
						$counter++;		
						}
					}
				}
			}
			return Redirect::route('projects.show', $id);
		}
		return Redirect::route('projects.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
		$this->project->find($id)->delete();
		Contractjobtypetaskcategoriesactual::where('projectid', $id)->where('contractorid', Auth::id())->delete();
		Specification::where('projectid', $id)->where('contractorid', Auth::id())->delete();
		Estimate::where('projectid', $id)->where('contractorid', Auth::id())->delete();
		Invoice::where('projectid', $id)->where('contractorid', Auth::id())->delete();
		Note::where('projectid', $id)->where('contractorid', Auth::id())->delete();
		Resource::where('projectid', $id)->where('contractorid', Auth::id())->delete();
		
		return Redirect::route('projects.index');
	}
	public function delete($id)
	{
		//die($id);
		//$this->project->find($id)->delete();
		Contractjobtypetaskcategoriesactual::where('jobtypeid', $id)->where('projectid', $_REQUEST['id'])->where('contractorid', Auth::id())->delete();
		Specification::where('jobtypeid', $id)->where('projectid', $_REQUEST['id'])->where('contractorid', Auth::id())->delete();
		return Redirect::route('projects.edit',$_REQUEST['id']);
	}
	public function deletesepc($id)
	{
		
		//$this->project->find($id)->delete();
		//Specification::where('id', $id)->where('contractorid', Auth::id())->delete();
		//return Redirect::to('projects/'.$_REQUEST['pid']);
		
		//echo "<pre>"; print_r($_REQUEST['sdel_task_ck']); die;
		$delquery ="";
		if(isset($_REQUEST['sdel_task_ck']) && count($_REQUEST['sdel_task_ck']) != 0){
			for($i=0; $i<count($_REQUEST['sdel_task_ck']); $i++){
				
				if($i==0){
					$delquery .= "id = '{$_REQUEST['sdel_task_ck'][$i]}' ";
				}else{
					$delquery .= "or id = '{$_REQUEST['sdel_task_ck'][$i]}' ";
				} 
			}
			
			$tcIdsbeforeDel = DB::select("select taskcategoryid, jobtypeid FROM specifications where projectid = '".$id."' and contractorid = '".Auth::id()."' and ( ".$delquery." ) group by taskcategoryid");
			
			DB::statement("DELETE specifications FROM specifications where projectid = '".$id."' and contractorid = '".Auth::id()."' and ( ".$delquery." )");
			
			foreach($tcIdsbeforeDel as $bdel){
				$count = DB::table('specifications')->select(DB::raw('count(*) as count'))->where('projectid', '=', $id)->where('contractorid', '=', Auth::id())->where('taskcategoryid', '=', $bdel->taskcategoryid)->where('jobtypeid', '=', $bdel->jobtypeid)->get();
				
				if($count[0]->count == 0){
					Contractjobtypetaskcategoriesactual::where('jobtypeid', $bdel->jobtypeid)->where('taskcategoryid', $bdel->taskcategoryid)->where('projectid', $id)->where('contractorid', Auth::id())->delete();
				}
			}
		}
		return Redirect::to('projects/'.$id);
		
	}
	

}
