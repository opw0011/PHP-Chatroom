<html>
<head>
<title>Test Page</title>
	<script>

	function show_msg(offset,limit) {

		// 	document.getElementById("txtHint").innerHTML="";

		if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
		} 
	  	else { // code for IE6, IE5
	  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  	}

	  	xmlhttp.onreadystatechange=function() {
		  	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		  		document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		  	}
	  	}

	  	//chat/show_msg/[offset]/[limit]
		xmlhttp.open("POST", "<?php echo site_url('chat/show_msg')?>"+'/'+offset+'/'+limit, true);
		xmlhttp.send();
	}
	</script>



</head>
<body>
	<div id="txtHint"></div>
	<button type="button" onclick="show_msg(0,5)">hi</button>

</body>
</html>