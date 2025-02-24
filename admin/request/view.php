<?php
include '../../connectMySql.php';
include '../../loginverification.php';
if(logged_in()){

$table_row = 1;
$table_column = 1;

$query = "SELECT * FROM graves WHERE id ='".$_GET['id']."'";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $name = $row['name'];
    $table_row = $row['table_row'];
    $table_column = $row['table_column'];
    $type = $row['type'];
    $lat = $row['lat'];
    $lng = $row['lng'];
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
                        <h1 class="h3 mb-0 text-gray-800">Plot Graveyard</h1>
                        <a href="index.php" class=" btn btn-sm btn-danger shadow-sm"> Back </a>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List</h6>
                        </div>
                       
                        <div class="card-body" style="overflow: auto; max-height: 500px; border: 1px solid #ddd;">
                        <table>
                            <?php for ($i = 1; $i <= $table_row; $i++) { ?>
                                <tr>
                                    <?php for ($j = 1; $j <= $table_column; $j++) { 
                                    ?>
                                        <td>
                                            <button class="btn btn-info" name="<?= $i ?>-<?= $j ?>">Available</button>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </table>
                        </div>
                    </div>



                    <div class="card o-hidden border-0 shadow-lg my-5">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="p-5">
                                                <form  method="post">
                                                    <div class="form-group row">
                                                    <input type="hidden" name="lng" id="lng" value=""  />
                                                    <input type="hidden" name="lat" id="lat" value=""  />
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Name</p>
                                                            <input type="text" class="form-control form-control" name="name" value="<?php echo $name;?>" readOnly>
                                                        </div>
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Type</p>
                                                            <select name="type" class="form-control" readOnly>
                                                                <option value="">-SELECT-</option>
                                                                <option value="SOCIALIZED NICHE APARTMENT" <?= $type == 'SOCIALIZED NICHE APARTMENT'? 'selected' : ''?>>SOCIALIZED NICHE APARTMENT</option>
                                                                <option value="LAWN LOT" <?= $type == 'LAWN LOT'? 'selected' : ''?>>LAWN LOT</option>
                                                                <option value="BONE VAULT APARTMENT" <?= $type == 'BONE VAULT APARTMENT'? 'selected' : ''?>>BONE VAULT APARTMENT</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Row</p>
                                                            <input type="number" class="form-control form-control" name="table_row" value="<?php echo $table_row;?>" readOnly>
                                                        </div>

                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Column</p>
                                                            <input type="number" class="form-control form-control" name="table_column" value="<?php echo $table_column;?>" readOnly>
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
    function getLocation() {
        const latitude = <?=$lat?>;
        const longitude = <?=$lng?>;

        document.getElementById('lng').value = longitude;
        document.getElementById('lat').value = latitude;

        mapboxgl.accessToken = 'pk.eyJ1Ijoicm9tZ29kIiwiYSI6ImNsaTc2c3lpMzBsejgzZWx1eHF2N2szMDkifQ.f3wXh8auB8hZQ1oB_ojnNw';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v10',
            center: [longitude, latitude],
            zoom: 16
        });

        var draggableMarker = new mapboxgl.Marker({
            draggable: true
        }).setLngLat([longitude, latitude])
            .addTo(map);

        draggableMarker.on('dragend', function () {
            var lngLat = draggableMarker.getLngLat();
            console.clear();
            console.log(lngLat.lng + ', ' + lngLat.lat);
            document.getElementById('lng').value = lngLat.lng;
            document.getElementById('lat').value = lngLat.lat;
        });
    }
        </script>
</body>

</html>
<?php
}
else
{
    header('location:../../index.php');
}?>