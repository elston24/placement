

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" content='width=device-width'>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<meta name='viewport' content='width=device-width'>
<meta name="theme-color" content="#2196f3">

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

</script>


<style media="screen">
.input_field{
  margin: 20px;
}

  .table_wrapper{


           margin: 10px;


  }
  .table{

      text-align: center;
      margin-left: auto;
      margin-right: auto;


  }
  tr,td,th{
    text-align: center;
  }


</style>


  </head>
  <body >

    <nav class="navbar navbar-expand-lg navbar-light" data-aos="slide-down" data-aos-duration="500" style="background-color:#90caf9 ;">



      <a class="navbar-brand" href="#">Placement data</a>



        <ul class="navbar-nav mr-auto">

          <li class="nav-item">
            <a class="nav-link" href="yearly.php">Placement Statistics</a>

          </li>


              </ul>
<form class="form-inline my-2 my-lg-0" action="logout.php" method="post">
  <button type="submit" action="logout.php" class="btn btn-outline-primary">Logout</button>
</form>
      </div>
    </nav>
<div class="main_wrapper" data-aos="fade-up" data-aos-duration="2000">
  <div class="input_field">
  Search:  <input name="search" id="search" type="text"></input>

  </div>


<div class="table_wrapper" style="margin:20px;overflow-x:auto;" >




     <table class="table table-striped table-bordered display responsive nowrap table-bordered" style="width:100%;" id="datt" data-order='[[ 1, "asc" ]]' >
       <thead>
       <tr >
         <th>Name</th>
         <th>USN</th>
         <th>Company</th>
         <th>Type</th>
         <th>Salary</th>
         <th>Year</th>

</tr>
</thead>

<tbody>


      <?php
      session_start();
        require "connection.php";
        if(!isset($_SESSION['user']))
        {
            header("Location: /placement/loginpage.php");
        }
        else {




$sql_query="select * from studentdata;";


$result=mysqli_query($conn,$sql_query);

while($row=mysqli_fetch_assoc($result))
{
  echo "<tr>";
  echo "<td>".$row['NAME']."</td>";
  echo "<td>".$row['USN']."</td>";
  echo "<td>".$row['COMPANY']."</td>";
  echo "<td>".$row['TYPE']."</td>";
  echo "<td>".$row['SALARY']."</td>";
  echo "<td>".$row['YEAR']."</td>";
  echo "</tr>";
}

  }

      ?>
      </tbody>
      <tfoot>
   <tr>
     <th>Name</th>
     <th>USN</th>
     <th>Company</th>
     <th>Type</th>
     <th>Salary</th>
     <th>Year</th>
   </tr>
 </tfoot>
    </table>
  </div>
  </div>
  <script type="text/javascript">
  $(document).ready(function() {
  var table=$('#datt').DataTable({
        escapeRegex:true,
        searching: true,
        sDom: 'lBrtip',
        buttons: [
          [{
                extend: 'pdf',
                title: 'Placement Data',
                text:'Download PDF',
                filename: 'placement_data_pdf'
              },{
                    extend: 'pdf',
                    title: 'Placement Data [Filtered]',
                    text:'Download Filtered PDF',
                    filename: 'placement_data_pdf_filtered',
                    exportOptions:{
                      modifier:{
                        page:'current'
                      }
                    }
                  },
            {
              extend:'print',
              title:'Placement Data',
              text:'Print Table'

            }]
          ],
          initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },





        });

        $('#search').on( 'keyup', function () {
        table.search( this.value,true,false ).draw();
        } );
  } );




  </script>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>
