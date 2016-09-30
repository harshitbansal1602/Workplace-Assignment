$(document).ready(function(){
	fetch_tasks();

	var t_id;
	//accept invite
	$('.trigger').click(function(){
		t_id = $(this).parents('li').eq(0).attr('id');
		t_id = t_id.slice(5);
		t_id = parseInt(t_id);
		console.log(t_id);
		if( $(this).hasClass('at') ){
			accept_invite(t_id);
		}else{
			mark_finished(t_id);
		}
	});

});

function fetch_tasks(){
	$.ajax({
		type: "POST",
		url: "fetch_task.php",
		data: {userid : userid},
		success(data){
			$('#task li:eq(0)').after(data);
		},
		error(){
			console.log('Ajax call(import_tasks) connection failed');
			alert('Ajax call(import_tasks) connection failed');
		},
		complete(){
			console.log('Ajax call(import_tasks) completed');
		}

	});
}

function accept_invite(t_id){
	$.ajax({
		type: "POST",
		url: "accept_task.php",
		data: {userid : userid},
		success(data){
			console.log('Connected');
			if(data == 'Failed'){
				alert('Ajax call(import_tasks) failed');
			}else{
				$('#task li:eq(0)').after(data);
			}
		},
		error(){
			console.log('Ajax call(import_tasks) connection failed');
			alert('Ajax call(import_tasks) connection failed');
		},
		complete(){
			console.log('Ajax call(import_tasks) completed');
		}

	});
}

