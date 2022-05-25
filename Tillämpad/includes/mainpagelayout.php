
<div class="contain">
		<div id="graf"><!-- Plotly ritas här --></div>
		
		<div id="statmenu" class="container">
			<div>
				<h3>På denna sida kan du hitta information om olika sorters väderförhållanden, allt genom några knapptryck nedan:</h3>
				<h4>All data är hämtat från SMHI:s öppna API</h4>
			</div>
			<div class=order>
			<form method="post" >
			<label>Välj väderförhållande att analysera:</label>
			<select name="weather" class="orderform">
			<option value="" selected disabled hidden>Välj här</option>
			<option value="t">Temperatur</option>
			<option value="ws">Vindhastighet</option>
			<option value="tstm">Åskmöjlighet</option>
			<option value="msl">Lufttryck</option>
			<option value="r">Luftfuktighet</option>
			<option value="pmean">Nederbörd</option>
			</select>
			<button id="graphbutton" name="addpost" type="submit">Välj</button>
			</form>
				<?php
					if(isset($_POST['addpost'])){
					if(!empty($_POST['weather'])) {
					$selected = $_POST['weather'];

					session_start();
					$_SESSION['chosenstat'] = $selected;

				} else {
					echo 'Välj ett värde!!!!';
				}
				}
				?>
			</div>
		</div>

		<script>loadDoc();  /*Laddar grafen på uppstart */ </script>
</div>

