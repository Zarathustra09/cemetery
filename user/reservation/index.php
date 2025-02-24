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
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
        <script src="../../js/sweetalert2.all.js"></script>
        <script src="../../js/sweetalert2.js"></script>
        <script src="../../js/sweetalert2.css"></script>

        <style>
            /* Default table styling */
            .table-responsive table {
                width: 100%;
                border-collapse: collapse;
            }
            .table-responsive th,
            .table-responsive td {
                padding: 8px;
                border: 1px solid #ddd;
                text-align: left;
            }

            @media (max-width: 768px) {
                .table-responsive thead {
                    display: none;
                }

                /* Transform rows into cards */
                .table-responsive tr {
                    display: flex;
                    flex-direction: column;
                    margin-bottom: 10px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    padding: 10px;
                    background-color: #f9f9f9;
                }

                /* Display th and td as flex items */
                .table-responsive td {
                    display: flex;
                    justify-content: space-between;
                    border: none;
                    padding: 5px 0;
                }

                /* Add labels (headers) to each td */
                .table-responsive td::before {
                    content: attr(data-label);
                    font-weight: bold;
                    margin-right: 10px;
                    flex: 1;
                }

                /* Ensure buttons are displayed correctly */
                .table-responsive td[data-label="Tool"] {
                    display: block;
                    text-align: center;
                }

                .table-responsive td[data-label="Tool"] a {
                    display: inline-block;
                    margin: 5px 0;
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
                        <h1 class="h3 mb-0 text-gray-800">Reservation</h1>
                        <!-- Add button -->
                        <a href="add.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm add-button">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Add
                        </a>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List</h6>
                        </div>
                        <div class="card-body bg-success" style="color:white;">
                            <div class="table-responsive">
                                <table style="background-color:white;color:black;" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Tool</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Row</th>
                                        <th>Column</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //GET GRAVE
                                    $query = "SELECT * FROM graves";
                                    $result = $conn->query($query);
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr role='row'>";
                                        echo ' <td data-label="Tool">
    <a href="view.php?id=' . $row["id"] . '&type='.$row['type'].'" class="btn btn-sm btn-info shadow-sm" id="' . $row["id"] . '">
        <i class="fas fa-eye"></i>
    </a>
</td>';
                                        echo "<td data-label='Name'>" . strtoupper($row['name']) . "</td>";
                                        echo "<td data-label='Type'>" . strtoupper($row['type']) . "</td>";
                                        echo "<td data-label='Row'>" . strtoupper($row['table_row']) . "</td>";
                                        echo "<td data-label='Column'>" . strtoupper($row['table_column']) . "</td>";
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
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </body>

    </html>
    <?php
}
else
{
    header('location:../../index.php');
}
?>