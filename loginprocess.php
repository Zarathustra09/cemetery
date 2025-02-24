<?php
include 'connectMySql.php';
//check if may laman yung user at password
if (isset($_POST['LOGIN'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //alert error if wala laman yung dalawa
    if (empty($username) || empty($password)) {
        echo "<script src='js/sweetalert2.all.min.js'></script>
           <body onload='error()'></body>
           <script> 
           function error(){
           Swal.fire({
                icon: 'error',
                title: 'Login failed!'
           })
           }</script>";
        include 'index.php';
    } else {
        //check if meron sa table ng admin 
        $query = "SELECT * FROM admin WHERE username = '$username' AND  password = '$password'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                $user_id = $row['id'];
                session_start();
                $_SESSION['user_id'] = $user_id;
                header('location:admin/plot_grave');
            }
        }
        //check if meron sa table ng user    
        $query1 = "SELECT * FROM users WHERE username = '$username' AND  password = '$password'";
        $result1 = $conn->query($query1);
        if ($result1->num_rows > 0) 
        {
            while ($row1 = $result1->fetch_assoc()) 
            {
                $user_id = $row1['id'];
                session_start();
                $_SESSION['user_id'] = $user_id;
                header('location:user/reservation');
            }
        }


        echo "<script src='js/sweetalert2.all.min.js'></script>
           <body onload='error()'></body>
           <script> 
           function error(){
           Swal.fire({
                icon: 'error',
                title: 'Login failed!'
           })
           }</script>";
        include 'index.php';
    }
}
?>
