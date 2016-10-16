@extends('layouts.adminlayout')

@section('main')
<div class="my-profile">
	<section class="content">
        <div class="main">
            <div class="content-top">
                <div class="title-page left">
                    <h2>{{{ $contractor->firstname." ".$contractor->lastname }}}</h2>
                    <div class="breadcrumb">
                        <a href="{{{ URL::to('/admin') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
                        <a href="{{{ URL::to('/admin') }}}">Dashboard</a>
                        <span>></span>
                        <span>{{{ $contractor->firstname." ".$contractor->lastname }}}</span>
                    </div>
                </div><!--title-page-->
            </div><!--top-content-->
            
            <div class="content-body">
                
                <article class="shadow account">
                    <form>
                         <div class="row">
							{{ link_to_route('contractors.editadmin', 'Edit Profile', array($contractor->id), array('class' => 'btn orange right')) }}
                        </div> <!--row-->
                        
                        <div class="row">
                            <div class="left">
                                <label>First Name</label>
                                <span>{{{ $contractor->firstname }}}</span>
                            </div>
                            <div class="right">
                                <label>Last Name</label>
                                <span>{{{ $contractor->lastname }}}</span>
                            </div>
                        </div><!--row-->
                        
                        <div class="row">
                            <div class="left">
                                <label>Email Address</label>
                                <span>{{{ $contractor->email }}}</span>
                            </div>
                            <div class="right">
                                <label>Company</label>
                                <span>{{{ $contractor->businessname }}}</span>
                            </div>
                        </div><!--row-->
                        
                        <div class="row">
                            <div class="left">
                                <label>Phone Number</label>
                                <span>{{{ $contractor->phone }}}</span>
                            </div>
                            <div class="right">
                                <label>Fax Number</label>
                                <span>{{{ $contractor->fax }}}</span>
                            </div>
                        </div><!--row-->
                        
                        <div class="row">
                            <div class="left">
                                <label>Address 1</label>
                                <span>{{{ $contractor->street1 }}}</span>
                            </div>
                            <div class="right">
                                <label>Address 2 </label>
                                <span>{{{ $contractor->street2 }}}</span>
                            </div>
                        </div><!--row-->
                        
                        <div class="row">
                            <div class="left">
                                <label>City</label>
                                <span>{{{ $contractor->city }}}</span>
                            </div>
                            <div class="right">
                                <div class="left">
                                    <label>State</label>
                                    <span>{{{ $state->statename }}}</span>
                                </div>
                                <div class="right">
                                    <label>Zip Code</label>
                                    <span>{{{ $contractor->zip }}}</span>
                                </div>
                            </div>
                        </div><!--row-->
                    </form>                          
                </article>
            </div>
        </div><!--main-->
    </section><!--content-->
</div>

@stop
