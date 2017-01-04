<html>
 	<head>
		<title>Declareren Welpen/Stam Scouting dedemsvaart </title>
		<link rel="stylesheet" type="text/css" href="base.css">
	</head>
	<body>
		 <div class="container">
			 <div class="header">
				 <h1>Declaraties Welpen/Stam Scouting Dedemsvaart</h1>
			</div>
			<div class="navigation">
				<div class="menuitem" onclick="location.href='index.php'">
					Home
				</div>
				<div class="menuitem" onclick="location.href='index.php?loc=file'">
					Declareren
				</div>
				<div class="menuitem" onclick="location.href='index.php?loc=overview'">
					Overzicht
				</div>
			</div>
			<div class="section">
				<?php 
					if (!empty($_GET)){
						include $_GET['loc'] . ".php";
					} else {
						?>
						<h3>Declareren bij de Welpen/Stam.</h3>
						<p>Als je een bonnetje hebt kun je deze hier declareren. Maak daarvoor en foto
						van het bonnetje, selecteer de correcte speltak en vul de rest van het formulier in.
						Als het bonnetje geupload is kun je alles verzenden.</p>
						<p>De penningmeester zal er dan zo snel mogelijk naar kijken. Het inleveren van
						 een bonnetje levert geen garantie dat het ook daadwerkelijk uitgekeerd wordt.</p>
						 <p> - Wouter</p>
						<?php 
					}
					
				?>
			</div>
			<div class="footer">
				<p id="left_footer">Door Wouter van Harten</p>
				<div class="right_footer">
					<p>Contact<a href="mailto:woutervh@live.nl"> Mij </a> voor vragen / opmerkingen</p>
				</div>
			</div>
		</div>
	</body>
</html>
