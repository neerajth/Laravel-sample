@extends('layouts.user')

@section('main')
<div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>View Task Categories</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
							<span>></span>
							<span>View Task Categories</span>
						</div>
					</div><!--title-page-->
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow account right">
					<div class="row text">
					<p>Adding custom task categories allows you to organize groups of tasks that will be needed for particular jobs.</p>
					<a class="btn orange right" href="{{{ URL::to('/taskcategories/create') }}}">Create Task Category</a>
					</div>
					@if (count($taskcategories))
					<ul class="title-list">
                        <li>
                            <span class="title">Task Category Name</span>
                            <span class="name">Number of Tasks</span>
                        </li>
                   </ul>
                   <ul class="body-list">
                   		@foreach ($taskcategories as $taskcategory)
                        <li>
                            <span class="title">{{{ $taskcategory->name }}}</span>
                            <span class="name">{{Tasksincategoriesdefault::where('taskcategoryid', '=', $taskcategory->id)->count();}}</span>
                            <span class="link">
								{{ link_to_route('taskcategories.edit', 'Edit', array($taskcategory->id), array('style'=>'text-decoration: underline;')) }}
							</span>
							<span class="link">
								{{ Form::open(array('method' => 'DELETE','id'=>'delete','onsubmit'=>'return confirmDelete()', 'route' => array('taskcategories.destroy', $taskcategory->id))) }}
									{{ Form::submit('Delete', array('class'=>'deleting', 'style'=>'text-decoration: underline;', 'onclick'=>'deleteItem()')) }}
								{{ Form::close() }}
								<!--<a style="text-decoration: underline;" href="">View Project</a>-->
							</span>
                        </li>
                        @endforeach
                    </ul>
					{{ $taskcategories->links() }}
                    @else
						<div class="row">
							<div class="success">There are no taskcategories</div><!--success-->
						</div><!--row-->
					@endif    
					</article>
				</div>		
			</div>
	</section>
</div>
@stop
