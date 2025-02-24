<?php
include '../../connectMySql.php';
include '../../loginverification.php';
if(logged_in()){

    
$query = "SELECT a.*,b.type FROM grave_slot a 
LEFT JOIN graves b on b.id = a.grave_id";
$result = $conn->query($query);

$graveData = [];

while ($row = $result->fetch_assoc()) {
    
    $graveData[] = [
        'name' => $row['firstname'].''.$row['middlename'].''.$row['lastname'],
        'grave_id' => $row['grave_id'],
        'slot_value' => $row['slot_value'],
        'user_id' => $row['user_id'],
        'status' => $row['status'],
        'lat' => $row['lat'],
        'lng' => $row['lng'],
        'type' => $row['type']
    ];
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
    <script src="../../js/sweetalert2.all.js"></script>
    <script src="../../js/sweetalert2.js"></script>
    <script src="../../js/sweetalert2.css"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.css' rel='stylesheet' />

    <style>
        /* Add this CSS */
        @media (max-width: 768px) {
            .table-responsive thead {
                display: none;
            }

            .table-responsive tr {
                display: flex;
                flex-direction: column;
                margin-bottom: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 10px;
                background-color: #f9f9f9;
            }

            .table-responsive td {
                display: flex;
                justify-content: space-between;
                border: none;
                padding: 5px 0;
            }

            .table-responsive td::before {
                content: attr(data-label);
                font-weight: bold;
                margin-right: 10px;
                flex: 1;
            }

            .table-responsive td[data-label="View"] {
                display: block;
                text-align: center;
            }
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

       <?php include'../sidebar.php';?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

               <?php include'../nav.php';?>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Search</h1>
                    </div>

                        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List</h6>
                        </div>
                        <div class="card-body bg-success">

                        <div id='map' style='width: 100%; height: 500px;'></div>

                            <div class="table-responsive">
                                <table style="background-color:white;color:black;"  class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>View</th>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Death Date</th>
                                            <th>Birth Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT a.id,a.death_fullname,a.death_date,a.death_birth,concat(b.`name` ,'-',slot_value)as grave_name FROM grave_slot a
LEFT JOIN graves b ON b.id = a.grave_id WHERE a.death_fullname != '' ";
                                        $result = $conn->query($query);
                                        while ($row = $result->fetch_assoc()) {
echo "<tr role='row'>";
echo '<td data-label="View">
    <a href="view.php?id=' . $row["id"] . '" class="btn btn-sm btn-primary shadow-sm" id="' . $row["id"] . '">
        <i class="fas fa-eye"></i>
    </a>
</td>';
echo "<td data-label='Name'>" . strtoupper($row['death_fullname']) . "</td>";
echo "<td data-label='Location'>" . strtoupper($row['grave_name']) . "</td>";
echo "<td data-label='Death Date'>" . strtoupper($row['death_date']) . "</td>";
echo "<td data-label='Birth Date'>" . strtoupper($row['death_birth']) . "</td>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
            <?php include'../footer.php';?>

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
        });
      });
        
        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            const id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'delete.php', 
                        method: 'POST',
                        data: { id: id },
                        success: function (response) {
                            Swal.fire(
                                'Deleted!',
                                'The record has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting the record.',
                                'error'
                            );
                        }
                    });
                }
            });
        });


</script>
<script>
    
   
    mapboxgl.accessToken = 'pk.eyJ1Ijoicm9tZ29kIiwiYSI6ImNsaTc2c3lpMzBsejgzZWx1eHF2N2szMDkifQ.f3wXh8auB8hZQ1oB_ojnNw';

var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v10',
    center: [121.0933893, 14.3297533], 
    zoom: 16
});

var graves = <?php echo json_encode($graveData); ?>;

graves.forEach(function(grave) {
    let iconUrl = '';

    switch (grave.status) {
        case 'NOT AVAILABLE':
            iconUrl = '../../img/danger.png';
            break;
        case 'RESERVED':
            iconUrl = '../../img/warning.png';
            break;
        case 'TAKEN':
            //pag sayo yung slot
            if (<?= $_SESSION['user_id']?> == grave.user_id) {
                iconUrl = '../../img/success.png';
            }
            //paghindi sayo yung slot
            else{
                iconUrl = '../../img/default.png';
            }
            break;
        default:
            iconUrl = '../../img/info.png';
    }

    let btn_reserve = `<a href="../reservation/register.php?slot_value=${grave.slot_value}&grave_id=${grave.grave_id}&transaction=edit&type=${grave.type}"><span class="badge badge-info"><h5>RESERVE<h5></span></a>`;
    if(grave.status != 'AVAILABLE'){
        btn_reserve = '';
    }

    var marker = new mapboxgl.Marker({
        element: createCustomMarker(iconUrl)
    })
    .setLngLat([grave.lng, grave.lat])
    .setPopup(new mapboxgl.Popup().setHTML(`<h6>${grave.name}</h6><p>Status: ${grave.status}</p><p>Slot: ${grave.slot_value}</p> ${btn_reserve}`))
    .addTo(map);
});

function createCustomMarker(iconUrl) {
    var markerDiv = document.createElement('div');
    markerDiv.style.backgroundImage = `url(${iconUrl})`;
    markerDiv.style.width = '32px';
    markerDiv.style.height = '32px';
    markerDiv.style.backgroundSize = 'cover';
    return markerDiv;
}


// Add the legend
const legend = document.createElement('div');
legend.id = 'legend';
legend.innerHTML = `
    <div>
        <span style="color:black; background-color: red; width: 15px; height: 15px; display: inline-block; margin-right: 5px;"></span>
        NOT AVAILABLE
    </div>
    <div>
        <span style="color:black; background-color: blue; width: 15px; height: 15px; display: inline-block; margin-right: 5px;"></span>
        AVAILABLE
    </div>
    <div>
        <span style="color:black; background-color: orange; width: 15px; height: 15px; display: inline-block; margin-right: 5px;"></span>
        RESERVED
    </div>
    <div>
        <span style="color:black; background-color: green; width: 15px; height: 15px; display: inline-block; margin-right: 5px;"></span>
        TAKEN BY YOU
    </div>
    <div>
        <span style="color:black; background-color: gray; width: 15px; height: 15px; display: inline-block; margin-right: 5px;"></span>
        TAKEN BY OTHERS
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

</script>
</body>

</html>
<?php
}
else
{
    header('location:../../index.php');
}?>