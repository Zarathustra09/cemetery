<?php
include('../../connectMySql.php');
include '../../loginverification.php';
if(logged_in()){

$name = "";
$table_row = "";
$table_column = "";
$type = "";
$lat = "14.3297533";
$lng = "121.0933893";

if(isset($_GET['id']))
{
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
    //EDIT if ID is not null

    if(isset($_POST['btn_save']))
    {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $table_row = $_POST['table_row'];
        $table_column = $_POST['table_column'];
        $type = $_POST['type'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];

        $sql= "UPDATE graves
        SET 
        name = '". $name ."',
        table_row = '". $table_row ."',
        table_column = '". $table_column ."',
        type = '". $type ."',
        lat = '". $lat ."',
        lng = '". $lng ."'
        WHERE id = '". $id ."'";
        $result = mysqli_query($conn, $sql);
        header("location:index.php");

    }
}
else
{
    //ADD if ID is null
    if(isset($_POST['btn_save']))
    {
        $name = $_POST['name'];
        $table_row = $_POST['table_row'];
        $table_column = $_POST['table_column'];
        $type = $_POST['type'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];

        $sql = "INSERT INTO graves (
                                    `name`,
                                    `table_row`,
                                    `table_column`,
                                    `type`,
                                    `lat`,
                                    `lng`
                                  )
        VALUES (
                            '". $name ."',
                            '". $table_row ."',
                            '". $table_column ."',
                            '". $type ."',
                            '". $lat ."',
                            '". $lng ."'
                )";
                if (mysqli_query($conn, $sql)) {
                    $grave_id = mysqli_insert_id($conn);
            
                    for ($row = 1; $row <= $table_row; $row++) {
                        for ($col = 1; $col <= $table_column; $col++) {
                            $slot_value = "$row-$col";
                            $slot_sql = "INSERT INTO grave_slot (`grave_id`, `slot_value`, `lng`, `lat`, `status`) VALUES ('$grave_id', '$slot_value', '$lng', '$lat','AVAILABLE')";
                            mysqli_query($conn, $slot_sql);
                        }
                    }
            
                    header("location:index.php");
                }
            }
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

    <title>Biñan City Cemetery</title>

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

                         <div class="container">

                            <div class="card o-hidden border-0 shadow-lg my-5">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="p-5">
                                                <div class="text-center">
                                                    <h1 class="h4 text-gray-900 mb-4">Plot Graveyard</h1>
                                                </div>
                                                <form  method="post">
                                                    <div class="form-group row">
                                                    <input type="hidden" name="lng" id="lng" value=""  />
                                                    <input type="hidden" name="lat" id="lat" value=""  />
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Name</p>
                                                            <input type="text" class="form-control form-control" name="name" value="<?php echo $name;?>" required>
                                                        </div>
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Type</p>
                                                            <select name="type" class="form-control" required>
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
                                                            <input type="number" class="form-control form-control" name="table_row" value="<?php echo $table_row;?>" required>
                                                        </div>

                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Column</p>
                                                            <input type="number" class="form-control form-control" name="table_column" value="<?php echo $table_column;?>" required>
                                                        </div>
                                                    </div>
                                                    <div id='map' style='width: 100%; height: 500px;'></div>
                                                    <hr>
                                                    <div class="form-group row">
                                                    <button type="submit" name="btn_save" class="btn btn-primary btn-user btn-block col-sm-6"> Save </button>
                                                    <hr>
                                                    <a href="index.php" class="btn btn-google btn-user btn-block col-sm-6"> Cancel </a>
                                                    </div>
                                                </form>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

            </div>
        </div>
            
            <!-- End of Main Content -->

            <?php include'../footer.php';?>

        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
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

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../js/sb-admin-2.min.js"></script>
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
