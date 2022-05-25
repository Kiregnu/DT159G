var testurl = "https://opendata-download-metfcst.smhi.se/api/category/pmp3g/version/2/geotype/point/lon/17.2664/lat/62.4066/data.json";

//skriver data i konsol (bara för att visualisera)
async function getapi(url) {
  const response = await fetch(url);
    
  // Sparar data i JSON-format
  var data = await response.json();
  console.log(data);
  console.log(data["timeSeries"][10]["parameters"][1]["values"][0]);
}
getapi(testurl);

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
  
  console.log(data);
  const sentstats = data.shift();
  var plottitle = "Title";
  
  if (sentstats["chosenstat"] == "t") {
    plottitle = "Temperatur";
  }
  else if (sentstats["chosenstat"] == "ws") {
    plottitle = "Vindhastighet";
  }
  else if (sentstats["chosenstat"] == "tstm") {
    plottitle = "Sannolikhet för åska";
  }
  else if (sentstats["chosenstat"] == "msl") {
    plottitle = "Lufttryck";
  }
  else if (sentstats["chosenstat"] == "r") {
    plottitle = "Luftfuktighet";
  }
  else if (sentstats["chosenstat"] == "pmean") {
    plottitle = "Nederbörd";
  }
  console.log(data);
  console.log(sentstats);

  var layout = {
    title: plottitle,
    yaxis: {
      title: {
        text: sentstats["yaxisunit"],
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

