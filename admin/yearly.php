<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <meta name='viewport' content='width=device-width'>
    <meta name="theme-color" content="#2196f3">
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

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

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
@import url(https://fonts.googleapis.com/css?family=Roboto);

body {
  font-family: Roboto, sans-serif;
}

#chart {
  max-width: 1000px;
  margin: 35px auto;
}

.input_field{
  margin: 20px;
}
.buttonyo{
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
    <nav class="navbar navbar-expand-lg navbar-light"  style="background-color:#90caf9 ;">



      <a class="navbar-brand" href="#">Placement Statistics</a>



        <ul class="navbar-nav mr-auto">

          <li class="nav-item">
            <a class="nav-link" href="admintable.php">Placement Data</a>

          </li>


              </ul>
  <form class="form-inline my-2 my-lg-0" action="logout.php" method="post">
  <button type="submit" action="logout.php" class="btn btn-outline-primary">Logout</button>
  </form>



      </div>
    </nav>

<div class="main_wrapper" >
  <div class="input_field">
  Search:  <input name="search" id="search" type="text"></input>

  </div>


<div class="table_wrapper" style="margin:20px;overflow-x:auto;" >
     <table class="table table-striped table-bordered display responsive nowrap table-bordered" style="width:100%;" id="datt" data-order='[[ 1, "asc" ]]'>
       <thead>
       <tr>
         <th>Year</th>
         <th>Number of unique Placements</th>
         <th>Total number of placements</th>
         <th>Registered Students</th>
         <th>Percentage </th>



         <thead>
</tr>
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
$distinctyearquery="select distinct YEAR from studentdata;";
$distinctyearresult=mysqli_query($conn,$distinctyearquery);

$result=mysqli_query($conn,$sql_query);

while($row=mysqli_fetch_assoc($result))
{
  while ($yearrow=mysqli_fetch_assoc($distinctyearresult)) {

  $yeardat=$yearrow['YEAR'];
  $query1="select distinct USN from studentdata where YEAR='$yeardat';";
  $query2="select * from studentdata where YEAR='$yeardat';";
  $query3="select * from registable where year='$yeardat';";
  $count=mysqli_query($conn,$query1);
  $count2=mysqli_query($conn,$query2);
  $per4=mysqli_query($conn,$query3);

  $a=mysqli_num_rows($count);
  $b=mysqli_num_rows($count2);

if(mysqli_num_rows($per4)==0){
  $mno = "-";
  $pqr = "-";
}
else{
    while($row1=mysqli_fetch_assoc($per4)){
      $k=$row1['number'];
      if (is_null($k))
      {
        $mno = "-";
        $pqr = "-";
      }
      else {
        $mno= $k;
        $pqr = ($b/$k) *100;
      }


  }
}



  echo "<tr>";
  echo "<td>".$yearrow['YEAR']."</td>";
  echo "<td>".$a."</td>";
  echo "<td>".$b."</td>";
  echo "<td>".$mno."</td>";
  echo "<td>".$pqr."</td>";

  echo "</tr>";
}

}
}
      ?>
    </tbody>

    <tfoot>
 <tr>
   <th>Year</th>
   <th>Number of unique Placements</th>
   <th>Total number of placements</th>
   <th>Registered Students</th>
   <th>Percentage </th>

 </tr>
</tfoot>
    </table>

</div>
<div class="buttonyo">
  <a class="btn btn-primary" href="insertreg.php" role="button">Enter Registered Students</a>

</div>
<div id="chart">

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


      const dataArray = [],
         year = [],
         unique = [],
         total = [];

       // loop table rows
       table.rows({ search: "applied" }).every(function() {
         const data = this.data();
         year.push(data[0]);
         unique.push(parseInt(data[1].replace(/\,/g, "")));
         total.push(parseInt(data[2].replace(/\,/g, "")));
       });

 dataArray.push(year, unique, total);

var options = {
  chart: {
    height: 350,
    type: "line",
    stacked: false
  },
  dataLabels: {
    enabled: false
  },
  colors: ["#FF1654", "#247BA0"],
  series: [
    {
      name: "Unique Placements",
      data: dataArray[1]
    },
    {
      name: "Total Placements",
      data: dataArray[2]
    }
  ],
  stroke: {
    width: [4, 4]
  },
  plotOptions: {
    bar: {
      columnWidth: "20%"
    }
  },
  xaxis: {
    categories: dataArray[0]
  },
  yaxis: [
    {
      axisTicks: {
        show: true
      },
      axisBorder: {
        show: true,
        color: "#FF1654"
      },
      labels: {
        style: {
          color: "#FF1654"
        }
      },
      title: {
        text: "Series A"
      }
    },
    {
      opposite: true,
      axisTicks: {
        show: true
      },
      axisBorder: {
        show: true,
        color: "#247BA0"
      },
      labels: {
        style: {
          color: "#247BA0"
        }
      },
      title: {
        text: "Series B"
      }
    }
  ],
  tooltip: {
    shared: false,
    intersect: true,
    x: {
      show: false
    }
  },
  legend: {
    horizontalAlign: "left",
    offsetX: 40
  }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();
} );
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
<script type="text/javascript">


</script>
  </body>
</html>
