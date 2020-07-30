<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <meta name='viewport' content='width=device-width'>
    <meta name="theme-color" content="#2196f3">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>

      .login
      {
      margin-top:160px;
      }
      .res
      {
        display: flex;
        justify-content: center;
        align-items: center;
        color: #ff0000;
      }
      .res1
      {
        display: flex;
        justify-content: center;
        align-items: center;
        color: #09972A;
      }


    </style>

  </head>
  <body class="blue lighten-3">
    <form class="" action="logout.php" method="post" data-aos="slide-down" data-aos-duration="500">
      <button type="submit" action="logout.php" class="btn-large blue waves-effect waves-dark" style="width:100%">Logout</button>
    </form>


    <div class="row login">
      <div class="col s12 m4 offset-m4">
        <div class="card" data-aos="zoom-in-up" data-aos-duration="1000">
          <div class="card-action blue white-text" >
            <h3>Insert Registration Data</h3>
            </div>
            <div class="card-content" data-aos="fade-down" data-aos-duration="1500">
              <form class="" action="" method="post">


              <div class="form-field">
                <label for="username">Year</label>
                <input type="text" name="year" id="year">

              </div><br>
              <div class="form-field">
                <label for="password">Number of Students</label>
                <input type="text" name="ns" id="ns">

              </div><br>
              <div class="form-field">
                <button type="submit" class="btn-large blue waves-effect waves-dark"  style="width:100%" name="button">Insert</button>

              </div><br>



            </div>
            </div>

    </div>


      </div>



      <?php
      session_start();
        require "connection.php";
        if(!isset($_SESSION['user']))
        {
            header("Location: /placement/loginpage.php");
        }
        else {




      $year=$_POST['year'];
      $ns=$_POST['ns'];
$msg="";
$cnt=0;
if(!empty($year)){


      $sql_query="insert into registable(year,number) values('".$year."','".$ns."')";
      $res=mysqli_query($conn,$sql_query);
      if($res)
      {
        $msg= "Upload Successful";
      }

          else {


            $msg="Upload Failed";

          }
        }}
            ?>


            <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
              <script>
                AOS.init();
              </script>

       <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      </body>
      <script type="text/javascript">

          M.toast({html: 'Enter values!'})
           M.AutoInit();

      </script>
      <div id="response" class="res">
        <?php if(!empty($msg)) {
          if($msg=="Upload Failed"){echo $msg;} } ?>
      </div>
      <div id="response2" class="res1">
        <?php if(!empty($msg)) {
          if($msg=="Upload Successful"){echo $msg;} } ?>
      </div>



      </html>
