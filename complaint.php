<!DOCTYPE html>
<html>
<head>
<title>Help Desk</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="reset.css" rel="stylesheet" type="text/css">
<link href="style2.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="header">

<h1>Help Desk</h1>
     </div>
              
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>

	function commentSubmit(){
		if(form1.name.value == '' && form1.comments.value == '' && form1.description.value == ''){ //exit if one of the field is blank
			alert('Enter your message !');
			return;
		}
		var name = form1.name.value;
		var description = form1.description.value;
		var comments = form1.comments.value;
		var xmlhttp = new XMLHttpRequest(); //http request instance
		
		xmlhttp.onreadystatechange = function(){ //display the content of insert.php once successfully loaded
			if(xmlhttp.readyState==4&&xmlhttp.status==200){
				document.getElementById('comment_logs').innerHTML = xmlhttp.responseText; //the chatlogs from the db will be displayed inside the div section
			}
		}
		xmlhttp.open('GET', 'insert.php?name='+name+'&comments='+comments+'&description='+description, true); //open and send http request
		xmlhttp.send();
	}	
		$(document).ready(function(e) {
			$.ajaxSetup({cache:false});
			setInterval(function() {$('#comment_logs').load('logs.php');}, 2000);
		});	
</script>
</head>
<body>
<div id="container">
	<div class="page_content">
    	Please use this form to send us a complaint and we will respond
    </div>
    <div class="comment_input">
        <form name="form1">
            <input type="text" name="name" placeholder="Name..."/></br></br>
        	<input size="48" maxlength="250" type="text" name="description" placeholder="Brief description of the problem..."/></br></br>
            <textarea rows="6" cols="50" maxlength="250" type="text" name="comments"  placeholder="Leave Comments Here..." onkeyup="countChar(this)"></textarea></br></br>
            <a href="#" onClick="commentSubmit()" class="button">Post</a></br>
        </form>
    </div>
    <a href="techhome.php?logout"><span class="glyphicon glyphic
    on-log-out"></span>&nbsp;go back to your page</a>
    <div id="comment_logs">
    	Loading comments...
    <div>
</div>
</body>
</html>
