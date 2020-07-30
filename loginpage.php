<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

<meta name='viewport' content='width=device-width'>
  <meta name="theme-color" content="#2196f3">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>

      .login
      {
      margin-top:130px;
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
      .res2
      {
        display: flex;
        justify-content: center;
        align-items: center;
        color: #ff0000;
      }

    </style>

  </head>
  <body class="blue lighten-3">



    <div class="row login">
      <div class="col s12 m4 offset-m4">
        <div class="card" data-aos="zoom-in-up" data-aos-duration="1000">
          <div class="card-action blue white-text">
            <h3>Login</h3>
            </div>
            <div class="card-content" data-aos="fade-down" data-aos-duration="1500">
              <form class="" action="" method="post">


              <div class="form-field">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">

              </div><br>
              <div class="form-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">

              </div><br>
              <div class="form-field">
                <button type="submit" class="btn-large blue waves-effect waves-dark"  style="width:100%" name="button">Login</button>

              </div><br>
              <a class="btn-large blue waves-effect waves-dark modal-trigger" style="width:100%" href="#modal1">Change Password</a>

</form>

            </div>
            </div>

    </div>


      </div>


      <div id="modal1" class="modal green lighten-4">
   <div class="modal-content">

       <h5 class="green-text">Change Password</h5><br><br>

           <form class="" action="" method="post">


           <div class="form-field">
             <label for="username">Username</label>
             <input type="text" name="username22" id="username22">

             <div class="form-field">
               <label for="password">Enter current password</label>
               <input type="password" name="curpassword" id="curpassword">
           </div><br>

           <div class="form-field">
             <label for="password">Enter New Password</label>
             <input type="password" name="passwordone" id="passwordone">

           </div><br>
           <div class="form-field">
             <label for="password">Re-enter Password</label>
             <input type="password" name="password22" id="password22">

           </div><br>
           <div class="form-field">
             <button type="submit" class="btn-large green waves-effect waves-dark"  style="width:100%" name="button">Change Password</button>

           </div><br>

</form>
         </div>
   </div>

 </div>
      <?php

      require 'connection.php';

session_start();

      $username=$_POST['username'];
      $password=$_POST['password'];
$msg="";
$cnt=0;
if(!empty($username)){
      $sql_query="select * from logindata where username='$username' and password='$password';";
      $res=mysqli_query($conn,$sql_query);
      if(mysqli_num_rows($res)>0)
      {
          while ($row=mysqli_fetch_assoc($res)) {
            if($row['id']=="1")

            {
              header("Location: admin/admintable.php");

              $_SESSION['user']=$username;
            }
           if($row['id']=="2")
            {

              $_SESSION['user']=$username;
              header("Location: hod/hodtable.php");
            }
}}
          else {


            $msg="Incorrect username or password";

          }
        }
            ?>


            <?php

            require 'connection.php';


            $curpassword=$_POST['curpassword'];
            $usernamech=$_POST['username22'];
            $passwordch=$_POST['password22'];
            $passwordch1=$_POST['passwordone'];
            $mes="";
      $msgch="";
      $cnt=0;
      if(!empty($usernamech) && !empty($passwordch) && !empty($passwordch1) && !empty($curpassword)){
          if ($passwordch!=$passwordch1) {
            $msgch="Passwords are not same";
          }
            $sql_query="select * from logindata where username='$usernamech' and password='$curpassword';";
            $res=mysqli_query($conn,$sql_query);
            if(mysqli_num_rows($res)>0)
            {
                while ($row=mysqli_fetch_assoc($res)) {
                  if($row['id']=="1")
                  {
                    $qr="update logindata set password='$passwordch1' where id=1;";
                    $re=mysqli_query($conn,$qr);
                    if($re)
                    {
                      $mes="Password updated (admin)";
                    }
                    else {
                      $msgch="error";
                    }


                  }
                  else if($row['id']=="2")
                  {
                    $qre="update logindata set password='$passwordch1' where id=2;";
                    $ree=mysqli_query($conn,$qr);
                    if($ree)
                    {
                      $mes="Password updated (HOD)";
                    }
                    else {
                      $msgch="error";

                    }

                  }
                  else {
                    if ($mes=="Password updated (admin)" || $mes=="Password updated (HOD)" ) {
                      $msgch="";
                    }
                    else {

                        $msgch="username or current password error!";
                    }

                  }
                }
              }
              else{


                    $msgch="username or current password error!";
                }
              }
                else {


                //  $msgch="Empty username or password";

                }

                  ?>
                  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
                    <script>
                      AOS.init();
                    </script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      </body>
      <script type="text/javascript">

          M.toast({html: 'Enter username and password!'})
           M.AutoInit();

      </script>
      <div id="response" class="res">
        <?php if(!empty($msg)) { echo $msg; } ?>
      </div>
      <div id="response1" class="res1">
        <?php if(!empty($mes)) { echo $mes;
      $curpassword=""; } ?>
      </div>
      <div id="response2" class="res2">
        <?php if(!empty($msgch)) { echo $msgch;

         } ?>
      </div>

      </html>
