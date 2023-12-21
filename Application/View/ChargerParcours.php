<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../View/bootstrap-5.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>MAP</title>
</head>
<body>
<div id="map" style="height: 500px;"></div>
<div id="buttons">
    <button id="clearRoute">Effacer l'itineraire</button>
    <button id="removeLastMarker">Supprimer le dernier marqueur</button>
</div>
<div id="formContainer">
    <h2>Informations</h2>
    <form id="locationForm">
        <label for="city">Ville:</label>
        <input type="text" id="city" name="city" required><br>

        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="year">Annee:</label>
        <input type="number" id="year" name="year" required><br>
        <button type="submit" id="btn">Enregistrer le parcours</button>

    </form>
    <form id="load" action="../Controller/ChargerParcoursController.php" method="post">
        <select id="parcoursList" name="parcours">
            <?php
            $parcoursNames = selectNameInParcours();
            foreach ($parcoursNames as $parcours) {
                $selected = '';
                if (isset($_POST['parcours']) && $_POST['parcours'] === $parcours['nom']) {
                    $selected = 'selected';
                }
                echo "<option value='".$parcours['nom']."' ".$selected.">".$parcours['nom']."</option>";
            }
            ?>
        </select>
        <button type="submit" name="loadSelectedParcours"onclick="loadParcours()">Charger le parcours</button>
    </form>

</Div>
<script>
    function addMarker(latlng) {
        var marker = L.marker(latlng).addTo(map);
        markers.push(marker);
        marker.on('click', function () {
            removeMarker(marker);
        });
        updateRoute();
    }

    function removeMarker(marker) {
        map.removeLayer(marker);
        var index = markers.indexOf(marker);
        if (index > -1) {
            markers.splice(index, 1);
        }
        updateRoute();
    }

    function removeLastMarker() {
        if (markers.length > 0) {
            var lastMarker = markers.pop();
            map.removeLayer(lastMarker);
            updateRoute();
        }
    }

    function updateRoute() {
        if (routingControl) {
            map.removeControl(routingControl);
        }

        if (markers.length >= 2) {
            var waypoints = markers.map(function (marker) {
                return marker.getLatLng();
            });

            routingControl = L.Routing.control({
                waypoints: waypoints,
                routeWhileDragging: true,
            }).addTo(map);
        }
    }

    function onMapClick(e) {
        var latlng = e.latlng;
        var latitude = latlng.lat;
        var longitude = latlng.lng;
        addMarker([latitude, longitude]);
    }

    function clearRoute() {
        markers.forEach(function (marker) {
            map.removeLayer(marker);
        });
        markers = [];
        if (routingControl) {
            map.removeControl(routingControl);
        }
    }

    function getData(){
        var data = document.getElementById('data');
        data = JSON.parse(data.outerText);
        return Array.from(data);
    }

    let latitude = 50.3965;
    let longitude = 3.6695;
    let map = L.map('map').setView([latitude, longitude], 13);

    //retrait de la fonction non utilisée et mal parenthésée !!

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    var markers = [];
    var routingControl; // Pour stocker le contrôle d'itinéraire


    map.on('click', onMapClick);

    document.getElementById('clearRoute').addEventListener('click', clearRoute);
    document.getElementById('removeLastMarker').addEventListener('click', removeLastMarker);

    function addHiddenItem(name,val){
        let p = document.createElement("input");
        p.setAttribute('type','text'); // à voir pour le type.
        p.setAttribute('name',name); // à voir pour le type.
        p.setAttribute('value',val);
        //p.setAttribute('visibility','hidden');//on les laisse apparaitre pour le moment, à cacher ensuite
        return(p);
    }

    function addHiddenInput() {
        let ourForm = document.getElementById('locationForm');// on change pour aller chercher le noeud parent de où on veut ajouter
        for(let i=0;i<markers.length;i++){
            let lat=markers[i].getLatLng().lat;
            let lng= markers[i].getLatLng().lng;
            let ida="LAT"+i;
            ourForm.appendChild(addHiddenItem(ida,lat));
            let idb="LNG"+i;
            ourForm.appendChild(addHiddenItem(idb,lng));
        }
        //reste à soumettre le formulaire une fois tout construit
        alert('En clickant sur ok, on va soumettre le formulaire, voir l\'URL avec les éléments ajoutés car en GET');
        document.getElementById('locationForm').submit()
    }

    document.getElementById('btn').addEventListener('click', addHiddenInput);

    function loadParcours(){
        var data = getData();
        for (var i = 1;i<data.length;i++){
            console.log(i);
            var lat = data[i]["latitude"];
            var lng = data[i]["longitude"];
            console.log(lat);
            console.log(lng);
            addMarker([lat, lng]);
        }
    }

    loadParcours();

</script>
</body>
</html>
