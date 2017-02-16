<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body ng-app="adminApp">
		<h1 class="text-center">Admin Panel - Mange Messages</h1>
		<div class="container text-right">
			<a href="../chat" target="_blank"> Go to Chatroom page</a><br>
			<a href="../login/logout"> Logout </a>
		</div>		
		<!-- <button type="button" class="btn btn-default" ng-click="test()">Test</button> -->		

		<div ng-controller= "adminController" class="container-fluid">	



		<button type="button" class="btn btn-info pull-right" ng-click="reload_msg()">refresh</button>
		<div class="clearfix"></div>
		<div class="well well-sm" >
			<input type="text" ng-model="search_filter" class="form-control" placeholder="Type here to filter out the messages">
		</div>

		

		<div class="table-responsive">
			<table class="table table-hover table-bordered table-condensed" style="table-layout: fixed; word-wrap: break-word;">
				<thead>
			   <tr >
			   		<th class="col-sm-1">Msg ID</th>
			      <th class="col-sm-1">Username</th>
			      <th class="col-sm-8">Message</th>
			      <th class="col-sm-2">Actions</th>
			   </tr>
			  </thead>

			  <tbody>
			   <tr ng-repeat = "msg in msgs | filter:search_filter">
			   		<td>{{ msg.id }}</td>
			   		<td>{{ msg.user_name }}</td>
			      <td>
			      	<span ng-hide="editing">{{ msg.msg }}</span>
			      	<input type="text" id="input" class="form-control input-sm" value="" required="required" ng-model="msg.msg" ng-show="editing">
			      </td>
			      <td>			      	
			      	<button type="button" class="btn btn-xs btn-primary" ng-click="editing = true" ng-hide="editing">edit</button>			      	
			      	<button type="button" class="btn btn-xs btn-success" ng-click="editing = false; modify_msg(msg.id, msg.msg)" ng-show="editing">save</button>
			      	<button type="button" class="btn btn-xs btn-warning" ng-click="editing = false; msg.msg = undo" ng-show="editing" ng-init="undo = msg.msg">cancel</button>
			      	<button type="button" class="btn btn-xs btn-danger" ng-click="delete_msg(msg.id)">delete</button>
			      </td>			
			   </tr>
			  </tbody>
			</table>
		</div>

			
		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<!-- angular js -->
		<script src= "https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>

		<!-- admin_app javascript -->
		<script src="<?php echo site_url('assets/js/admin_app.js');?>"></script>

		<script type="text/javascript">
			var site_url = "<?php echo site_url() ?>";
		</script>

	</body>
</html>