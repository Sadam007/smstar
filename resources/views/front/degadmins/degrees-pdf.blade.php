<!DOCTYPE html>
<html>
<head>
  <title>
    @php
      $Det1 = $degrees[0]->Det1;
      if (!empty($Det1)) {
       echo $Det1;
      }
    @endphp
  </title>
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">

<link rel="stylesheet" href="{{ asset('backend/css/main.min.css')}}">
  <style type="text/css">
  body{
    background-color: #fff;
  }
      @page { margin: 180px 50px; }
    #header { position: fixed; left: 0px; top: -10px; right: 0px; background-color: #fff; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -10px; right: 0px; height: 100px;background-color: #fff; }
    #footer .page:after { content: counter(page, upper-roman); }
    #content{
      background-color: #fff;
    }
      .stdTableData{
        font-size: 10px;
       table-layout: fixed;
       border-collapse: collapse;
       width: 90%;
       border-bottom: 0px !important;
       background-color: #fff;
       border: 1px solid black;
      }
      
      
        th.rotate {
        height: 150px;
        white-space: nowrap;
        vertical-align: middle;
        border-top: 1px solid black !important;
        border-bottom: 1px solid black !important;
        width: 1cm;
       
          
      }

      th.rotate > div {
        transform: 
          translate(30px, 51px)
          rotate(-90deg);
        width: 20px;
      margin-top: -50px;
      text-align: center;


      }
      th.rotate > div > span {
        /*border-bottom: 1px solid #ccc;*/
       
      }
      .stdTableData td{
        padding: 5px;
      }


      .visb{

        visibility: hidden;
      }
    
  </style>
</head>
<body>
  <?php
   //dd($all_records);
if (count($all_records) > 0) {
  echo " <div id='header'>";
foreach ($all_records as $record) {
  echo "<center><h5 style='margin-top:10px;'>Proforma for Internal Evaluation </h5>";
    echo "<h5>".$record['students']->name."</h5></center>";
    foreach ($record['rollnos'] as $rollno) {
          echo "<center><h5>".$rollno->P_name."</h5></center>";
          break;
        }
        break;
  }
    
  echo "<table border='2' class='stdTableData' align='center' >";
  foreach ($all_records as $record) {
   

     echo "<tr>\n";
      echo "<td class='visb'>3</td>";
      echo "<td class='visb'>3</td>";
      echo "<td class='visb' style='border:0 !important;'>3</td>";

     foreach ($record['rollnos'] as $rollno) {
      
      $outerNa =  $rollno->Na;
      $outerhours =  $rollno->hours;
      $innerOneRTwo  = $rollno->OneRTwo;
      if ($innerOneRTwo == 1) {
        
      echo "\t<th class='rotate' align='center;'><div>".wordwrap($outerNa,20,'<br>')."</div></th>";

     }
     }
  echo "</tr>";

         break;
   }

   foreach ($all_records as $record) {

     echo "<tr>\n";
      echo "<td class='visb' style='border:0;'></td>";
      echo "<td class='visb' style='border:0;'></td>";
      echo "<td style = 'font-weight:bold;text-align:right;border: 0 !important; border-bottom:0px'>Credit Hours</td>";

     foreach ($record['rollnos'] as $rollno) {
      
  
      $outerhours =  $rollno->hours;
      $innerOneRTwo  = $rollno->OneRTwo;
      if ($innerOneRTwo == 1) {
        
      echo "\t<th style='border-bottom: 1px solid black !important; text-align:center;'>".$outerhours."</th>";

     }
     }
  echo "</tr>";

         break;
   }
 foreach ($all_records as $record) {

     echo "<tr>\n";
      echo "<td class='visb' style='border:0;'></td>";
      echo "<td class='visb' style='border:0;'></td>";
      echo "<td style = 'font-weight:bold;text-align:right;border: 0 !important; border-bottom:0px'>Total Marks</td>";

     foreach ($record['rollnos'] as $rollno) {
      
  
      $outerhours =  $rollno->hours;
      $innerOneRTwo  = $rollno->OneRTwo;
      if ($innerOneRTwo == 1) {
        
      echo "\t<th style='border-bottom: 1px solid black !important; text-align:center;'>40</th>";

     }
     }
  echo "</tr>";

         break;
   }

   
echo "</table>";
 echo "</div>"; 
 echo "<div id='footer'>
    <table class='table' style='background-color:#fff;'>
  <tr>
    <td width='33.3%'>
      <hr style='border-width: 1px; border-color: rgba(0,0,0,0.50);'>
      <center><p>Semester Coordinator</p></center>
    </td>
    <td width='33.4%'>
      <hr style='border-width: 1px; border-color: rgba(0,0,0,0.50);'>
      <center><p>Controller of Examination (College)</p></center>
    </td>
    <td width='33.3%'>
      <hr style='border-width: 1px; border-color: rgba(0,0,0,0.50);'>
      <center><p>Principal</p></center>
    </td>
  </tr>
</table>
  </div>";


echo "<div id='content'>";

echo "<table border='2' class='stdTableData' align='center' style='margin-top:248px;padding-bottom:120px;'>";
 foreach ($all_records as $record) {
    
    $outerreg = $record['students']->regno;

      echo "<tr>\n";
      echo "<td'>".$record['students']->regno."</td>";
      echo "<td>".$record['students']->stdName."</td>";
      echo "<td>".$record['students']->stdfName."</td>";

    foreach ($record['rollnos'] as $rollno) {
      
      $innerreg    = $rollno->regno;
      $innerobt40  = $rollno->obt40;
      $innerOneRTwo  = $rollno->OneRTwo;
     if ($innerOneRTwo == 1) {
        
      echo "\t<td style='text-align:center;'>".$innerobt40."</td>";
     }

  
    }
   echo "</tr>\n";
    //echo "<pre>";
    //print_r($record);
    //echo "</pre>";
  }

echo "</table>";
echo "</div>";
}


 else{
  echo "No Record found";
 }
 ?>           
</body>
</html>



