$(function() {
	
	check_notifications();
	
	//Setup datepicker
	$('.dp').fdatepicker();
	
	if( $('#add_task_to_task_category').length ) {
		edit_task_category_tasks();
	}
	if( $('#add_task_category_to_job_type').length ) {
		edit_job_type_task_categories();
	}
	if( $('#add_job_type_to_project').length ) {
		edit_project_job_types();
	}
});

function check_notifications() {
	
	var message;
	if( location.search.toString().indexOf('success_message') != -1 ) {

		message	= decodeURIComponent(location.search.toString().split('success_message=').pop());
		add_notification(message, 'success');
		
	}
	else if( location.search.toString().indexOf('error_message') != -1 ) {
		message	= decodeURIComponent(location.search.toString().split('error_message=').pop());
		add_notification(message, 'error');
	}
	if( location.search.toString().indexOf('updated_client') != -1 ) {
		add_notification("Client has been updated successfully.", 'success');
	}
	else if( location.search.toString().indexOf('created_client') != -1 ) {
		add_notification("Client has been created successfully.", 'success');
	}
	else if( location.search.toString().indexOf('deleted_client') != -1 ) {
		add_notification("Client has been deleted successfully.", 'success');
	}
	
}

function add_notification( message, type ) {
	var message = message.replace(/[+]/g, " "); 
	if( !$('#notifications').length ) {
		$('#breadcrumb_row').after('<div class="row"><div class="small-12 columns" id="notifications"></div></div>');
		$('article.shadow').prepend('<div class="row" id="notifications"></div>');
	}
   if( type == 'success' ) {
		//$('#notifications').prepend('<div data-alert="" class="alert-box success radius">'+message+'<a href="#" class="close">×</a></div>');
		
		$('#notifications').prepend('<div data-alert="" class="alert-box success">'+message+'<a href="#" class="close" style="color: #707077;">x</a></div>');
	}
	else {
		//$('#notifications').prepend('<div data-alert="" class="alert-box alert radius">'+message+'<a href="#" class="close">×</a></div>');
		$('#notifications').prepend('<div data-alert="" class="alert-box error">'+message+'<a href="#" class="close" style="color: #707077;">x</a></div>');
	}
	
	$(document).foundation('alert');
	
}

function edit_task_category_tasks() {
	
	$('#add_task_to_task_category').click(function() {
		
		var element	= $('#task_to_add option:selected');
		var markup	= '<tr><td>'+element.text()+'<input type="hidden" name="jobtypeid[]" value='+element.data('task-id')+'></td><td>'+element.data('task-unit')+'</td><td>$'+element.data('cost-per-unit')+'<input type="hidden" name="categoriesid" value='+element.data('task-categoriesid')+'></td><td><a href="/projects/edit-task.html">Edit</a> | <a onclick="$(this).parents(\'tr\').remove();" href="#">Delete</a></td></tr>';
		$('#task_category_tasks').append(markup);
		
	});
	
}

function edit_job_type_task_categories() {
	
	
	$('#add_task_category_to_job_type').click(function() {
		
		var element	= $('#task_category_to_job_type option:selected');
		var markup	= '<tr><td>'+element.text()+'<input type="hidden" name="jobtypeid" value='+element.data('jobtypeid')+'></td><td>'+element.data('tasks')+'<input type="hidden" name="categoriesid[]" value='+element.data('task-categoriesid')+'></td><td><a href="#">Set Default Tasks</a> | <a href="/projects/edit-task-category.html">Edit</a> | <a onclick="return (confirm(\'Are you sure you want to remove this from the system?\'));" href="/projects/view-task-categories.html?success_message=Task category removed successfully!">Delete</a></td></tr>';
		$('#task_category_tasks').append(markup);
		
	});
	
}

function edit_project_job_types() {
	
	$('#add_job_type_to_project').click(function() {
		
		var element	= $('#job_types_for_project option:selected');
		
		//var markup	= '<tr><td>'+element.text()+'<input type="hidden" name="jobtypeid[]" value='+element.data('task-id')+'></td><td>'+element.data('task-categories')+'<input type="hidden" name="categoriesid[]" value='+element.data('task-categoriesid')+'></td><td>'+element.data('tasks')+'</td><td><a href="#">Set Default Task Categories</a> | <a onclick="$(this).parents(\'tr\').remove();" href="#">Delete</a></td></tr>';
		
		//var markup	= '<tr><td>'+element.text()+'<input type="hidden" name="jobtypeid[]" value='+element.data('task-id')+'></td><td>'+element.data('task-categories')+'<input type="hidden" name="categoriesid[]" value='+element.data('task-categoriesid')+'></td><td> <a onclick="$(this).parents(\'tr\').remove();" href="#">Delete</a></td></tr>';
		
		var markup	= '<li><span class="title">'+element.text()+'<input type="hidden" name="jobtypeid[]" value='+element.data('task-id')+'></span><span class="name">'+element.data('task-categories')+'<input type="hidden" name="categoriesid[]" value='+element.data('task-categoriesid')+'></span><span class="link"><a style="text-decoration: underline;" onclick="$(this).parents(\'li\').remove();" >Delete</a></span></li>';
		
		$('#project_job_types').append(markup);
		
	});
	
}
function confirmDelete() { 
	return confirm("Are you sure?");   
} 
