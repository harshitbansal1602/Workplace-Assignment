$(document).ready(function(){
	//activating modal
	$('.modal-trigger').leanModal();
	
	//modal open
	var t_id;
	$('.modal-trigger').click(function(){
		if($(this).attr('id')=='trigger_ct'){
			//new task
			t_id = 0;
			console.log(t_id);
		}else{
			//edit task
			t_id = $(this).parents('li').eq(0).attr('id');
			t_id = parseInt(t_id);	//to convert string to number
			console.log(typeof t_id);
			//filling form input
			var sum = $(this).parents('li').eq(0).find('div.s5').eq(0).text();
			console.log(sum);
			var des = $(this).parents('li').eq(0).find('div.s12').eq(0).text();
			console.log(des);
			$('#task_sum').val(sum);
			$('#task_des').val(des);

			//appending students already selected
			$.ajax({
				type: "POST",
				url: "fetch_task.php",
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
		//appending form with free sub-heads
	});
	//saving task
	$('#task_save').click(function() {
		if(t_id>0){
			alter_task(t_id,'update');
		}else{
			alter_task(t_id,'create');
		}
	});

	//delete task
	$('.trigger_dt').click(function(){
		t_id = $(this).parents('li').eq(0).attr('id');
		alter_task(t_id,'delete');
	});

	fetch_tasks();
});

function fetch_tasks(){
	$.ajax({
		type: "POST",
		url: "fetch_task.php",
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

function alter_task(t_id,action){

	if( action == 'update' || action == 'create' ){
		var task_sum = $('#task_sum').val();
		var task_des = $('#task_des').val();
		var subhead = new Array();


		$('input[type="checkbox"]:checked').each(function(){
		if( $(this).val() == 0 );			//for excluding vlaue=0 option
		else{
			$val = parseInt($(this).val());
			subhead.push( $val );
		}
		});
	}else;

	$.ajax({
		type: "POST",
		url: "alter_task.php",
		data: {userid : userid, task_id: t_id, action: action, task_sum: task_sum, task_des: task_des, subhead: subhead},
		error(){
			console.log('Ajax call(add_task) connection failed');
			alert('Ajax call(add_task) connection failed');
		},
		success(data){
			console.log(data);
		},
		complete(){
			console.log(action);
		}
	});

}