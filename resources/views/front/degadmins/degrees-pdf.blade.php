<!DOCTYPE html>
<html>
<head>
  <title>Cross tab pdf for degrees</title>
  <style>
      #stdTableData{
        font-size: 12px;
      }
  </style>
</head>
<body>
    
    <?php
        //dd($degreesPdfs);
         $html= '';
         $collegeName = $degreesPdfs[0]->name;


    ?>

   @if(count($degreesPdfs) > 0 )
        
            <table border="1" width="100%">
                <tr>
                    <td align="center"><h4>Proforma for Internal Evaluation <br>
                    {{ $collegeName }}</h4>
                    
                    </td>
                </tr>
            </table>    
        @foreach($degreesPdfs as $pdf)        
            <table border="1" width="100%" id="stdTableData">
                <tr>
                    <td width="10%">{{ $pdf->rollno }}</td>
                    <td width="20%">{{ $pdf->stdName }}</td>
                    <td width="20%">{{ $pdf->stdfName }}</td>
                    <td></td>
              
                   
                </tr>
            </table>
        @endforeach
    @endif    
            
</body>
</html>