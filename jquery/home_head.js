$(document).ready(function(){
	//activating modal
	$('.modal-trigger').leanModal();
	
	//modal open
	var t_id;
	$(document).on('click', '.modal-trigger', function(event) {
		event.preventDefault();
		if($(this).attr('id')=='trigger_ct'){
			
			//new task
			t_id = 0;
			$('#task_sum').val('');
			$('#task_des').val('');
			
			//appending form with free sub-heads
			fetch_free_sub();

		}else{
			
			//edit task
			
			t_id = $(this).parents('li').eq(0).attr('id');
			t_id = t_id.slice(5);
			t_id = parseInt(t_id);	
			
			var sum = $(this).parents('li').eq(0).find('div.s5').eq(0).text();
			var des = $(this).parents('li').eq(0).find('div.s12').eq(0).text();
			$('#task_sum').val(sum);
			$('#task_des').val(des);

			//appending form with already selected + free subheads
			fetch_all_sub(t_id);
		}

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
	$(document).on('click', '.trigger_dt', function(event) {
		event.preventDefault();
		t_id = $(this).parents('li').eq(0).attr('id');
		t_id = t_id.slice(5);
		t_id = parseInt(t_id);
		alter_task(t_id,'delete');
	});

	fetch_tasks();
});



function fetch_tasks(){
	$.ajax({
		type: "POST",
		url: "fetch_taskHead.php",
		data: {userid : userid},
		success(data){
			if( data=='FAILED' ){
				alert('Sorry, some error occured. Please reload the page again.');
			}else{
				$('#task_list li:eq(0)').after(data);
				$('.modal-trigger').leanModal();
			}
		},
		error(){
			console.log('Ajax call(import_tasks) connection failed');
			alert('Sorry, some error occured. Please reload the page again.');
		}
	});
}

function alter_task(t_id,action){

	if( action == 'update' || action == 'create' ){
		var task_sum = $('#task_sum').val();
		var task_des = $('#task_des').val();
		var subhead = new Array();

		$('input[type="checkbox"]:checked').each(function(){
			if( $(this).val() == 0 ){
			}else{
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
			alert('Connection error. Please try again.');
		},
		success(data){
			$('#task_save').attr('disabled', 'disabled');
			if( data == 'FAILED' ){
				alert('Some error occured. Please try again.');
			}else{
				$('#task_save').removeAttr('disabled');
				$('.modal-close').click();
			}
		},
		complete(){
			console.log(action);
		}
	});

}


function fetch_free_sub(){
	$.ajax({
		type: "POST",
		url: "fetch_free.php",
		data: {userid : userid},
		success(data){
			if( data == 'FAILED' ){
				$('.modal-close').click();
				alert('Some error occured. Please try again.');
			}else{
				$('#free').html(data);
			}
		},
		error(){
			$('.modal-close').click();
			alert('Connection error. Please try again');
		}
	});
}


function fetch_all_sub(t_id){
	$.ajax({
		type: "POST",
		url: "fetch_all.php",
		data: {userid : userid, t_id:t_id},
		success(data){
			if( data == 'FAILED' ){
				$('.modal-close').click();
				alert('Some error occured. Please try again.');
			}else{
				$('#free').html(data);
			}
		},
		error(){
			$('.modal-close').click();
			alert('Connection error. Please try again');
		}
	});
}