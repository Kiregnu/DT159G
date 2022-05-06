
function startaUpp() {
    document.getElementById( "LoadButton" ).addEventListener( "click", loadPlot );
    console.log("Efter addevent");
}


// Datat struturerat för plotly https://plot.ly/javascript/bar-charts/
var data = [
    {
        x: ['giraffes', 'orangutans', 'monkeys'],
        y: [20, 50, 23],
        type: 'bar'
    }
];


function loadPlot() {
    console.log("CLICK");
    Plotly.newPlot('graf', data );
};


// Här startar allt med att lägga till händelselyssnare för händelsen "DOMContentLoaded".
document.addEventListener("DOMContentLoaded", startaUpp	);
