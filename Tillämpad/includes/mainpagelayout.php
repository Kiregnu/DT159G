
<div class="contain">
		<div id="graf"><!-- Plotly ritas här --></div>
		
		<div id="statmenu" class="container">
		<form method="post" >
		<label>Välj väderförhållande att analysera:</label>
		<select name="weather" class="orderform">
		<option value="" selected disabled hidden>Välj här</option>
		<option value="t">Temperatur</option>
  		<option value="ws">Vindhastighet</option>
  		<option value="tstm">Åskmöjlighet</option>
		<option value="msl">Lufttryck</option>
		</select>
		<button id="graphbutton" name="addpost" type="submit">Välj</button>
		</form>
		<?php
			if(isset($_POST['addpost'])){
			if(!empty($_POST['weather'])) {
			$selected = $_POST['weather'];
			// $chosenstat = ;

			 session_start();
   			$_SESSION['chosenstat'] = $selected;

		} else {
			echo 'Välj ett värde!!!!';
		}
		}
		?>
		</div>

		<script> /*Laddar grafen på uppstart */ loadDoc(); </script>
</div>

