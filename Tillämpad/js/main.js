var testurl = "https://opendata-download-metfcst.smhi.se/api/category/pmp3g/version/2/geotype/point/lon/17.2664/lat/62.4066/data.json";

//skriver data i konsol (bara för att visualisera)
async function getapi(testurl) {
  const response = await fetch(testurl);
    
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


//Funktion som hämtar ut namn på yaxis, bestämmer titel på graf och plottar graf.
function plottning( data ) {
  const yaxisunit = data.shift();
  var plottitle = "Title";

  if (yaxisunit["yaxisunit"] == "Cel") {
    plottitle = "Temperatur";
  }
  else if (yaxisunit["yaxisunit"] == "m/s") {
    plottitle = "Vindhastighet";
  }
  else if (yaxisunit["yaxisunit"] == "percent") {
    plottitle = "Sannolikhet för åska";
  }
  else if (yaxisunit["yaxisunit"] == "hPa") {
    plottitle = "Lufttryck";
  }


  var layout = {
    title: plottitle,
    yaxis: {
      title: {
        text: yaxisunit["yaxisunit"],
        font: {
          family: 'Courier New, monospace',
          size: 18,
          color: '#7f7f7f'
        }
      }
    }
  }

  
  Plotly.newPlot('graf', data, layout );
}

