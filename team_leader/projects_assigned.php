<?php

include 'connection.php';

session_start();
  $reg=$_SESSION['reg_number'];
  $name=$_SESSION['name'] ;
  $email=$_SESSION['email_name'];
  $id=$_SESSION['team_id'];
  if(!isset($_SESSION['email_name']))
  {
    echo "<script>window.location='../users_login.php'</script>";
  }else


  $sql = "SELECT team_id FROM member WHERE m_email='$email'  AND status='leader'  AND reg_number='$reg'";
  $result = mysqli_query($conn, $sql);
  
  
  while($row=mysqli_fetch_array($result))
  {
    $team_id=$row['team_id'];
    
  
  }
  



  
$sql = "SELECT m_fname FROM member WHERE m_email='$email'  AND status='leader'  AND reg_number='$reg'";
$result = mysqli_query($conn, $sql);


while($row=mysqli_fetch_array($result))
{
  $namex=$row['m_fname'];
  

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>project asign</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

  <?php
  include 'headerx.php';
    ?>

  </header><!-- End Header -->
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <?php
include 'L_side_menu.php';
  ?>
</aside><!-- End Sidebar-->

  <main id="main" class="main">
    <section class="section">
        <div class="row">
         
         
                <!-- Table with stripped rows -->

                 
               

                  <?php
                    include 'connection.php';
	
                    $sql = "SELECT title,decription,duration,start_date,end_date,status,p_id FROM project where team_id='$id' ";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = mysqli_fetch_array($result)) {
                       // echo "id: " . $row["id"]. " - Name: " . $row["reg_number"]. " " . $row["1"]. "<br>";
                       ?>        
                        <div class="col-lg-6">
                            <!-- Card with an image on top -->
                            <div class="card" style='padding:0.7cm'>
                              <img src="../assets/img/p.jpg" class="card-img-top" alt="..."><br>
                              <div class="card-body">
                              <h5 class="">TITLE: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $row['title'] ?><br>
                          <h5 class="">DESCRIPTION &nbsp;&nbsp;&nbsp; <br><br>
                         <p  style="margin-left:1cm"> <?php  echo $row['decription'] ?></p><br>
                          <h5 class="">DURATION:&nbsp;&nbsp; <?php  echo $row['duration'] ?><br>
                          <h5 class="">STATUS: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $row['status'] ?><br>
                          <h5 class="">START DATE: &nbsp;<?php  echo $row['start_date'] ?><br>
                          <h5 class="">END DATE: &nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $row['end_date'] ?></h5>

                                <a href="projects_view.php?p_id=<?php echo $row["6"]?> "> 
                               <br> <button type="submit" class="btn btn-primary btn-md col-12 col-md-12 col-sm-12 col-lg-12 col-sx-12" name='go'>VIEW PROJECT</button></a>
                             
                             
                              </div>
                              
                            </div><!-- End Card with an image on top -->

                            <!-- Card with an image on bottom -->


                            </div>
                              
                             <!-- Card with an image on bottom -->          
                       <?php
                      }
                    } else {
                      echo "0 results";
                    }
                  ?>
                 
               
              

        </div>
      </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
include 'footer.php';

?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

  <?php
include 'connection.php';

@$go=$_POST["go"];
@$link=$_POST["link"];
@$com=$_POST["com"];


if(isset($go))
{
  //echo '<script>alert("Welcome to Geeks for Geeks")</script>';

    $sql = "INSERT INTO `project_feedback` (`f_id`, `team_id`, `host_link`, `comment`, `feedback`) 
    VALUES (NULL, '$id', '$link', '$com', '');";

    if (mysqli_query($conn, $sql)) {
      echo '<script>alert("Well inserted")</script>';
      echo "<script>window.location='./index.php'</script>";

      
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>


 

</body>

</html>