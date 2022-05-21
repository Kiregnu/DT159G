
<div class="contain">
		<div id="graf"><!-- Plotly ritas här --></div>
		
		<div style="height:50px">
			<a id="button" class="center" onclick="loadDoc()">Ladda om</a>
		</div>
		
		<div id="statmenu">
		<form method="post" >
		<label for="weather">Välj väderförhållande att analysera:</label>
		<select name="weather" class="orderform">
  		<option value="t">Temp</option>
  		<option value="ws">Vindhastighet</option>
  		<option value="tstm">Åskmöjlighet</option>
		</select>
		<button class="btn" name="addpost" type="submit">Välj</button>
		</form>
		<?php
			if(isset($_POST['addpost'])){
			if(!empty($_POST['weather'])) {
			$selected = $_POST['weather'];
			// $chosenstat = ;

			 session_start();
   			$_SESSION['chosenstat'] = $selected;

		} else {
			echo 'Please select the value.';
		}
		}
		?>
		</div>

		<script> /*Laddar grafen på uppstart */ loadDoc(); </script>
</div>

