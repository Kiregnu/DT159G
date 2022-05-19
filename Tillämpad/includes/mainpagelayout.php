
<div class="contain">
		<div id="graf"><!-- Plotly ritas här --></div>
		
		<div style="height:50px">
			<a id="button" class="center" onclick="loadDoc()">Ladda om</a>
		</div>
		
		<div id="statmenu">
		<form method="post" >
		<label for="cars">Choose a car:</label>
		<select name="cars" id="cars">
  		<option value="t">Temp</option>
  		<option value="ws">Vindhastighet</option>
  		<option value="tstm">Åskmöjlighet</option>
  		<option value="audi">Audi</option>
		</select>

  		<input type="submit" name="addpost">
		</form>
		<?php
			if(isset($_POST['addpost'])){
			if(!empty($_POST['cars'])) {
			$selected = $_POST['cars'];
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

