<div class="mcontent">
	<h2><?php echo $programName?> (<?php echo $programLevel?>)</h2>
	<h3>Omschrijving</h3>
	<p>
		￼<?php echo nl2br($programDescription);?>
	</p>
	<h3>Toelatingseisen &amp; Financiering</h3>
	<ul>
		<li>
	<?php
		if( $numerusFixus == true )
		{
			
			echo "Bij deze studie is een numerus fixus van <u>" . $numerusFixus . "</u> personen.";
			
		}
		else
		{
			
			echo "Bij deze studie is geen numerus fixus.";
			
		}
		
	?>
		</li>
		<li>
	<?php
		
		switch( $financing )
		{
			
			case "government":
				echo "Deze studie is door de overheid erkent en wordt dus ook gefinancierd door de overheid.";
			break;
			
			case "private":
				echo "Deze studie is <u>niet</u> door de overheid erkent en moet dus door u zelf gefinancierd worden.";
			break;
			
			default:
				echo "Er is niets bekend over de financiering van deze studie.";
			break;
			
		}
	?>
		</li>
		<li>
			Deze studie bestaat uit <u><?php echo $programCredits?></u> studiepunten.
		</li>
		<li>
			Deze studie duurt <u><?php echo floor($programDuration/12)?></u> jaar en <?php echo $programDuration - ( floor($programDuration/12) * 12 ) ?> maanden.
		</li>
		<li>
			Programmavorm: <u><?php echo $programForm?></u>.
		</li>
		<li>
			Programmatype: <u><?php echo $programType?></u>.
		</li>
		<li>
			Eerstvolgende instroommogelijkheid: <?php echo $startingYear ?>.
		</li>
		<li>
			Deze studie wordt vooral in het <u><?php echo $instructionLanguageFull?></u> gegeven.
		</li>
		<li>
			Deze studie wordt gegeven aan de volgende faculteit: <u><?php echo $facultyName?></u>.
		</li>
		<li>
		<?php
			if( $neededVakken !== false ){
		?>
			Bij deze studie kun je instromen zolang je VWO-profiel o.a. uit deze vakken bestaat: <u><?php echo implode( $neededVakken, "</u>, <u>" )?></u>.<br />
			<small>(Bij Wiskunde hoeft er indien er meerdere vermeld zijn natuurlijk maar aan 1 van beiden voldaan te zijn.)</small>
		<?php
			}
			else
			{
		?>
			Instromen kan met elk VWO profiel.
		<?php
			}
		?>
		</li>
	</ul>
	
</div>
<div style="clear:both;"><br /><br /><br /><br /></div>
