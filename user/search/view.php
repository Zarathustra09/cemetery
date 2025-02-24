<?php
include '../../connectMySql.php';
include '../../loginverification.php';
if(logged_in()){

    $id = $_GET['id'];
    $death_fullname = '';
    $death_date = '';
    $death_birth = '';
    $grave_name = '';
    $lng = '';
    $lat = '';
    
    
        $query = "SELECT a.id,a.death_fullname,a.death_date,a.death_birth,concat(b.`name` ,'-',slot_value)as grave_name,a.lng,a.lat FROM grave_slot a
LEFT JOIN graves b ON b.id = a.grave_id WHERE a.id ='".$id."' ";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            $death_fullname = $row['death_fullname'];
            $death_date = $row['death_date'];
            $death_birth = $row['death_birth'];
            $grave_name = $row['grave_name'];
            $lng = $row['lng'];
            $lat = $row['lat'];
        }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Biñan City Cemetery </title>
    <link rel="icon" type="image/x-icon" href="../../img/logo.jpg" />

    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.css' rel='stylesheet' />
</head>

<body id="page-top" onload="getLocation()">

    <div id="wrapper">

       <?php include'../sidebar.php';?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

               <?php include'../nav.php';?>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Details</h1>
                        <a href="index.php" class=" btn btn-sm btn-danger shadow-sm"> Back </a>
                    </div>

                    <div class="card o-hidden border-0 shadow-lg my-5">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="p-5">
                                                <form  method="post">
                                                    <input type="hidden" name="lng" id="lng" value=""  />
                                                    <input type="hidden" name="lat" id="lat" value=""  />
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 col-12 mb-sm-0">
                                                            <p>Slot</p>
                                                            <input type="text" class="form-control form-control" name="grave_name" value="<?php echo $grave_name;?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 col-12 mb-sm-0">
                                                            <p>Fullname</p>
                                                            <input type="text" class="form-control form-control" name="death_fullname" value="<?php echo $death_fullname;?>" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Date of Death</p>
                                                            <input type="date" class="form-control form-control" name="death_date" value="<?php echo $death_date;?>" readonly>
                                                        </div>
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Date of Birth</p>
                                                            <input type="date" class="form-control form-control" name="death_birth" value="<?php echo $death_birth;?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div id='map' style='width: 100%; height: 500px;'></div>
                                                    <hr>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                </div>
        </div>
            <?php include'../footer.php';?>

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../js/sb-admin-2.min.js"></script>
    <script src="../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
      $(function () {
        $("#dataTable").DataTable({
          "responsive": true,
          "autoWidth": false,
          "bDestroy": true,
        });
      });

      
      function getRoute(start, end) {
    mapboxgl.accessToken = 'pk.eyJ1Ijoicm9tZ29kIiwiYSI6ImNsaTc2c3lpMzBsejgzZWx1eHF2N2szMDkifQ.f3wXh8auB8hZQ1oB_ojnNw';

    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: start,
        zoom: 16 // Set zoom level to 16
    });

    var directionsRequest = `https://api.mapbox.com/directions/v5/mapbox/driving/${start[0]},${start[1]};${end[0]},${end[1]}?geometries=geojson&access_token=${mapboxgl.accessToken}`;
    
    fetch(directionsRequest)
        .then(response => response.json())
        .then(data => {
            const route = data.routes[0].geometry.coordinates;
            
            map.on('load', () => {
                map.addSource('route', {
                    'type': 'geojson',
                    'data': {
                        'type': 'Feature',
                        'properties': {},
                        'geometry': {
                            'type': 'LineString',
                            'coordinates': route
                        }
                    }
                });
                
                map.addLayer({
                    'id': 'route',
                    'type': 'line',
                    'source': 'route',
                    'layout': {
                        'line-join': 'round',
                        'line-cap': 'round'
                    },
                    'paint': {
                        'line-color': '#FF0000', // Set the line color to red
                        'line-width': 5,
                        'line-opacity': 0.75
                    }
                });

                // Add the green marker for the starting point
                new mapboxgl.Marker({ color: 'green' })
                    .setLngLat(start)
                    .addTo(map);

                // Add the red marker for the ending point
                const markerElement = document.createElement('div');
                markerElement.style.backgroundImage = 'url(../../img/danger.png)'; // Set PNG image
                markerElement.style.width = '30px'; // Adjust size as needed
                markerElement.style.height = '30px';
                markerElement.style.backgroundSize = 'cover';

                new mapboxgl.Marker(markerElement)
                    .setLngLat(end)
                    .addTo(map);

              

                // Add the legend
                const legend = document.createElement('div');
                legend.id = 'legend';
                legend.innerHTML = `
                    <div style="margin-bottom: 10px;">
                        <span style="background-color: green; width: 15px; height: 15px; display: inline-block; margin-right: 5px;"></span>
                        Main Entrance
                    </div>
                    <div>
                        <span style="background-color: red; width: 15px; height: 15px; display: inline-block; margin-right: 5px;"></span>
                        Grave Location
                    </div>
                `;
                legend.style.position = 'absolute';
                legend.style.bottom = '10px';
                legend.style.left = '10px';
                legend.style.backgroundColor = 'white';
                legend.style.padding = '10px';
                legend.style.border = '1px solid #ccc';
                legend.style.borderRadius = '4px';
                legend.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.2)';
                document.getElementById('map').appendChild(legend);
            });
        })
        .catch(error => console.error('Error fetching route:', error));
}

// Call getRoute with the start and end points
document.addEventListener('DOMContentLoaded', function () {
    const start = [121.090816, 14.328830];
    const end = [<?=$lng?>, <?=$lat?>];
    getRoute(start, end);
});

        </script>
</body>

</html>
<?php
}
else
{
    header('location:../../index.php');
}?>