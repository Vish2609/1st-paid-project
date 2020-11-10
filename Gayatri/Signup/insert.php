<?php
  $Firstname = $_POST['Firstname'];
  $Lastname = $_POST['Lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cp = $_POST['cp'];
  $dob = $_POST['dob'];
  $sex = $_POST['sex'];

  if (!empty($Firstname) || !empty($Lastname) || !empty($email) || !empty($password) || !empty($cp) ||
   !empty($dob) || !empty($sex)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "reg.db";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if (mysqli_connect_error()) {
      die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_errno());
    } else {
      $SELECT = "SELECT email From register Where email = ? Limit 1";
      $INSERT = "INSERT Into register (Firstname,Lastname,email,password,cp,dob,sex) values(?,?,?,?,?,?,?)";

      $stmt = $conn->prepare($SELECT);
      $stmt->bind_param("s",$email);
      $stmt->execute();
      $stmt->bind_result($email);
      $stmt->store_result();
      $rnum = $stmt->num_rows;

      if ($rnum==0) {
        $stmt->close();

        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sssssis",$Firstname,$Lastname,$email,$password,$cp,$dob,$sex);
        $stmt->execute();
        echo "New record inserted successfully. :)";
      } else {
        echo "Someone already entered usinng same E-mail. :(";
      }
    }
  } else {
    echo "All field are required!!!";
    die();
  }
?>
