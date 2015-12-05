
<script>
	function _(el){
		return document.getElementById(el);
	}
	
	function uploadFile(){
		_("submit").disabled = true;
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
		_("submit").disabled = false;
	}
	function errorHandler(event){
		_("error").text = event;
	}
	function abortHandler(event){
	}
</script>
<h3>Declaratieformulier</h3>
<p>Vul dit formulier in om je bonnetje in te leveren.</p>

<div class="declarate_form">
	<div class="form">	
		<form action="file_upload_parser" method="post" enctype="multipart/form-data" id="file"> 
			<p>Bonnetje: <input type="file" name="fileToUpload" id="fileToUpload" onchange="uploadFile()" required/></p>
			<progress id="progressBar" value="0" max="100"></progress>
		</form> 	
	</div>
	<br>
	<div class="form">
		<form action="index.php?loc=action" method="post" enctype="multipart/form-data" id="data">
			 <p> Speltak: <select name="speltak" required>
				 <option value="jongens">Welpen Jongens </option>
				 <option value="meisjes">Welpen Meisjes </option> </select></p>
			 <p>Naam: <input type="text" name="name" required/></p>
			 <p>IBAN: <input type="text" name="iban" required/></p>
			 <p>Rek. Houder: <input type="text" name="rekhouder" required/></p>
			 <p>Bedrag in &#8364: <input class="money" type="number" step="0.01" name="amount" required/></p>
			<p>Omschrijving: <textarea rows="3" cols="20" name='comment' placeholder="omschrijving" required></textarea>
			<p><input type="submit" value="Bonnetje indienen" name="submit" id="submit" disabled=true /></p>
		</form>
	</div>
</div>
