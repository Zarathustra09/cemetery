<?php
include '../../connectMySql.php';
include '../../loginverification.php';
if(logged_in()){
    $sql = "SELECT a.*,b.slot_value,c.name,b.firstname,b.lastname FROM request a
LEFT JOIN grave_slot b on b.id = a.grave_slot_id
LEFT JOIN graves c on c.id = b.grave_id";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biñan City Cemetery</title>
    <link rel="icon" type="image/x-icon" href="../../img/logo.jpg" />
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include'../sidebar.php';?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include'../nav.php';?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Service Report</h1>
                    </div>
                    <div class="card shadow mb-4 bg-success" style="color:white;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Service 
                                <button onclick="exportToExcel()" class="btn btn-success btn-sm float-right">Export to Excel</button>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label>Start Date:</label>
                                    <input type="date" id="startDate" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>End Date:</label>
                                    <input type="date" id="endDate" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Status:</label>
                                    <select id="statusFilter" class="form-control">
                                        <option value="">All</option>
                                        <option value="APPROVED">APPROVED</option>
                                        <option value="PENDING">PENDING</option>
                                        <option value="DECLINED">DECLINED</option>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button class="btn btn-primary" onclick="filterTable()">Search</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" style="background-color:white;color:black;"  id="exportTable">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Grave Name</th>
                                            <th>Slot</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Payment Date</th>
                                            <th>Service Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row['type'] . "</td>";
                                                echo "<td>" . $row['name'] . "</td>";
                                                echo "<td>" . $row['slot_value'] . "</td>";
                                                echo "<td>" . $row['firstname'] . "</td>";
                                                echo "<td>" . $row['lastname'] . "</td>";
                                                echo "<td>" . $row['payment_date'] . "</td>";
                                                echo "<td>" . $row['service_date'] . "</td>";
                                                echo "<td>" . $row['status'] . "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='13' class='text-center'>No data available</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <script>
        function filterTable() {
            let startDate = document.getElementById("startDate").value;
            let endDate = document.getElementById("endDate").value;
            let statusFilter = document.getElementById("statusFilter").value;
            let rows = document.querySelectorAll("#tableBody tr");

            rows.forEach(row => {
                let serviceDate = row.cells[6].innerText.trim(); 
                let status = row.cells[7].innerText.trim(); 
                let showRow = true;

                if (startDate && serviceDate < startDate) showRow = false;
                if (endDate && serviceDate > endDate) showRow = false;
                if (statusFilter && status !== statusFilter) showRow = false;

                row.style.display = showRow ? "" : "none";
            });
        }

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
<?php } else { header('location:../../index.php'); } ?>
