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
 <div class="container">
	 <h1>Declareren bonnetjes Welpen <br>scouting Dedemsvaart</h1>
	 <div class="form">
		<form action="action.php" method="post" enctype="multipart/form-data">
			 <p> Speltak: <select name="speltak" required>
				 <option value="jongens">Welpen Jongens </option>
				 <option value="meisjes">Welpen Meisjes </option> </select></p>
			 <p>Naam: <input type="text" name="name" required/></p>
			 <p>IBAN: <input type="text" name="iban" required/></p>
			 <p>Rek. Houder <input type="text" name="rekhouder" required/></p>
			 <p>Bedrag in &#8364: <input class="money" type="number" step="0.01" name="amount" required/></p>
			 <p>Bonnetje: <input type="file" name="fileToUpload" id="fileToUpload"  required/></p>
			 <p>Omschrijving: <textarea rows="3" cols="20" name='comment' placeholder="omschrijving" required>test</textarea>
			 <p><input type="submit" value="Bonnetje indienen" name="submit" /></p>
		</form>
	</div>
</div>
 </body>
</html>
