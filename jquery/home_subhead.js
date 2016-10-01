$(document).ready(function(){
	
	var t_id;

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


