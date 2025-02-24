<?php
include('../../connectMySql.php');
include '../../loginverification.php';
if(logged_in()){

$grave_id = $_GET['grave_id'];
$slot_value = $_GET['slot_value'];
$status = 'RESERVED';
$payment_date = '';
$reservation_date = date('Y-m-d');
$firstname = '';
$middlename = '';
$lastname = '';
$address = '';
$age = '';
$birthdate = '';
$birthplace = '';
$religion = '';
$nationality = '';
$civil_status = '';
$spouse = '';
$tel_no = '';
$mobile_no = '';
$home = '';
$occupation = '';
$company = '';
$email = '';
$beneficiaries1 = '';
$relationship1 = '';
$age1 = '';
$beneficiaries2 = '';
$relationship2 = '';
$age2 = '';
$beneficiaries3 = '';
$relationship3 = '';
$age3 = '';
$death_fullname = '';
$death_date = '';
$death_birth = '';
$attachment = '';
$deadline = '';


if($_GET['transaction'] == 'edit')
{

    $query = "SELECT * FROM grave_slot WHERE grave_id ='".$grave_id."' and slot_value = '".$slot_value."' ";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $slot_value = $row['slot_value'];
        $status = $row['status'] === 'AVAILABLE'? 'RESERVED' : $row['status'];
        $payment_date = $row['payment_date'];
        $reservation_date = $row['reservation_date'];
        $firstname = $row['firstname'];
        $middlename = $row['middlename'];
        $lastname = $row['lastname'];
        $address = $row['address'];
        $age = $row['age'];
        $birthdate = $row['birthdate'];
        $birthplace = $row['birthplace'];
        $religion = $row['religion'];
        $nationality = $row['nationality'];
        $civil_status = $row['civil_status'];
        $spouse = $row['spouse'];
        $tel_no = $row['tel_no'];
        $mobile_no = $row['mobile_no'];
        $home = $row['home'];
        $occupation = $row['occupation'];
        $company = $row['company'];
        $email = $row['email'];
        $beneficiaries1 = $row['beneficiaries1'];
        $relationship1 = $row['relationship1'];
        $age1 = $row['age1'];
        $beneficiaries2 = $row['beneficiaries2'];
        $relationship2 = $row['relationship2'];
        $age2 = $row['age2'];
        $beneficiaries3 = $row['beneficiaries3'];
        $relationship3 = $row['relationship3'];
        $age3 = $row['age3'];
        $death_fullname = $row['death_fullname'];
        $death_date = $row['death_date'];
        $death_birth = $row['death_birth'];
        $attachment = $row['attachment'];
        $deadline = $row['deadline'];
    }

    if(isset($_POST['btn_save']))
    {
        $status = $_POST['status'];
        $payment_date = $_POST['payment_date'];
        $reservation_date = $_POST['reservation_date'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $birthdate = $_POST['birthdate'];
        $birthplace = $_POST['birthplace'];
        $religion = $_POST['religion'];
        $nationality = $_POST['nationality'];
        $civil_status = $_POST['civil_status'];
        $spouse = $_POST['spouse'];
        $tel_no = $_POST['tel_no'];
        $mobile_no = $_POST['mobile_no'];
        $home = $_POST['home'];
        $occupation = $_POST['occupation'];
        $company = $_POST['company'];
        $email = $_POST['email'];
        $beneficiaries1 = $_POST['beneficiaries1'];
        $relationship1 = $_POST['relationship1'];
        $age1 = $_POST['age1'];
        $beneficiaries2 = $_POST['beneficiaries2'];
        $relationship2 = $_POST['relationship2'];
        $age2 = $_POST['age2'];
        $beneficiaries3 = $_POST['beneficiaries3'];
        $relationship3 = $_POST['relationship3'];
        $age3 = $_POST['age3'];
        $death_fullname = $_POST['death_fullname'];
        $death_date = $_POST['death_date'];
        $death_birth = $_POST['death_birth'];
        $deadline = $_POST['deadline'];

        $sql= "UPDATE grave_slot
        SET 
        user_id = '". $_SESSION['user_id'] ."',
        status = '". $status ."',
        payment_date = '". $payment_date ."',
        firstname = '".$firstname."',
        middlename = '".$middlename."',
        lastname = '".$lastname."',
        address = '".$address."',
        age = '".$age."',
        birthdate = '".$birthdate."',
        birthplace = '".$birthplace."',
        religion = '".$religion."',
        nationality = '".$nationality."',
        civil_status = '".$civil_status."',
        spouse = '".$spouse."',
        tel_no = '".$tel_no."',
        mobile_no = '".$mobile_no."',
        home = '".$home."',
        occupation = '".$occupation."',
        company = '".$company."',
        email = '".$email."',
        beneficiaries1 = '".$beneficiaries1."',
        relationship1 = '".$relationship1."',
        age1 = '".$age1."',
        beneficiaries2 = '".$beneficiaries2."',
        relationship2 = '".$relationship2."',
        age2 = '".$age2."',
        beneficiaries3 = '".$beneficiaries3."',
        relationship3 = '".$relationship3."',
        age3 = '".$age3."',
        death_fullname = '".$death_fullname."',
        death_date = '".$death_date."',
        death_birth = '".$death_birth."'
        WHERE slot_value = '". $slot_value ."' and grave_id='".$grave_id."' ";
        $result = mysqli_query($conn, $sql);

        if($status == 'TAKEN'){
            require_once('../../PHPMailer/PHPMailerAutoload.php');
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = 'sendernotifalert@gmail.com';
                $mail->Password = 'asng husd wqqr xuwp';
                $mail->setFrom('sendernotifalert@gmail.com', 'Binan City Cemetery');
                $mail->addReplyTo('sendernotifalert@gmail.com', 'Binan City Cemetery');
                $mail->addAddress( $email , 'Receiver Name');
                $mail->Subject = 'RESERVATION APPROVED';
                $mail->Body = 
                'Dear '.$firstname.' '.$lastname.',

We are pleased to inform you that your reservation request for the grave slot has been approved. Below are the details of your reservation:

Grave Slot: '.$slot_value.'';
                if (!$mail->send()) {
                    echo 'Email not valid : ' . $mail->ErrorInfo;
                    return;
                }
        }
        header("location:view.php?id=".$grave_id."&type=".$_GET['type']."");

    }
}
else if($_GET['transaction'] == 'add')
{

    if(isset($_POST['btn_save']))
    {
        $status = $_POST['status'];
        $payment_date = $_POST['payment_date'];
        $reservation_date = $_POST['reservation_date'];
        $reservation_date = $_POST['reservation_date'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $birthdate = $_POST['birthdate'];
        $birthplace = $_POST['birthplace'];
        $religion = $_POST['religion'];
        $nationality = $_POST['nationality'];
        $civil_status = $_POST['civil_status'];
        $spouse = $_POST['spouse'];
        $tel_no = $_POST['tel_no'];
        $mobile_no = $_POST['mobile_no'];
        $home = $_POST['home'];
        $occupation = $_POST['occupation'];
        $company = $_POST['company'];
        $email = $_POST['email'];
        $beneficiaries1 = $_POST['beneficiaries1'];
        $relationship1 = $_POST['relationship1'];
        $age1 = $_POST['age1'];
        $beneficiaries2 = $_POST['beneficiaries2'];
        $relationship2 = $_POST['relationship2'];
        $age2 = $_POST['age2'];
        $beneficiaries3 = $_POST['beneficiaries3'];
        $relationship3 = $_POST['relationship3'];
        $age3 = $_POST['age3'];
        $death_fullname = $_POST['death_fullname'];
        $death_date = $_POST['death_date'];
        $death_birth = $_POST['death_birth'];


        //INSERT NEW RESERVATION
        $sql = "INSERT INTO grave_slot (
            `grave_id`,
            `slot_value`,
            `user_id`,
            `status`,
            `payment_date`,
            `firstname`,
            `middlename`,
            `lastname`,
            `address`,
            `age`,
            `birthdate`,
            `birthplace`,
            `religion`,
            `nationality`,
            `civil_status`,
            `spouse`,
            `tel_no`,
            `mobile_no`,
            `home`,
            `occupation`,
            `company`,
            `email`,
            `beneficiaries1`,
            `relationship1`,
            `age1`,
            `beneficiaries2`,
            `relationship2`,
            `age2`,
            `beneficiaries3`,
            `relationship3`,
            `age3`,
            `death_fullname`,
            `death_date`,
            `death_birth`
          )
        VALUES (
        '". $grave_id ."',
        '". $slot_value ."',
        '". $_SESSION['user_id'] ."',
        '". $status ."',
        '". $payment_date ."',
        '". $firstname ."',
        '". $middlename ."',
        '". $lastname ."',
        '". $address ."',
        '". $age ."',
        '". $birthdate ."',
        '". $birthplace ."',
        '". $religion ."',
        '". $nationality ."',
        '". $civil_status ."',
        '". $spouse ."',
        '". $tel_no ."',
        '". $mobile_no ."',
        '". $home ."',
        '". $occupation ."',
        '". $company ."',
        '". $email ."',
        '". $beneficiaries1 ."',
        '". $relationship1 ."',
        '". $age1 ."',
        '". $beneficiaries2 ."',
        '". $relationship2 ."',
        '". $age2 ."',
        '". $beneficiaries3 ."',
        '". $relationship3 ."',
        '". $age3 ."',
        '". $death_fullname ."',
        '". $death_date ."',
        '". $death_birth ."'
        )";
        $result = mysqli_query($conn, $sql);
        header("location:view.php?id=".$grave_id."&type=".$_GET['type']."");
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
                                                    <h1 class="h4 text-gray-900 mb-4">Details</h1>
                                                </div>
                                                <form  method="post">
                                                    <div class="form-group row">

                                                            <?php 
                                                            if($attachment !=''){
                                                            ?>
                                                            <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Download Title</p>
                                                                <a href="../../attachment/<?=$attachment?>" target="_blank" class="btn btn-success"><i class="fas fa-download"></i></a>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php 
                                                            if($_GET['type']=='SOCIALIZED NICHE APARTMENT'){
                                                            ?>
                                                            <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Deadline</p>
                                                                <input type="date" class="form-control" name="deadline" value="<?php echo $deadline;?>" readonly>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 col-12 mb-sm-0">
                                                            <p>Fullname</p>
                                                            <input type="text" class="form-control form-control" name="death_fullname" value="<?php echo $death_fullname;?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Date of Death</p>
                                                            <input type="date" class="form-control form-control" name="death_date" value="<?php echo $death_date;?>" required>
                                                        </div>
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Date of Birth</p>
                                                            <input type="date" class="form-control form-control" name="death_birth" value="<?php echo $death_birth;?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                    <input type="hidden" name="lng" id="lng" value=""  />
                                                    <input type="hidden" name="lat" id="lat" value=""  />
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Slot :</p>
                                                            <input type="text" class="form-control form-control" name="slot_value" value="<?= $_GET['slot_value'];?>" readonly>
                                                        </div>
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Status</p>
                                                            <select name="status" class="form-control" readonly>
                                                                <option value="">-SELECT-</option>
                                                                <option value="RESERVED" <?= $status == 'RESERVED'? 'selected' : ''?>>RESERVED</option>
                                                                
                            
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Payment Date</p>
                                                            <input type="date" class="form-control form-control" name="payment_date" value="<?= $payment_date;?>">
                                                        </div>

                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Reservation Date</p>
                                                            <input type="date" class="form-control form-control" name="reservation_date" value="<?= $reservation_date;?>" readonly>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Firstname</p>
                                                            <input type="text" class="form-control form-control" name="firstname" value="<?= $firstname;?>">
                                                        </div>

                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Middlename</p>
                                                            <input type="text" class="form-control form-control" name="middlename" value="<?= $middlename;?>">
                                                        </div>

                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Lastname</p>
                                                            <input type="text" class="form-control form-control" name="lastname" value="<?= $lastname;?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-12 col-12 mb-sm-0">
                                                            <p>Address</p>
                                                            <input type="text" class="form-control form-control" name="address" value="<?= $address;?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Age</p>
                                                            <input type="text" class="form-control form-control" name="age" value="<?= $age;?>">
                                                        </div>

                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Date of Birth</p>
                                                            <input type="date" class="form-control form-control" name="birthdate" value="<?= $birthdate;?>">
                                                        </div>

                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Place of Birth</p>
                                                            <input type="text" class="form-control form-control" name="birthplace" value="<?= $birthplace;?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Religion</p>
                                                            <input type="text" class="form-control form-control" name="religion" value="<?= $religion;?>">
                                                        </div>

                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Nationality</p>
                                                            <input type="text" class="form-control form-control" name="nationality" value="<?= $nationality;?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Civil Status</p>
                                                            <select name="civil_status" class="form-control" >
                                                                <option value="">-SELECT-</option>
                                                                <option value="SINGLE" <?= $civil_status == 'SINGLE'? 'selected' : ''?>>SINGLE</option>
                                                                <option value="MARRIED" <?= $civil_status == 'MARRIED'? 'selected' : ''?>>MARRIED</option>
                                                                <option value="DIVORCED" <?= $civil_status == 'DIVORCED'? 'selected' : ''?>>DIVORCED</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Name of Spouse</p>
                                                            <input type="text" class="form-control form-control" name="spouse" value="<?= $spouse;?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Telephone No.</p>
                                                            <input type="text" class="form-control form-control" name="tel_no" value="<?= $tel_no;?>">
                                                        </div>

                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Mobile No.</p>
                                                            <input type="text" class="form-control form-control" name="mobile_no" value="<?= $mobile_no;?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Home</p>
                                                            <input type="text" class="form-control form-control" name="home" value="<?= $home;?>">
                                                        </div>

                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Occupation</p>
                                                            <input type="text" class="form-control form-control" name="occupation" value="<?= $occupation;?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Name of Company</p>
                                                            <input type="text" class="form-control form-control" name="company" value="<?= $company;?>">
                                                        </div>

                                                        <div class="col-sm-6 col-12 mb-sm-0">
                                                            <p>Email Address</p>
                                                            <input type="email" class="form-control form-control" name="email" value="<?= $email;?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Name of Beneficiaries</p>
                                                            <input type="text" class="form-control form-control" name="beneficiaries1" value="<?= $beneficiaries1;?>">
                                                        </div>

                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Relationship</p>
                                                            <input type="text" class="form-control form-control" name="relationship1" value="<?= $relationship1;?>">
                                                        </div>

                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Age</p>
                                                            <input type="number" class="form-control form-control" name="age1" value="<?= $age1;?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Name of Beneficiaries</p>
                                                            <input type="text" class="form-control form-control" name="beneficiaries2" value="<?= $beneficiaries2;?>">
                                                        </div>

                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Relationship</p>
                                                            <input type="text" class="form-control form-control" name="relationship2" value="<?= $relationship2;?>">
                                                        </div>

                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Age</p>
                                                            <input type="number" class="form-control form-control" name="age2" value="<?= $age2;?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Name of Beneficiaries</p>
                                                            <input type="text" class="form-control form-control" name="beneficiaries3" value="<?= $beneficiaries3;?>">
                                                        </div>

                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Relationship</p>
                                                            <input type="text" class="form-control form-control" name="relationship3" value="<?= $relationship3;?>">
                                                        </div>

                                                        <div class="col-sm-4 col-12 mb-sm-0">
                                                            <p>Age</p>
                                                            <input type="number" class="form-control form-control" name="age3" value="<?= $age3;?>">
                                                        </div>
                                                    </div>

                                                    <hr>
                                                    <div class="form-group row">
                                                    <button type="submit" name="btn_save" class="btn btn-primary btn-user btn-block col-sm-6"> Save </button>
                                                    <hr>
                                                    <a href="view.php?id=<?= $_GET['grave_id']?>&type=<?= $_GET['type']?>" class="btn btn-google btn-user btn-block col-sm-6"> Cancel </a>
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
            

            <?php include'../footer.php';?>

    </div>
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
