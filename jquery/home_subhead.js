$(document).ready(function(){
	
	var t_id;

	$(document).on('click', '.ft', function(event) {

		event.preventDefault();
		t_id = $(this).parents('li').eq(0).attr('id');
		t_id = t_id.slice(5);
		t_id = parseInt(t_id);
		completed(t_id);
	});

	//my_task view
	$('#my_task').click(function(){
		fetch_tasks();
	});

	//all_task view
	$('#all_task').click(function(){
		fetch_all_tasks();
	});

	$('#my_task').click();

});

function completed(t_id){
	$.ajax({
		type: "POST",
		url: "completed.php",
		data:{t_id:t_id},
		success(data){
			if( data=='FAILED' ){
				alert('Sorry, some error occured. Please reload the page again.');
			}else{
				fetch_tasks();
			}
		},
		error(){
			console.log('Ajax call(import_tasks) connection failed');
			alert('Sorry, some error occured. Please reload the page again.');
		}
	});
}

function fetch_tasks(){
	$.ajax({
		type: "POST",
		url: "fetch_task.php",
		data: {userid : userid},
		success(data){
			if( data=='FAILED' ){
				alert('Sorry, some error occured. Please reload the page again.');
			}else{
				$('#task_list').html(data);
				$('.modal-trigger').leanModal();
			}
		},
		error(){
			console.log('Ajax call(import_tasks) connection failed');
			alert('Sorry, some error occured. Please reload the page again.');
		}
	});
}


function fetch_all_tasks(){
	$.ajax({
		type: "POST",
		url: "fetch_taskAll.php",
		success(data){
			if( data=='FAILED' ){
				alert('Sorry, some error occured. Please reload the page again.');
			}else{
				$('#task_list').html(data);
				$('.modal-trigger').leanModal();
			}
		},
		error(){
			console.log('Ajax call(import_tasks) connection failed');
			alert('Sorry, some error occured. Please reload the page again.');
		}
	});
}


