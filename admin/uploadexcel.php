<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
       <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
       <meta name='viewport' content='width=device-width'>
       <meta name="theme-color" content="#2196f3">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  </head>
  <style media="screen">
  .message
  {
  display: flex;
  justify-content: center;
  margin: 150px;
  }
  </style>
  <body class="grey darken-2">
    <?php
    session_start();
      require "connection.php";
      if(!isset($_SESSION['user']))
      {
          header("Location: /placement/loginpage.php");
      }
      else {
        echo $_SESSION['user'];


    require_once 'Spout/src/Spout/Autoloader/autoload.php';


    use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
    if (!empty($_FILES['file']['name'])) {

        $pathinfo = pathinfo($_FILES["file"]["name"]);


       if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls')
               && $_FILES['file']['size'] > 0 ) {
                 $targetPath = 'uploads/'.$_FILES['file']['name'];
                 move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

            $inputFileName = $_FILES['file']['tmp_name'];
    $reader = ReaderEntityFactory::createReaderFromFile($targetPath);
    $count = 1;
    $reader->open($targetPath);
    foreach ($reader->getSheetIterator() as $sheet) {
        foreach ($sheet->getRowIterator() as $row) {

            if ($count > 1) {
              $cells = $row->getCells();

    $cells = $row->getCells();




                $name = $cells[0]->getvalue();
                $usn = $cells[1]->getvalue();
               $company = $cells[2]->getvalue();
                $type = $cells[3]->getvalue();
               $salary = $cells[4]->getvalue();
                $year = $cells[5]->getvalue();


                $query = "insert into studentdata(NAME,USN,COMPANY,TYPE,SALARY,YEAR) values('".$name."','".$usn."','".$company."','".$type."','".$salary."','".$year."')";
                $result = mysqli_query($conn, $query);
    if($result){
      $message="Upload Completed";
    }
    else{
      $message="Upload Error!";
    }

            }
            $count++;
        }
        }
        $reader->close();
    }   else {
    $message="Please Select Valid Excel File";

      }}
     else {

      $message="Please Select Excel File";

    }

}
    ?>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
      <script>
        AOS.init();
      </script>
    <div class="message">

  <div class="card" data-aos="slide-down" data-aos-duration="500">
    <div class="card-content grey">
      <?php echo "<h4>".$message."</h4>"; ?><br><br>
      <a class="btn-large grey darken-2 waves-effect waves-dark modal-trigger" style="width:100%" href="admintable.php">Back</a>


  </div>
</div>

</div>

  </body>
</html>
