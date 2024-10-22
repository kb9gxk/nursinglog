<div id="IPBased">
    Your IP: [::ip::]<br>
    City: [::city::]<br>
    State: [::state2::]<br>
    Zip: [::zip::]<br>
    County: [::country_name::] <br><br>
    This product includes GeoLite2 data created by MaxMind, available from
    <a href="https://www.maxmind.com">https://www.maxmind.com</a>.
</div>

<button onclick="getLocation()">Find Me</button>

<p id="demo"></p>

<script>
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude +
    "<br>Longitude: " + position.coords.longitude;
}
</script>