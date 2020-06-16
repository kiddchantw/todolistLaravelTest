<?php
echo "<h1> todolist v3</h1>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta name = "csrf-token" content="{{csrf_token()}}">
	<title>LaravelTest</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<div class="container-fluid">
	<div class="container-fluid" style="background-color:#84C1FF;" >

		<h2>login status : <?php 
		$value = Session::get('resultUserName', 'noUser');
		echo $value;
		?>
	</h2>


	<form class="form" action="{{url('/todolistLogin')}}" method = "post">
		{{csrf_field()}}
		<label for="text"> Account :  </label>
		<input type="text" class="form-control" name = "input_name" >
		<label for="pwd"> Password :  </label>
		<input type="password" class="form-control" name = "input_password"> 

		<button type="submit" class="btn btn-warning" name="action" value="login2"> Login </button>
		<button type="submit" class="btn btn-info" name="action" value="loginout2"> Logout </button>
	</form>
	<br>    
</div>

<div class="container-fluid" style="background-color:#FFF8D7;" id="tableDiv">
	<h2>About task </h2>
	<form class="form-inline" action="{{url('/todolistAddTask')}} "method = "post">
		{{csrf_field()}}
		<input type="text"  name = "input_task">
		<input type="submit" name="task_add" value=" add "/>
	</form>
	<table class="table">
		<thead>
			<tr>
				<th width="10%">#</th>
				<th width="40%">代辦事項</th>
				<th width="20%">建立時間</th>
				<th width="10%">進度</th>
				<th width="10%"></th>
			</tr>
		</thead>
		<tbody>

			<?php 
			use App\Tasks;
			use App\Http\Controllers\TasksController;

			$showUserId = Session::get('resultUserId', 0);
			if ($showUserId == 0 ){
				echo "尚未登入";
			}else{
				$taskShow = TasksController::readTask($showUserId);

				foreach ($taskShow as $taskObj) {
					$taskId = $taskObj->id;

					echo "<tr>";
					echo "<td> $taskId </td>";
					echo "<td> $taskObj->content </td>";
					echo "<td> $taskObj->creat_at </td>";
					echo"<td>";

					/*update & delete btn*/
					$taskStatus = $taskObj->done;
					//1:done / 0:unfinish 
					if($taskStatus == 1){
						echo "<form >
						<div class=\"form-group\">
						<button class=\"btn btn-secondary btn-update\" value=$taskId>reset</button>
						</div>
						</form>";
					}else{
						echo "<form >
						<div class=\"form-group\">
						<button class=\"btn btn-success btn-update\" value=$taskId>done</button>
						</div>
						</form>";
					}
					

					echo"</td>";
					echo "<td>";
					echo "<form >
						<div class=\"form-group\">
						<button class=\"btn btn-danger btn-delete\" value=$taskId>delete</button>
						</div>
						</form>";
					echo "</td>";
					echo "</tr>";
				}
			}
			?>
		</tbody>
	</table>
</div>
</div>
</div>


<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(".btn-update").click(function(e){
		e.preventDefault();
		$.ajax({
			type:'POST',
			url:"{{ route('updateTask.post') }}",  
			data:{
				taskId:this.value, 
				userId:<?php echo $showUserId;?> 
			},
			error:function(jsonResponse){
				// console.log(jsonResponse.status);
				// console.log(jsonResponse.responseText);
				alert("失敗");
			},
			success:function(data){
				console.log("update success");
				alert(data.success);
				location.reload(true);
			}
		});
	});

	$(".btn-delete").click(function(e){
		e.preventDefault();
		$.ajax({
			type:'POST',
			url:"{{ route('delete.post') }}",  
			data:{
				taskId:this.value, 
				userId:<?php echo $showUserId;?> 
			},
			error:function(jsonResponse){
				console.log(jsonResponse.status);
				console.log(jsonResponse.responseText);
				alert("失敗");
			},
			success:function(data){
				console.log("delete success");
				alert(data.success);
				location.reload(true);
			}		
		});
	});

</script>

</html>




