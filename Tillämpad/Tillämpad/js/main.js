//Kartans startposition.
var x1=0;
var y1=0;
var myLatlng = { lat: x1, lng: y1 };

//Slumpad koordinat för hämtning av data.
var longitude = Math.floor(Math.random()*360-180);
var latitude = Math.floor(Math.random()*180-90);
info_url = `https://api.openweathermap.org/data/2.5/onecall?lat=${latitude}&lon=${longitude}&exclude=alerts&lang=sv&units=metric&appid=1481131a1153daf7246a4d8e13c814dc`;

var clickedLon = x1;
var clickedLat = y1;

var points = 0;
var maxPoints = 5000;
var guesses = 0;

function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 4,
      center: myLatlng,
      streetViewControl: false
    });
    
    // Create the initial InfoWindow.
    let infoWindow = new google.maps.InfoWindow({
      content: "Click the map to get Lat/Lng!",
      position: myLatlng,
    });
    
    // Configure the click listener.
    map.addListener("click", (mapsMouseEvent) => {
      // Close the current InfoWindow.
      infoWindow.close();
      // Create a new InfoWindow.
      infoWindow = new google.maps.InfoWindow({
        position: mapsMouseEvent.latLng,
      });
      infoWindow.setContent(
        JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
      );
      infoWindow.open(map);
      
      var coords = mapsMouseEvent.latLng.toJSON();
      clickedLat = coords["lat"];
      clickedLon = coords["lng"];

  });
}

//Funktion som körs när en gissning görs.
function makeGuess() {
  
  //Formel för sträcka mellan 2 punkter multiplicerat med faktor för grader till km.
  var distance = ((111139/1000)*((clickedLat-latitude)**2+(clickedLon-longitude)**2)**0.5).toFixed(3);

  //Skriver in ett meddelande hur långt gissningen var från platsen.
  document.getElementById("guessinfo").innerHTML = "Din gissning var "+distance+" km från rätt plats!";

  //Ökar gissningar med 1
  guesses+=1;

  //Om gissningen är närmare än 2000km ge poäng.
  if (distance<maxPoints) {
    points += maxPoints-Math.ceil(distance);
  }
  
  document.getElementById("guesspoints").innerHTML = "Du har "+Math.floor(points)+" poäng på "+guesses+" gissningar!";

  longitude = Math.floor(Math.random()*360-180);
  latitude = Math.floor(Math.random()*180-90);
  info_url = `https://api.openweathermap.org/data/2.5/onecall?lat=${latitude}&lon=${longitude}&exclude=alerts&lang=sv&units=metric&appid=1481131a1153daf7246a4d8e13c814dc`;

  getapi(info_url);

}

// Funktion som hämtar väderdata från api.
async function getapi(url) {
    
  // Hämtar api
  const response = await fetch(url);
  
  // Sparar data i JSON-format
  var data = await response.json();
  console.log(data);
  
  //Skapar variabler
  var humidity = "Luftfuktighet: " + data["current"]["humidity"] + "%";
  var pressure = "Lufttryck: " + data["current"]["pressure"] + "hPa";
  var temp = "Temperatur: " + data["current"]["temp"] + "	\xB0C";
  var windspeed = "Vindhastighet: " + data["current"]["wind_speed"] + "m/s";
  var winddirec = "Vindriktning: " + data["current"]["wind_deg"] + "\xB0";
  var weather = "Vädret är " + data["current"]["weather"][0]["description"]
  
  //Skriver in datan på hemsidan
  var datatext = [humidity,pressure,temp,windspeed,winddirec,weather];
  for (var i=0; i<datatext.length; i++) {
    document.getElementById(`textinfo${i}`).innerHTML = datatext[i];
  }
}


