<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadata -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="DIVSIG UGM">
    <meta name="description" content="leaflet basic"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

   
    <!-- Judul pada tab browser -->
    <title>SIWARANG</title>

    <!-- Favicons -->
    <link href="assets/img/1.png" rel="icon">


    <!-- Leaflet CSS Library -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css">

    <!-- Tab browser icon -->
    <link rel="icon" type="image/x-icon" href="http://luk.staff.ugm.ac.id/logo/UGM/Resmi/Warna.gif">

    <!-- Favicons -->
    <link href="assets/img/1.png" rel="icon">

    <!--Routing-->
    <link rel="stylesheet" href="assets/plugins/leaflet-routing/leaflet-routing-machine.css" />

    <style>
        /* Tampilan peta fullscreen */
        html,
        body,
        #map {
            height: 100%;
            width: 100%;
            margin-top: 100px;
        }
    </style>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets1/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets1/css/font-awesome.css">

    <link rel="stylesheet" href="assets1/css/templatemo-klassy-cafe.css">

    <link rel="stylesheet" href="assets1/css/owl-carousel.css">

    <link rel="stylesheet" href="assets1/css/lightbox.css">

</head>

<body>
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-10">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        <img src="assets/img/dino.png" align="klassy cafe html template">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="index.html" class="active">Beranda</a></li>
                        <li class="scroll-to-section"><a href="wfsgeoserver1.html">Administrasi</a></li>
                        <li class="scroll-to-section"><a href="wisata.php">Destinasi</a></li>
                        <li class="scroll-to-section"><a href="perbandingan.html">Kurva</a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
    <!-- Leaflet JavaScript Library -->
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>

    <div id="map"></div>

    <!--Routing-->
          <script src="assets/plugins/leaflet-routing/leaflet-routing-machine.js"></script>
          <script src="assets/plugins/leaflet-routing/leaflet-routing-machine.min.js"></script>

    <script>
        /* Initial Map */ //(note: sesuaikan setView koordinat dan zoom level ke titik tengah lembar peta)
        var map = L.map('map').setView([-6.989051501057268, 110.40061998974797], 13); //lat, long, zoom

        /* Tile Basemap */ //(note: pilihan basemap diakses pada https://leaflet-extras.github.io/leaflet-providers/preview/)
        var basemap1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | <a href="DIVSIGUGM" target="_blank">DIVSIG UGM</a>' //menambahkan nama//
        });

        var basemap2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/ { z } / { y } / { x }', {
            attribution: 'Tiles &copy; Esri | <a href="Latihan WebGIS" target="_blank">DIVSIG UGM</a>'
        });

        var basemap3 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{ x } ', {
            attribution: 'Tiles &copy; Esri | <a href="Lathan WebGIS" target="_blank">DIVSIG UGM</a>'
        });

        
     
        basemap1.addTo(map);

        /* Layer Marker */
        var marker1 = L.marker([-6.9902739673644305, 110.42286893174493], { draggable: false });
        marker1.addTo(map);
        marker1.bindPopup("Simpang Lima Semarang");

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "database_semarang";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM data";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $lat = $row["latitude"];
                $long = $row["longitude"];
                $info = $row["nama"];
                // $gambar = $row["nama"];
                echo "L.marker([$lat, $long]).addTo(map).bindPopup('$info');";
            } 
        }
        else {
            echo "0 results";
        }
            $conn->close();
    ?>


        /* Control Layer */
        var baseMaps = {
            "OpenStreetMap": basemap1,
            "Esri World Street": basemap2,
            "Esri Imagery": basemap3

        };

        var overlayMaps = {
            "Simpang Lima Semarang": marker1,
        };

        L.control.layers(baseMaps, overlayMaps, { collapsed: false }).addTo(map);

        /* Scale Bar */
        L.control.scale({
            maxWidth: 150, position: 'bottomright'
        }).addTo(map);

        /*Routing*/
         L.Routing.control({
            position: "bottomleft",
              waypoints: [
                 L.latLng(-6.99701832255968, 110.40653454594758),
                 L.latLng(-7.0106926909088765, 110.4349923154862)
               ],
                  routeWhileDragging: true
              }).addTo(map);


    </script>
</body>

</html>
