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
			t_id = t_id * 1;	//to convert string to number
			console.log(t_id);
			//filling form input
			var sum = $(this).parents('li').eq(0).find('div.s5').eq(0).text();
			console.log(sum);
			var des = $(this).parents('li').eq(0).find('div.s12').eq(0).text();
			console.log(des);
			$('#task_sum').val(sum);
			$('#task_des').val(des);
			//appending students already selected
		}
		//appending form with free sub-heads
	});
	//saving task
	$('#task_save').click(function() {
		create_task(t_id);
	});

	//delete task
	$('.trigger_dt').click(function(){
		t_id = $(this).parents('li').eq(0).attr('id');
		delete_task(t_id);
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

function create_task(t_id){
	var task_sum = $('#task_sum').val();
	var task_des = $('#task_des').val();
	var subhead = new Array();

	$('input[type="checkbox"]:checked').each(function(){
		if( $(this).val() == 0 );			//for excluding vlaue=0 option
		else
			subhead.push( $(this).val() );
	});

	$.ajax({
		type: "POST",
		url: "add_task.php",
		data: {userid : userid, task_id: t_id, task_sum: task_sum, task_des: task_des, subhead: subhead},
		error(){
			console.log('Ajax call(add_task) connection failed');
			alert('Ajax call(add_task) connection failed');
		},
		success(data){
			if( data === 'Failed'){
				console.log('Ajax call(add_task) failed');
				alert('Ajax call(add_task) failed');
			}else{
				console.log('Ajax call(add_task) successful');
				alert('Ajax call(add_task) successful');
				$('.modal-close').click();
			}
		},
		complete(){
			console.log('Ajax call(add_task) completed');
		}
	});

}