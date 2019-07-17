@extends('layouts.student')

@section('page-title')
<title> Exam Portal | Student | Detailed Marks Certificate </title>
@endsection

@section('custom-css')
    <style>
        /* ==== Custom Styles Area ====*/
#invoice{
    padding: 30px;
}
#title-h3{
	font-size: 20px;
	font-weight: bold;
	letter-spacing: 1px;
	font-family: verdana;	
}
#title-h4{
	font-size: 16px;
	font-weight: bold;
	letter-spacing: 1px;
	font-family: verdana;
	margin-bottom: -10px;
}
.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left;
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 0;
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: left;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

#TblDmc tr td{
	height: 10px !important;
	padding: 5px !important;
}
.trRollNo td{
	background: #6897d1 !important;
	color: #fff !important;
}
@media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
    
  }
  #section-to-print {
  	
  	margin-left:  -170px !important;
    position: absolute;
    left: 0;
    top: 0;
    
  }

  .invoice header {

    border-bottom: 1px solid #000 !important;
}

  #title-h3{
  	font-size: 17px;
  }
  #title-h4{
  	font-size: 14px;
  }
  #TblDmc tr td{
  	font-weight: 600 !important;
  	color: #000 !important;
  }
  #TblDmc tr td a{
  	font-weight: 600 !important;
  	color: #000 !important;
  	text-decoration: none !important;
  }
 
  .no{
  	font-weight: 600 !important;
  	color: #000 !important;
  	font-size: 18px !important;
  }

  /* @page { size: auto;  margin: 0mm; } */
}

        
    </style>
@endsection

@section('main')

<?php //dd($dmcs);?>

	<div class="wrapper">   
    	<div class="page">
    		<div class="page-inner">
    			<div id="invoice" class="table-responsive">

			    <div class="toolbar hidden-print">
			        <div class="text-right">

			            <button id="printDateSheet" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                        <a href="{{ route('stddashboard') }}" class="btn btn-info" style="color: white;"><i class="fa fa-angle-double-left"></i> &nbsp;Back</a>
			            
			        </div>
			        <hr>
			    </div>
    <div class="invoice overflow-auto" id="section-to-print">
        <div style="min-width: 600px" >
            <header>
                <div class="row">
                    <div class="col-sm-3">
                        <img style="width: 120px;" src="{{asset('front/images/UOMlogo.png')}}" data-holder-rendered="true" />
                           
                    </div>
                    <div class="col-sm-5">
                    	
                    	<center><h3 id="title-h3">UNIVERSITY OF MALAKAND <br>
								 KHYBER PAKHTUNKHWA (PAKISTAN)<br>
							     Detailed Marks Certificate
                    	</h3></center>
                    	<center><h4 id="title-h4"></h4></center>
                    	
                    </div>
                    <div class="col-sm-4 company-details">
                        <?php 
                            if($students) {
                                foreach($students as $student)
                                {
                                    $photo  = $student->photo;

                                    $tempPath  = "public/front/images/amjadShahazad.jpg";

                                    if ($photo == $tempPath) {
                                
                                        $noimage = asset('front/images/no-image.png');

                                        echo "<img style='width: 120px; height: 100px;' src='$noimage' />";
                                    } 

                                    else{
                                        echo   "show original uploaded image";  
                                    } 
                                }
                            }      
                        ?>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                    		@if($students)
								@foreach($students as $student)
                        	<table border="0" cellspacing="0" cellpadding="0">
                        		<tr>
                        			<td><strong>Name : </strong> </td>
                        			<td><strong>{{ $student->stdName }}</strong></td>
                                   
                                    <td><strong>Father's Name : </strong> </td>
                                    <td><strong>{{ $student->stdfName }}</strong></td>
                                </tr>
                        	
                        		<tr>
                        			<td><strong>Registration No : </strong> </td>
                        			<td><strong>{{ $student->regno }}</strong></td>

                                    <td><strong>Session :  </strong> </td>
                                    <td><strong>{{ $student->session }}</strong></td>

                        		</tr>
                        		
                        		
                        		<tr>
                        			<td><strong>College : </strong> </td>
                        			<td colspan="4"><strong>{{ $student->CollegeName }}</strong></td>
                        		</tr>
                        	</table>
                            <center><h5>{{ $student->Det1 }}</h5></center>
                        	@endforeach
                        @endif

                        {{-- <h3 style="font-size: 18px;font-weight: bold;">Date Sheet </h3> --}}
                    </div>
                   
                </div>



                <table border="0" cellspacing="0" cellpadding="0" id="TblDmc">
                    <thead>
                        <tr>
                            <th><strong>Subjects</strong></th>
                            <th><strong>Cr.Hrs.</strong> </th>
                            <th><strong>Obt.Marks</strong></th>
                            <th><strong>Value</strong></th>
                            <th><strong>Status</strong></th>
                            <th><strong>GPE</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($dmcs) > 0)

                        <?php
             				$crdHoursSum = 0 ;
                        	$gpeSum = 0;
                        	$gpaEarned = 0;

                   
                        ?>
                            @foreach($dmcs as $dmc)
                                <tr>
                                    <td>{{ $dmc->Na }}</td>
                                    <td>{{ $dmc->hours }}</td>
                                    <td>{{ $dmc->obtTot }}</td>
                                    <td>{{ $dmc->GPA }}</td>
                                    
                                    
                                    <td>
                                        <?php
                                        $resStatus = $dmc->resStatus;
                                        ?>
                                        @if($resStatus == 1)
                                            {{ "PASSED" }}

                                            @else
                                            {{ "FAILED" }}

                                        @endif
                                    </td>
                                <?php
                                	$gpe =  $dmc->hours * $dmc->GPA;

                                	$crdHoursSum = $crdHoursSum + $dmc->hours;

                                	$gpeSum =$gpeSum+$gpe;

                                	

                                
                   
                                ?>    
                                <td> <span style="background: green;color:white;display: inline-block;height: 30px;width: 30px;padding: 5px;">{{ $gpeSum  }}</span>&nbsp;&nbsp;&nbsp;<span style="background: blue;color: white;display: inline-block;height: 30px;width: 30px;padding: 5px;">{{ $crdHoursSum }}</span></td>
                                </tr>
                            @endforeach 

                            <?php
                                $gpaEarned =  $gpeSum / $crdHoursSum;

                            ?>
                            <tr class="trRollNo">
                                <td colspan="6">Rollno  : {{ $dmcs[0]->rollno }}  <span style="background: green;">{{  round($gpaEarned,2) }}</span></td>
                            </tr>
                        @endif
                    	
                    </tbody>
                    </table>
                   
            </main>
            
        </div>
        
    </div>
</div>

				
			</div>
		</div>
	</div>

@endsection
@section('page-js-plugins')
    @include('backend.includes.components.scripts.dashboard-chart-component')
@endsection
@section('custom-js')
    <script>
        /* ==== Custom Scripts Area ====*/
        //  $('#printDateSheet').click(function(){
        //     Popup($('.invoice')[0].outerHTML);
        //     function Popup(data) 
        //     {
        //         window.print();
        //         return true;
        //     }
        // });

         document.querySelector("#printDateSheet").addEventListener("click", function() {
				window.print();
			});
    </script>
@endsection
