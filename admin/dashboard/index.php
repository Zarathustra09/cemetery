<?php
include '../../connectMySql.php';
include '../../loginverification.php';
if(logged_in()){
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
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="../../js/sweetalert2.all.js"></script>
    <script src="../../js/sweetalert2.js"></script>
    <script src="../../js/sweetalert2.css"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <style>
        .table th, .table td {
            font-size: 1.2rem; /* Increase font size for table content */
        }
        .text-lg {
            font-size: 1.2rem; /* Increase font size for text-lg class */
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h5 class="h5 mb-0 text-gray-800">Reservation</h5>
                    </div>

                    <div class="row">
                            <div class="col-xl-3 col-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-lg font-weight-bold text-warning text-uppercase mb-1">
                                                    Reserved</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                            $query = "SELECT count(id) as total FROM grave_slot WHERE status = 'RESERVED' ";
                                            $result = $conn->query($query);
                                            while ($row = $result->fetch_assoc()) {
                                                echo $row['total'];
                                            }
                                            ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-flag-checkered fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">
                                                    Available</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                            $query = "SELECT count(id) as total FROM grave_slot WHERE status = 'AVAILABLE' ";
                                            $result = $conn->query($query);
                                            while ($row = $result->fetch_assoc()) {
                                                echo $row['total'];
                                            }
                                            ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-3 col-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">
                                                    Not Available</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                            $query = "SELECT count(id) as total FROM grave_slot WHERE status = 'NOT AVAILABLE' ";
                                            $result = $conn->query($query);
                                            while ($row = $result->fetch_assoc()) {
                                                echo $row['total'];
                                            }
                                            ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-lg font-weight-bold text-success text-uppercase mb-1">
                                                    Taken</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                            $query = "SELECT count(id) as total FROM grave_slot WHERE status = 'TAKEN' ";
                                            $result = $conn->query($query);
                                            while ($row = $result->fetch_assoc()) {
                                                echo $row['total'];
                                            }
                                            ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h5 class="h5 mb-0 text-gray-800">Services</h5>
                    </div>

                        <div class="row"> 
                            <div class="col-xl-4 col-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-lg font-weight-bold text-warning text-uppercase mb-1">
                                                PENDING</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                            $query = "SELECT count(id) as total FROM request WHERE status = 'PENDING' ";
                                            $result = $conn->query($query);
                                            while ($row = $result->fetch_assoc()) {
                                                echo $row['total'];
                                            }
                                            ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-lg font-weight-bold text-success text-uppercase mb-1">
                                                    APPROVED</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                            $query = "SELECT count(id) as total FROM request WHERE status = 'APPROVED' ";
                                            $result = $conn->query($query);
                                            while ($row = $result->fetch_assoc()) {
                                                echo $row['total'];
                                            }
                                            ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-6 mb-4">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">
                                                    DECLINED</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                            $query = "SELECT count(id) as total FROM request WHERE status = 'DECLINED' ";
                                            $result = $conn->query($query);
                                            while ($row = $result->fetch_assoc()) {
                                                echo $row['total'];
                                            }
                                            ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">SOCIALIZED NICHE APARTMENT DEADLINE</h6>
                        </div>
                        <div class="card-body bg-success" style="color:white;">
                            <div class="table-responsive">
                                <table style="background-color:white;color:black;" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Grave Type</th>
                                            <th>Slot</th>
                                            <th>Deadline</th>
                                            <th>Name</th>
                                            <th>Mobile No.</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT slot_value, name, CONCAT(firstname, ' ', lastname) AS fullname, deadline, mobile_no, email 
                                                    FROM grave_slot a  
                                                    LEFT JOIN graves b ON b.id = a.grave_id  
                                                    WHERE DATE(deadline) BETWEEN CURDATE() AND CURDATE() + INTERVAL 6 DAY;";
                                        $result = $conn->query($query);
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr role='row'>";
                                            echo "<td>" . strtoupper($row['name']) . "</td>";
                                            echo "<td>" . strtoupper($row['slot_value']) . "</td>";
                                            echo "<td>" . strtoupper($row['deadline']) . "</td>";
                                            echo "<td>" . strtoupper($row['fullname']) . "</td>";
                                            echo "<td>" . strtoupper($row['mobile_no']) . "</td>";
                                            echo "<td>" . strtoupper($row['email']) . "</td>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>





                </div>
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
        function exportToExcel() {
            let table = document.getElementById("exportTable");
            let wb = XLSX.utils.book_new();
            let ws = XLSX.utils.table_to_sheet(table);
            XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
            XLSX.writeFile(wb, "reservation.xlsx");
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