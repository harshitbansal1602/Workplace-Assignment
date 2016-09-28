$(document).ready(function(){

	$('.modal-trigger').leanModal();

	$('#task_create').click(function() {
		var task_sum = $('#task_sum').val();
		var task_des = $('#task_des').val();
		var subhead = [];

		$('input[type="checkbox"]:selected').each(function(){
			if( $this.val() !== 0 ){
				//for excluding vlaue=0 option
			}else{
				subhead.push( $this.val() );
			}
		});

		$.ajax({
			type: "POST",
			url: "add_task.php",
			data: {userid : userid, task_sum: task_sum, task_des: task_des, subhead: subhead},
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
				}
			},
			complete(){
				console.log('Ajax call(add_task) completed');
			}
		});
		$('.modal-close').click();
	});

	import_tasks();
});

function import_tasks(){
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