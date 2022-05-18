var url = "https://opendata-download-metfcst.smhi.se/api/category/pmp3g/version/2/geotype/point/lon/17.2664/lat/62.4066/data.json";

//skriver data i konsol (bara för att visualisera)
async function getapi(url) {
  const response = await fetch(url);
    
  // Sparar data i JSON-format
  var data = await response.json();
  console.log(data);
  console.log(data["timeSeries"][10]["parameters"][1]["values"][0]);
}
getapi(url);

//Hämtar datan från data.php, kör plot-funktion
function loadDoc() {
  let url = "includes/data.php";

  fetch( url, {method: 'GET'} )
    .then( resp => resp.json() )
      .then( plottning )
      .catch( data => console.error("FEL: ", data) );
}

var layout = {
  title: "Temperatur"
}

function plottning( data ) {
  Plotly.newPlot('graf', data, layout );
}

