<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Final Student Form</title>
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    
	<style>
	#title-h3{
        font-size: 20px;
    }
	</style>
</head>
<body>

	@php

		//dd($forms);
	@endphp
	@if(count($forms) > 0)
    <table  class="table table-bordered">
        <tr>
            <td style="width: 10%;">
                <img class="" style="width: 90px;" class="img" src="{{asset('front/images/UOMlogo.png')}}" data-holder-rendered="true" />
            </td>
            <td style="width: 60%;">
                <center>
                    <h3 id="title-h3">UNIVERSITY OF MALAKAND <br>
                                 KHYBER PAKHTUNKHWA (PAKISTAN)<br>
                                 REGISTRATION FORM
                    </h3>
                </center>
            </td>
            <td style="width: 20%;">
                <?php 
                    $photo  = $forms[0]->photo;
                    $tempPath  = "public/front/images/amjadShahazad.jpg";
                    if ($photo == $tempPath) {                           
                        $noimage = asset('front/images/no-image.png');
                        echo "<img style='width: 120px; height: 100px;' src='$noimage' />";
                    } 
                    else{
                        $ProfilePhoto = $forms[0]->photo;
                       
                        echo "<img style='width: 120px;height: 100px;' src='$ProfilePhoto'>";
                      
                    } 
                         
                ?>
            </td>
        </tr>
    </table>
    <table class="table table-bordered">
        <tr>
            <td>College</td>
            <td>{{ $forms[0]->collegeName }}</td>
        </tr>
        <tr>
            <td>Degree</td>
            <td>{{ $forms[0]->Det1 }}</td>
        </tr>
        <tr>
            <td>Session</td>
            <td>{{ $forms[0]->session }}</td>
        </tr>
    </table>
     <table  class="table table-bordered">
        <tr>
            <td colspan="2"><h3 style="font-size: 18px;">Personal  Information</h3></td>
        </tr>
        <tr>
            <td width="30%;">Name of Candidate</td>
            <td>{{ $forms[0]->stdName }}</td>  
        </tr>
        <tr>
            <td>Father Name</td>
            <td>{{ $forms[0]->stdfName }}</td>  
        </tr>
        <tr>
            <td>Date of Birth</td>
            <td>{{ $forms[0]->dob }}</td>  
        </tr>
        <tr>
            <td>Domicile</td>
            <td>{{ $forms[0]->dom }}</td>  
        </tr>
        <tr>
            <td>Address</td>
            <td>{{ ucwords($forms[0]->address) }}</td>  
        </tr>
        <tr>
            <td>Phone No</td>
            <td>{{ $forms[0]->contact }}</td>  
        </tr>
    </table>
    <table  class="table table-bordered" style="width: 90%;">
        <tr>
            <td colspan="8"><h3 style="font-size: 18px;">Academic Information</h3></td>
        </tr>
        <tr>
            <th>Exam Passed</th>
            <th>Group</th>
            <th>Roll No</th>
            <th>Passing Year</th>
            <th>Marks Obtained</th>
            <th>Total Marks</th>
            <th>Institue / School</th>
            <th>Board / University</th>
        </tr>
        <tr>
            <td>
                @php 
                    $ssc   = $forms[0]->metric;
                    if ($ssc ==1) {
                       echo "SSC";
                    }
                @endphp
            </td>
            <td>{{ $forms[0]->metricGroup }}</td>
            <td>{{ $forms[0]->metricRollNo }}</td>
            <td>{{ $forms[0]->metricYear }}</td>
            <td>{{ $forms[0]->metricObtMarks }}</td>
            <td>{{ $forms[0]->metricTotMarks }}</td>
            <td>{{ $forms[0]->metricInstitute }}</td>
            <td>{{ $forms[0]->metricBoard }}</td>
        </tr>
        <tr>
            <td>
                @php 
                    $hssc   = $forms[0]->fsc;
                    if ($hssc == 2) {
                       echo "HSSC";
                    }
                @endphp
            </td>
            <td>{{ $forms[0]->fscGroup }}</td>
            <td>{{ $forms[0]->fscRollNo }}</td>
            <td>{{ $forms[0]->fscYear }}</td>
            <td>{{ $forms[0]->fscObtMarks }}</td>
            <td>{{ $forms[0]->fscTotMarks }}</td>
            <td>{{ $forms[0]->fscInstitute }}</td>
            <td>{{ $forms[0]->fscBoard }}</td>
        </tr>
        <tr>
            <td>
                @php 
                    $ba   = $forms[0]->bsc;
                    if ($ba == 4) {
                       echo "B.A";
                    }
                @endphp
                
            </td>
            <td>
                
                @php
                    $bscgroup   = $forms[0]->bscGroup;

                    if ($bscgroup == NULL OR $bscgroup == " ") {
                        echo " ";
                    }

                @endphp
            </td>
            <td>
                @php 

                $bscroll  = $forms[0]->bscRollNo;

                if ($bscroll == 0) {
                    echo " ";
                }else{
                    echo $bscroll;
                }


                @endphp
            </td>
            <td>
                @php
                    $bscyear = $forms[0]->bscYear;

                    if ($bscyear == 0) {
                        echo " ";
                    }else{
                        echo $bscyear;
                    }
                @endphp
            </td>
            <td>

                @php
                    $bscmarks = $forms[0]->bscObtMarks;
                    if ($bscmarks == 0) {
                        echo " ";
                    }else{
                        echo $bscmarks;
                    }
                @endphp
            </td>
            <td>
                @php    
                    $bsctotmarks = $forms[0]->bscTotMarks;
                    if ($bsctotmarks  == 0) {
                        echo " ";
                    }else{
                        echo $bsctotmarks;
                    }
                @endphp

            </td>
            <td>
                
                @php
                    $bscinstitute = $forms[0]->bscInstitute;

                    if ($bscinstitute == NULL OR  $bscinstitute == "") {
                        echo "";
                    }else{
                        echo $bscinstitute;
                    }

                @endphp
            </td>
            <td>
                @php

                $bscboard = $forms[0]->bscBoard;
                if ($bscboard == NULL OR  $bscboard == "") {
                        echo "";
                    }else{
                        echo $bscboard;
                    }
                @endphp
            </td>
        </tr>

     </table>


	@endif
</body>
</html>