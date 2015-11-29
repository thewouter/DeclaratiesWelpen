<html>
 <head>
  <title>Declareren Welpen Scouting dedemsvaart </title>
  <style type="text/css">
    .form {
        width: 100%;
        clear: both;
    }
    .form input {
        width: 60%;
        clear: both;
        float: right;
    }
    .form textarea {
        width: 60%;
        clear: both;
        float: right;
    }
    .form select {
        width: 60%;
        clear: both;
        float: right;
    }
    .form progress {
        width: 60%;
        clear: both;
        float: right;
    }
    .form button {
        width: 60%;
        clear: both;
        float: right;
    }
    .container {
    	width: 700px;
    	margin:0 auto;
    }
    h1 {
    	text-align: center;
    }
    body{
    	background-color: #00cc65;
    }
    
    </style>
 </head>
 <body>

<script>
function _(el){
	return document.getElementById(el);
}

function uploadFile(){
	_("")
	var file = _("fileToUpload").files[0];
	var formdata = new FormData();
	formdata.append("fileToUpload", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "file_upload_parser.php");
	ajax.send(formdata);
}
function progressHandler(event){
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
}
function completeHandler(event){
	_("submit").style.visibility = "visible";
}
function errorHandler(event){
	_("error").text = event;
}
function abortHandler(event){
}
</script>
<h2 id="error"></h2>
 <div class="container">
	 <h1>Declareren bonnetjes Welpen <br>scouting Dedemsvaart</h1>
	<div class="form">	
		<form action="file_upload_parser" method="post" enctype="multipart/form-data" id="file"> 
			<p>bonnetje: <input type="file" name="fileToUpload" id="fileToUpload" onchange="uploadFile()" required/></p>
			<progress id="progressBar" value="0" max="100"></progress>
		</form> 	
	</div>
	<br>
	 <div class="form">
		<form action="action.php" method="post" enctype="multipart/form-data" id="data">
			 <p> Speltak: <select name="speltak" required>
				 <option value="jongens">Welpen Jongens </option>
				 <option value="meisjes">Welpen Meisjes </option> </select></p>
			 <p>Naam: <input type="text" name="name" required/></p>
			 <p>IBAN: <input type="text" name="iban" required/></p>
			 <p>Rek. Houder: <input type="text" name="rekhouder" required/></p>
			 <p>Bedrag in &#8364: <input class="money" type="number" step="0.01" name="amount" required/></p>
			<p>Omschrijving: <textarea rows="3" cols="20" name='comment' placeholder="omschrijving" required>test</textarea>
			<p><input type="submit" value="Bonnetje indienen" name="submit" id="submit" style="visibility: hidden"/></p>
		</form>
	</div>
</div>
 </body>
</html>
