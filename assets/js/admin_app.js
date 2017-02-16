var app = angular.module('adminApp', []);

app.controller("adminController", function($scope, $http) {
  
	var url = site_url + "chat/test";
	$http.get(url).success( function(response) {
	  $scope.msgs = response; 
	});

	$scope.post_data = function($url, $data) {
		// request data
		var req = {
		  method: 'POST',
		  url: site_url + $url,
 			data: $.param($data),
 			headers: {'Content-Type': 'application/x-www-form-urlencoded'}		
		};

		// submit post request to the server
		$http(req).then(function(response){
			// success callback
			console.log("post success");
			// console.log(response);

			//update the messages 
			$http.get(url).success( function(response) {
			  $scope.msgs = response; 
			});
		}, function(response){
			// failure callback
			console.log("post failed :(");
		});
	}

	$scope.delete_msg = function($msg_id) {
		// confirm b4 delete
		if($msg_id == null || $msg_id <= 0) {
			console.log("ERROR: invalid $msg_id");
			return;
		}
		if(!confirm("Confirm delete? (you cannot revert this action!)"))
			return;

		$scope.post_data('admin/delete_msg', {msg_id: $msg_id});

		// // request data
		// var req = {
		//   method: 'POST',
		//   url: site_url + 'admin/delete_msg',
 	// 		data: $.param({msg_id: $msg_id}),
 	// 		headers: {'Content-Type': 'application/x-www-form-urlencoded'}		
		// };

		// // submit post request to the server
		// $http(req).then(function(response){
		// 	// success callback
		// 	console.log("post success");
		// 	// console.log(response);
		// 	//update the messages 
		// 	$http.get(url).success( function(response) {
		// 	  $scope.msgs = response; 
		// 	});
		// }, function(response){
		// 	// failure callback
		// 	console.log("post failed :(");
		// });
	}

	$scope.modify_msg = function($msg_id, $msg_content) {
		// confirm b4 delete
		if($msg_id == null || $msg_content == null || $msg_id <= 0) {
			console.log("ERROR: invalid $msg_id or $msg_content");
			return;
		}
		if(!confirm("Confirm changes?"))
			return;

		$scope.post_data('admin/modify_msg', {msg_id: $msg_id, msg_content: $msg_content});
	}	

	$scope.reload_msg = function() {
			//update the messages 
			var url = site_url + "chat/test";
			$http.get(url).success( function(response) {
			  $scope.msgs = response; 
			});
	}

});

