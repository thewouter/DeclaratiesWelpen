
<h3>Overzicht declaraties van dit jaar</h3>
<div class="dec_table">
	<?php 
	$speltakken = array(0=>"jongens", 1=>"meisjes",2=>"npk",3=>"stam");
	foreach($speltakken as $speltak){
		$excel = getcwd() . "/" . $speltak . "/" . date("Y") . "/data.xlsx";
		if(file_exists($excel)){
			?>
				<table >
					<thead> 
						<tr>
							<th>Declaratie</th>
							<th>Speltak</th>
							<th id='name'>Naam</th>
							<th>akkoord</th>
						</tr>
					</thead>
				<tbody>
			<?php
			require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
			$ea = PHPExcel_IOFactory::load($excel);
			
			for($i = 2;;$i++) {
				$cell = $ea->getActiveSheet()->getCell('A'. sprintf("%d", $i));
				if($cell->getValue() === NULL || $cell->getValue() === ''){
					break;
				}
				$declaration = $cell->getValue();
				$name = $ea->getActiveSheet()->getCell("B" . sprintf("%d", $i));
					echo"<tr>";
						echo"<td>" . $declaration . "</td>";
						echo"<td>" . $speltak . "</td>";
						echo"<td id='name'>" . $name . "</td>";
						echo"<td></td>";
					echo"</tr>";
			}?>
			</tbody>
		</table>
		<br>
		<?php 
		}
			
	}
	?>
</div>