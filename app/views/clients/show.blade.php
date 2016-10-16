@extends('layouts.user')

@section('main')
<div class="my-profile">
	<section class="content">
        <div class="main">
            <div class="content-top">
                <div class="title-page left">
                    <h2>Client Profile</h2>
                    <div class="breadcrumb">
                        <a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
                        <a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
                        <span>></span>
                        <a href="{{{ URL::to('/clients') }}}">Clients</a>
                        <span>></span>
						<?php $secondname= !empty($client->second_firstname) || !empty($client->second_lastname)? ', '.$client->second_firstname.' '.$client->second_lastname : "" ;?>
                        <span>{{{ ucwords($client->firstname." ".$client->lastname.$secondname) }}}</span>
                    </div>
                </div><!--title-page-->
            </div><!--top-content-->
            
            <div class="content-body">
                
                <article class="shadow account">
                     <div class="row">
                       {{ link_to_route('clients.edit', 'Edit Client', array($client->id), array('class' => 'btn orange right')) }}
				  			  {{ Form::open(array('method' => 'DELETE','onsubmit'=>'return confirmDelete()', 'route' => array('clients.destroy', $client->id))) }}
								{{ Form::submit('Delete', array('class' => 'btn red right')) }}
							{{ Form::close() }}
                     </div><!--row-->
                     <script>
							function myFunction() {
								var answer = confirm("Delete selected messages ?")
		   					if (answer){
									document.messages.submit();
								}
    	    					return false;
							}
						   </script>
                    <form>
                        
                        <div class="row">
                            <div class="left">
                                <label>First Name</label>
                                <span>{{{ ucfirst($client->firstname) }}}</span>
                            </div>
                            <div class="right">
                                <label>Last Name</label>
                                <span>{{{ ucfirst($client->lastname) }}}</span>
                            </div>
                        </div><!--row-->
						@if($client->second_firstname !="" || $client->second !="")
                         <div class="row">
                            <div class="left">
                                <label>First Name(Second) </label>
                                <span>{{{ ucfirst($client->second_firstname) }}}</span>
                            </div>
                            <div class="right">
                                <label>Last Name(Second) </label>
                                <span>{{{ ucfirst($client->second_lastname) }}}</span>
                            </div>
                        </div><!--row-->
						@endif
                        <div class="row">
                            <div class="left">
                                <label>Email Address</label>
                                <span>{{{ $client->email }}}</span>
                            </div>
                            <!--div class="right">
                                <label>Gender</label>
                                <span>{{{-- $client->gender --}}}</span>
                            </div-->
                        </div><!--row-->
                        
                        <div class="row">
                            <div class="left">
                                <label>Phone Number</label>
                                <span>{{{ $client->phone }}}</span>
                            </div>
                            <div class="right">
                                <label>Fax Number</label>
                                <span>{{{ $client->fax }}}</span>
                            </div>
                        </div><!--row-->
                        
                        <div class="row">
                            <div class="left">
                                <label>Address 1</label>
                                <span>{{{ $client->street1 }}}</span>
                            </div>
                            <div class="right">
                                <label>Address 2</label>
                                <span>{{{ $client->street2 }}}</span>
                            </div>
                        </div><!--row-->
                        
                        <div class="row">
                            <div class="left">
                                <label>City</label>
                                <span>{{{ $client->city }}}</span>
                            </div>
                            <div class="right">
                            	<div class="left">
											<label>State</label>
                                 <span>{{{ $state->statename }}}</span>                                  
                            	</div>
                            	<div class="right">
                            		<label>Zip Code</label>
                                <span>{{{ $client->zip }}}</span>
                            	</div>
                            </div>
                        </div><!--row-->
                        <div class="row">
                        	<div>
                                <label>Notes</label>
                                <span>{{{ $client->client_note }}}</span>
                            </div>
                        </div>
                    </form>                          
                </article>
            </div>
        </div><!--main-->
    </section><!--content-->
</div> 
@stop
