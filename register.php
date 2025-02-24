<?php
if(isset($_GET['register'])){
    echo "<script src='js/sweetalert2.all.min.js'></script>
    <body onload='success()'></body>
    <script> 
    function success(){
    Swal.fire({
         icon: 'success',
         title: 'Save Successfully!'
    })
    }</script>";
}


    if(isset($_POST['btn_save']))
    {
            include('connectMySql.php');
            $username = $_POST['username'];
            $password = $_POST['password'];
            $firstname = $_POST['firstname'];
            $middlename = $_POST['middlename'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $contact_number = $_POST['contact_number'];
            $birthdate = $_POST['birthdate'];
            $status = 'ACTIVE';

            $sql = "INSERT INTO users (
                        username,
                        password,
                        firstname,
                        middlename,
                        lastname,
                        email,
                        contact_number,
                        birthdate,
                        status
                                        ) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssss",
                        $username,
                        $password,
                        $firstname,
                        $middlename,
                        $lastname,
                        $email,
                        $contact_number,
                        $birthdate,
                        $status);
            $stmt->execute();
            header('location:register.php?register=1');
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
    <link rel="icon" type="image/x-icon" href="img/logo.jpg" />   

    <title>Biñan City Cemetery</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background-color: #73A580;">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Personal Information</h1>
                            </div>
                            <form  method="post" enctype="multipart/form-data" class="user">
                            <div class="row">
                            <div class="form-group col-6">
                                        <label>Username: </label>
                                        <input type="text" id="username" name="username" class="form-control"  required/>
                                    </div>

                                    <div class="form-group col-6">
                                        <label>Password : </label>
                                        <input type="password" id="password" name="password" class="form-control"  required/>
                                    </div>

                                    <div class="form-group col-4">
                                        <label>Firstname: </label>
                                        <input type="text" id="firstname" name="firstname" class="form-control"  required/>
                                    </div>

                                    <div class="form-group col-4">
                                        <label>Middlename: </label>
                                        <input type="text" id="middlename" name="middlename" class="form-control"  required/>
                                    </div>

                                    <div class="form-group col-4">
                                        <label>Lastname: </label>
                                        <input type="text" id="lastname" name="lastname" class="form-control"  required/>
                                    </div>


                                    <div class="form-group col-6">
                                        <label>Email: </label>
                                        <input type="email" id="email" name="email" class="form-control"  required/>
                                    </div>

                                    <div class="form-group col-6">
                                        <label>Contact Number: </label>
                                        <input type="text" id="contact_number" name="contact_number" class="form-control"  required/>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>Date of Birth: </label>
                                        <input type="date" id="birthdate" name="birthdate" class="form-control"  required/>
                                    </div>
                            </div>

                                <hr>
                                <div class="form-group row">
                                    <button name="btn_save" type="submit" class="btn btn-primary btn-user btn-block">
                                        Register Account
                                    </button>
                                </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="index.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>