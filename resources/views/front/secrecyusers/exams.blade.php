@extends('layouts.secrecy')

@section('page-title')
<title> Exam Portal | Secrecy Users Dashboard </title>
@endsection

@section('theme-css-plugins')

<link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('front/css/animate.min.css') }}">
@endsection
@section('custom-css')
<style>

.card{
  height: 300px;
  overflow-y: scroll;
}
.list-unstyled li {
 font-size: 12px;
 line-height: 30px;
}
#step-2{
 transition:  all .5s ease;
}

.animatedd {
 animation-duration: 1s;
}


.empty-box{
 width: 18rem;
 height: 300px;
 background: #F5F5F5;

}



.task-title,.metric-label{
  text-transform: uppercase;
  font-weight: bold;
  font-size: 12px;
  letter-spacing: .5px;
  color: #000;
}
.fa-size{
  font-size: 20px;
  padding: 5px;
  color: #2E5F9B;
}
.cus-card{
  background: white;
}
.mgt{
  margin: 5px auto;
  font-weight: bolder;
  color: red !important;
}
.step2list li:first-child,.step3List li:first-child{
  margin-top: 10px !important;
}
.cus-active{
  background: #346cb0;
  padding: 5px;
  color: white;
}

.cus-active:hover{
  color:white !important;
  text-decoration: none;
}
.step2list , .step3List {
  min-width: 130% !important;
}

.step3List{
  width: auto !important;
  min-width: 230% !important;
  max-width: 300% !important;

}

.circle{
  width: 25px !important;
  height: 25px !important;
  border-radius: 50% !important;
  padding-top: 5px !important;
  line-height: 15px !important;

}

.badge-success{
  background: #063 !important;

}

.format-txt{
  font: 14px;
  color: blue;
}

/* #loading{
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  background-color: rgba(0,0,0,.5);
  -webkit-transition: all .5s ease;
  z-index: 1000;
  display:none;
} */

/* .custom-checkbox{
  margin-top: 10px !important;
  height: 16px !important;
  width: 16px !important;
  background: red !important;
}  */
.checkbox {
  width: 100%;
  margin: 15px auto;
  position: relative;
  display: block;
}
.checkbox label {
  position: relative;
  min-height: 25px;
  display: block;
  padding-left: 24px;
  margin-bottom: 0;
  font-weight: normal;
  cursor: pointer;
}
.checkbox label span {
  position: absolute;
  top: 30%;
  transform: translateY(-50%);
}
.checkbox label:before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  width: 16px;
  height: 16px;
  transition: transform 0.28s ease;
  border-radius: 3px;
  border: 2px solid #E0055D;
}
.checkbox label:after {
  content: '';
  display: block;
  width: 10px;
  height: 5px;
  border-bottom: 2px solid #E0055D;
  border-left: 2px solid #E0055D;
  transform: rotate(-45deg) scale(0);
  position: absolute;
  top: 5px;
  left: 3px;
}
.checkbox input[type="checkbox"] {
  width: auto;
  opacity: 0.00000001;
  position: absolute;
  left: 0;
  margin-left: -20px;
}
.checkbox input[type="checkbox"]:checked ~ label:before {
  border: 2px solid #E0055D;
}
.checkbox input[type="checkbox"]:checked ~ label:after {
  transform: rotate(-45deg) scale(1);
}
.checkbox input[type="checkbox"]:focus + label::before {
  outline: 0;
}


</style>
@endsection

@section('main')
<div class="wrapper">   
  <div class="page">

   <div class="page-inner">
    <header class="page-title-bar">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">
            <a href="{{ route('secdashboard') }}">
              <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Dashboard</a>
            </li>
          </ol>
        </nav>
      </header>
      <div class="page-section">
        <div class="section-block">
          <div class="board">
            <section class="tasks" id="step-0">
              <header class="task-header">
                <h3 class="task-title mr-auto"> Examcodes</h3>
                <div class="dropdown">
                  <button class="btn btn-reset text-muted">
                    <i class="fa fa-ellipsis-v"></i>
                  </button>
                </div>
              </header>
              <div class="task-issue">
                <div class="card">

                  <div class="card-body pt-2">
                    <select class="custom-select" id="step-1" required="" name="step-1">
                      <option value="0"> Choose... </option>
                      @if(count($exams) > 0)
                      @foreach($exams as $exam) 
                      <option value="{{ $exam->examcode }}" title="{{ $exam->description }}">{{ $exam->examcode }}
                      </option>

                      @endforeach
                      @endif
                    </select>

                    <div id="loader"></div>
                  </div>


                </div>
              </div>

            </section>
            <section class="tasks task-width" id="step-2">
              <header class="task-header">
                <h3 class="task-title mr-auto"> Degrees</h3>
                <div class="dropdown">

                  <button class="btn btn-reset text-muted">
                    <i class="fa fa-ellipsis-v"></i>
                  </button>
                  
                </div>
              </header>
              <div class="task-issue">
                <div class="card">

                  <div class="card-body pt-2">
                    <input type="text" class="form-control" id="step2Search" style="display: none;">
                    <ul class="list-unstyled step2list">

                    </ul>
                    <div id="step2Loader"></div>
                  </div>

                </div>
              </div>
            </section>

            <section class="tasks task-width" id="step-3">
              <header class="task-header">
                <h3 class="task-title mr-auto"> Subjects</h3>
                <div class="dropdown">
                  <button class="btn btn-reset text-muted">
                    <i class="fa fa-ellipsis-v"></i>
                  </button>
                 
                </div>
              </header>
              <div class="task-issue">
                <div class="card">

                  <div class="card-body pt-2">
                     <input type="text" class="form-control" id="step3Search" style="display: none;">
                    <ul class="list-unstyled step3List">

                    </ul>
                    <div id="subMsg"></div>
                  </div>

                </div>
              </div>
            </section>

            <section class="tasks task-width" id="step-4">
              <header class="task-header">
                <h3 class="task-title mr-auto"> Exam Centers</h3>
                <div class="dropdown">
                  <button class="btn btn-reset text-muted">
                    <div style="">
                    	<span style="font-weight: bold;" class="task-title">Count</span> &nbsp;<span class="badge badge-primary" style="width: 35px;height: 18px; margin-top: 5px;margin-top: -5px;">0</span>
                    </div>
                  </button>
                  
                </div>
              </header>
              <div class="task-issue">
                <div class="card">

                  <div class="card-body pt-2">
                    <input type="text" class="form-control" id="step4Search" style="display: none;">
                    <ul class="list-unstyled step4List">

                    </ul>
                    <div id="examMsg"></div>
                  </div>

                </div>
              </div>
            </section>
            <section class="tasks task-width" id="step-5">
              <header class="task-header">
                <h3 class="task-title mr-auto"> 60 % Marks Assignment</h3>
                <div class="dropdown">
                  <button class="btn btn-reset text-muted">
                    <i class="fa fa-ellipsis-v"></i>
                  </button>
                </div>
              </header>
              <div class="task-issue">
                <div class="card">

                  <div class="card-body pt-2">
                    <input type="text" class="form-control" id="step5Search" style="display: none;">
                    <ul class="list-unstyled step5List">

                    </ul>
                    <div id="assignmentMsg"></div>

                    <ul class="searchDivFinal"></ul>
                  </div>

                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
    
    <div class="page-section">
      <div class="section-block">
        <div class="metric-row">
          <header class="page-title-bar">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                  <a href="#">Statistics</a>
                </li>
              </ol>
            </nav>
          </header>

          <div class="col-lg-3 cus-card">
            <a href="user-teams.html" class="metric metric-bordered align-items-center">
              <h2 class="metric-label"> Degrees </h2>
              <p class="metric-value h3">
                <sub>
                  <i class="fa fa-graduation-cap fa-size"></i>
                </sub>
                <span id="degCount">0</span>
              </p>
            </a>
          </div>
          <div class="col-lg-3 cus-card">
            <a href="user-projects.html" class="metric metric-bordered align-items-center">
              <h2 class="metric-label"> Subjects </h2>
              <p class="metric-value h3">
                <sub>
                  <i class="fa fa-book fa-size"></i>
                </sub>
                <span id="subCount">0</span>
              </p>
            </a>
          </div>
          <div class="col-lg-3 cus-card">
            <a href="user-tasks.html" class="metric metric-bordered align-items-center">
              <h2 class="metric-label"> Exam Centers </h2>
              <p class="metric-value h3">
                <sub>
                  <i class="fa fa-table fa-size"></i>
                </sub>
                <span id="examCenterCount">0</span>
              </p>
            </a>
          </div>

          <div class="col-lg-3 cus-card">
            <a href="user-tasks.html" class="metric metric-bordered align-items-center">
              <h2 class="metric-label"> Assignment </h2>
              <p class="metric-value h3">
                <sub>
                  <i class="fa fa-paper-plane fa-size"></i>
                </sub>
                <span class="value">0</span>
              </p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<div class="modal hide" id="loading" data-backdrop="static" data-keyboard="false">
<div class="modal-header">
</div>
<div class="modal-body">
<div id="ajax_loader">
<img src="{{ url ('front/images/preview.gif')}}" style="width:100px;height:100px; margin:16px auto;display: block;" class="rounded">
</div>
</div>
</div>


@endsection
@section('page-js-plugins')

<script src="{{asset('backend/js/axios.min.js')}}"></script>
<script src="{{asset('backend/js/toastr.min.js')}}"></script>
@endsection
@section('custom-js')
<script>
  /* ==== Custom Scripts Area ====*/
  @if (Session::has('success'))
  toastr.success("{{Session::get('success')}}")
  @endif 
  var base_url  = '{{ URL::to("/") }}/';
  $(document).ready(function() {

    var examcode;
    var degCode;
    var subject;
    var ccode;

    var teacherId;

    var step2list   = document.querySelector(".step2list");
    var step3list   = document.querySelector(".step3List");
    var step4List   = document.querySelector(".step4List");
    var step5List   = document.querySelector(".step5List");

    var appDiv = document.createElement("span");
        appDiv.setAttribute("class","empty-box");
    var board = document.querySelector(".board");
    var dive = document.createElement("div");

    $("#step-1").on('change', function(event) {

      event.preventDefault();

      step2list.innerHTML = "";
      var count = $('select option:selected').val();
      if (count == 0){
        alert('Please select an option');
        return false;
      }

      else{


        examcode = $(this).val();

        var mgt  = document.querySelector(".mgt");
        $("#step-2").removeClass('animated animatedd slideInRight');
        var actualScroll = $("#step-2").scrollLeft();
        var url="<?php echo route('exam.degrees');?>";
        var cur_url="<?php echo route('secrecy.exams');?>";

        $("#loading").show();

        var step2Search = document.querySelector("#step2Search");

        axios({
          method: 'POST',
          url: url,
          data: {
           examcode: examcode,
         }
       })

        .then(function(res){

          var good  = res.data.Good;

          if (good === true) {

           
            step2Search.style.display = "inline-block";

            var arr = res.data.data;
            var degCount = arr.length;
            step2list.innerHTML = "";
            arr.forEach(function(item,value){
              var degId         = item.id;
              var Det1          = item.Det1;
              var DegCode       = item.DegCode;
              var M_Title       = item.M_Title;
              var centerDegrees = item.centerDegrees;
              step2list.innerHTML += `<li> <a href="#" class="secrecydegree" data-id="${DegCode}">${Det1}</a><span class="float-right badge badge-dark circle">${centerDegrees}</span></li>`;
            });

            $(".board").scrollLeft(actualScroll+330);
            $("#step-2").addClass('animated animatedd slideInRight');
            appDiv.setAttribute("style","display:inline-block");
            board.appendChild(appDiv);

            document.querySelector("#degCount").innerHTML = degCount;

            $("#loading").hide();
          }
          else{

            appDiv.setAttribute("class","empty-box");
            appDiv.setAttribute("style","display:inline-block");
            board.appendChild(appDiv);
            dive.setAttribute("class","mgt");
            var msg  = dive.innerHTML =  res.data.Message;

            alert(msg);

            $('body').load(document.URL+'#step-1');

            step2Search.style.display = "none";

            $("#loading").hide();

          }

        })
      }
    });

    $(document).on('click','.secrecydegree',function(e) {
     e.preventDefault();

      $('.secrecydegree.cus-active').removeClass('cus-active'); 
      $(this).addClass('cus-active');

     var subcontainer = document.querySelector("#subMsg");

     step3list.innerHTML = "";
     step4List.innerHTML = "";
     step5List.innerHTML = "";
     document.querySelector("#step3Search").style.display="none";
     document.querySelector("#step4Search").style.display="none";
     var notNull = document.querySelector(".teacherSearchBox");
     var mgt = document.querySelector(".mgt");

     if (notNull) {
        notNull.style.display="none";
     }
     if (mgt) {
        mgt.style.display="none";
     }
     subcontainer.innerHTML = "";

     degCode  = $(this).data("id");
     $("#step-3").removeClass('animated animatedd slideInRight');
     var actualScroll = $("#step-0").scrollLeft();
     var url="<?php echo route('exam.degrees-subjects');?>";
     var cur_url="<?php echo route('secrecy.exams');?>";

     $("#loading").show();
     var step3Search = document.querySelector("#step3Search");

     axios({
       method: 'POST',
       url: url,
       data: {
        degCode: degCode,
        examcode:examcode,
      }
    })

     .then(function(res){

      var good1  = res.data.Good;

      if (good1===true) {

       
        step3Search.style.display = "inline-block";
        
        var arr = res.data.data;
        var subCount = arr.length;
        step3list.innerHTML = "";
        arr.forEach(function(item,value){
          var subject_id = item.subject_id;
          var code  = item.code;
          var Na  = item.Na;
          var degYears = item.degYears;
          var DegCode = item.DegCode;
          var totalSubjects = item.totalSubjects;
          var assigedCounts = item.assigedCounts;
          step3list.innerHTML += `
          <div class="float-left">
          <li><a href="#" class="secrecysubjects" data-id="${code}">${Na}</a></li>
          </div>
          <div class="float-right">
            <span class ="badge badge-warning circle">${assigedCounts}</span>&nbsp;&nbsp;<span class ="format-txt">out of</span> 
            &nbsp;&nbsp;<span class="badge badge-success circle">${totalSubjects}</span>
          </div>
          <div class="clearfix"></div>
          `;
        });

        $(".board").scrollLeft(actualScroll+660);
        $("#step-3").addClass('animated animatedd slideInRight');
        var appDiv = document.createElement("span");
        appDiv.setAttribute("class","empty-box");
        appDiv.setAttribute("style","display:inline-block");
        var board = document.querySelector(".board");
        board.appendChild(appDiv);

        document.querySelector("#subCount").innerHTML = subCount;
        $("#loading").hide();
      }
      else{

        subcontainer.innerHTML ="";
        $(".board").scrollLeft(actualScroll+660);
        $("#step-3").addClass('animated animatedd slideInRight');
        var appDiv = document.createElement("span");
        appDiv.setAttribute("class","empty-box");
        appDiv.setAttribute("style","display:inline-block");
        var board = document.querySelector(".board");
        board.appendChild(appDiv);
        var msg1  = res.data.Message;
        var subMsg   = document.createElement("div");
            subMsg.setAttribute("class","mgt");
            subMsg.innerHTML = msg1;
        subcontainer.appendChild(subMsg);
        step3Search.style.display = "none";
        $("#loading").hide();
      }
    })
   });

  $(document).on('click','.secrecysubjects',function(e) {
      e.preventDefault();

      $('.secrecysubjects.cus-active').removeClass('cus-active'); 
      $(this).addClass('cus-active');

      var examcontainer = document.querySelector("#examMsg");

      step4List.innerHTML = "";
      examcontainer.innerHTML = "";
      step5List.innerHTML = "";
      document.querySelector("#step4Search").style.display="none";

      var notNull = document.querySelector(".teacherSearchBox");
      var mgt = document.querySelector(".mgt");

      if (notNull) {
        notNull.style.display="none";
      }
      if (mgt) {
        mgt.style.display="none";
      }

      subject  = $(this).data("id");

      $("#step-3").removeClass('animated animatedd slideInRight');
      var actualScroll = $("#step-0").scrollLeft();

      var url="<?php echo route('exam.degrees-subjects-colleges');?>";
      var cur_url="<?php echo route('secrecy.exams');?>";

      $("#loading").show();
      var step4Search = document.querySelector("#step4Search");

      axios({
        method: 'POST',
        url: url,
        data: {
          examcode: examcode,
          degCode: degCode,
          subject: subject,
        }
      }) 

      .then(function(res){

        var good2  = res.data.Good;

        if (good2===true) {
        
          
              step4Search.style.display = "inline-block";

          var arr = res.data.data;
          examCenterCount = arr.length;
          step4List.innerHTML = "";
          step5List.innerHTML = "";
          arr.forEach(function(item,value){
            ccode = item.ccode;
            var cname  = item.cname;
            step4List.innerHTML += `<li>  
            
            <div class="checkbox">
             <input type="checkbox" id="checkbox-${ccode}" name="bulkcheckbox" class="bulkcheckbox" value="${ccode}">
             <label for="checkbox-${ccode}"><span><a href="#" class="secrecysubjectscenter" data-id="${ccode}">${cname}</a></span></label>
          </div>
            
            </li>`;

          });

          $(".board").scrollLeft(actualScroll+960);
          $("#step-4").addClass('animated animatedd slideInRight');

          var appDiv = document.createElement("span");
          appDiv.setAttribute("class","empty-box");
          appDiv.setAttribute("style","display:inline-block");
          var board = document.querySelector(".board");
          board.appendChild(appDiv);

          document.querySelector("#examCenterCount").innerHTML = examCenterCount;
          $("#loading").hide();
        }
        else{
          
          
          step4List.innerHTML = "";
          step5List.innerHTML = "";
          $(".board").scrollLeft(actualScroll+960);
          $("#step-4").addClass('animated animatedd slideInRight');
          var appDiv = document.createElement("span");
          appDiv.setAttribute("class","empty-box");
          appDiv.setAttribute("style","display:inline-block");
          var board = document.querySelector(".board");
          board.appendChild(appDiv);
          var msg2  = res.data.Message;
          var examMsg   = document.createElement("div");
              examMsg.setAttribute("class","mgt");

            if($('#examMsg').is(':empty')){
              examMsg.innerHTML = msg2;
              examcontainer.appendChild(examMsg);
              step4Search.style.display = "none";
            }
            else{
              examMsg.innerHTML = "";
            }

            document.querySelector("#examCenterCount").innerHTML= 0;
            $("#loading").hide();
            
        }

      }) 
    });

    $(document).on('click','.secrecysubjectscenter',function(e) {
      e.preventDefault();

      $('.secrecysubjectscenter.cus-active').removeClass('cus-active'); 
      $(this).addClass('cus-active');

      var examcontainer = document.querySelector("#assignmentMsg");

      step5List.innerHTML = "";
      examcontainer.innerHTML = "";

      var mgt  = document.querySelector(".mgt");
      var teacherSearchBox  = document.querySelector(".teacherSearchBox");
      var searchDivFinal  = document.querySelector(".searchDivFinal");

      if (mgt) {
        mgt.style.display="none";
      }
      if (teacherSearchBox) {
          teacherSearchBox.style.display="none";
      }
      if (searchDivFinal) {
        searchDivFinal.innerHTML="";
      }



      ccode  = $(this).data("id");

      $("#step-4").removeClass('animated animatedd slideInRight');
      var actualScroll = $("#step-0").scrollLeft();

      var url="<?php echo route('exam.degrees-subjects-colleges-assignment');?>";
      var cur_url="<?php echo route('secrecy.exams');?>";

      $("#loading").show();

      axios({
        method: 'POST',
        url: url,
        data: {
          examcode: examcode,
          degCode:  degCode,
          subject: subject,
          ccode: ccode,
        }
      })

      .then(function(res){

        var good3  = res.data.Good;

        if (good3===true) {
          var arr = res.data.data;
          step5List.innerHTML = "";
          arr.forEach(function(item,value){
            is_assigned = item.is_assigned;
            var teacher_id  = item.teacher_id;
            var teacher_name  = item.teacher_name;
            var college  = item.college;
            step5List.innerHTML += `<li> <a href="#" class="secrecysubjectscenter" draggable="false" title="${college}" data-id="${teacher_id}">${teacher_name}</a></li>`;

        });


        $(".board").scrollLeft(actualScroll+1260);
        $("#step-5").addClass('animated animatedd slideInRight');

        var appDiv = document.createElement("span");
        appDiv.setAttribute("class","empty-box");
        appDiv.setAttribute("style","display:inline-block");
        var board = document.querySelector(".board");
        board.appendChild(appDiv);

      
         $('.empty-box').not(':first').remove(); 
         $(board).find('span:first').remove();

         $("#loading").hide();
        }
        else{
          step5List.innerHTML = "";
          $(".board").scrollLeft(actualScroll+1260);
          $("#step-5").addClass('animated animatedd slideInRight');

          var appDiv = document.createElement("span");
          appDiv.setAttribute("class","empty-box");
          appDiv.setAttribute("style","display:inline-block");

          var board = document.querySelector(".board");


          var msg2  = res.data.Message;
          var assignmentMsg   = document.createElement("div");
            assignmentMsg.setAttribute("class","mgt");
            assignmentMsg.innerHTML = msg2;
            examcontainer.appendChild(assignmentMsg);
            // $(board).find('span:first').remove(); 
             $('.empty-box').not(':first').remove();
             $(board).find('span:first').remove();
          var teacherdiv  = document.createElement("div");
              teacherdiv.setAttribute("class","form-group");

          var teacherSearchInput  =  document.createElement("input");
              teacherSearchInput.setAttribute("type","text");  
              teacherSearchInput.setAttribute("class","form-control teacherSearchBox");

              teacherdiv.appendChild(teacherSearchInput);


              assignmentMsg.after(teacherdiv); 
          $("#loading").hide();

        }

            

      })  

    });

    


    $(document).on('keyup','.teacherSearchBox',function(e) {
      e.preventDefault();

      var searchVal    = $(this).val().toLowerCase();
      var html = document.querySelector(".searchDivFinal");
      if (searchVal.length > 0) {
        var url="<?php echo route('exam.search-teacher');?>";
        var cur_url="<?php echo route('secrecy.exams');?>";
      
      $("#loading").show();

      html.innerHTML = "";

      axios({
        method: 'POST',
        url: url,
        data: {
          searchVal: searchVal,
        }

      })

      .then(function(res){

        var good  = res.data.Good;

        if (good===true) {

          var arr = res.data.data;
          html.innerHTML = "";
          arr.forEach(function(item,value){
            var id = item.id;
            var department_id  = item.department_id;
            var name  = item.name;
            var mobile  = item.mobile;
            var collegeName  = item.collegeName;
            html.innerHTML += `<li> <a href="#" class="teacherPaperAssignment" title="${collegeName}"  data-id="${id}">${name}</a></li>`;

        });

          $("#loading").hide();
        }
        else{

            html.innerHTML = "";

            var msg  = res.data.Message;

            html.innerHTML = msg;

            $("#loading").hide();
        }

      })
      }
      else{
        html.innerHTML = "";
      
      }

    });


    $(document).on('click','.teacherPaperAssignment',function(evt){

      evt.preventDefault();

       teacherId  = $(this).data("id");

       var url="<?php echo route('exam.search-teacher-assignment');?>";
       var cur_url="<?php echo route('secrecy.exams');?>";

       var clear    = document.querySelector(".teacherSearchBox");
       var searchDivFinal    = document.querySelector(".searchDivFinal");
       var mgt    = document.querySelector(".mgt");

       clear.style.display="none";
 

       axios({
        method: 'POST',
        url: url,
        data: {
          examcode: examcode,
          subject: subject,
          ccode: ccode,
          teacherId: teacherId,
        }

      })

      .then(function(res){

        var good  = res.data[0].message;
          if (good===true) {
          step5List.innerHTML = "";   
          var assigned =   res.data.Message;
  
           setTimeout(()=>{toastr.success(assigned);
            },1000);
          clear.style.display="inline-block";
          
          if (mgt) {
			        mgt.style.display="none";
			    }

          searchDivFinal.innerHTML= "";
          }
          else{
            step5List.innerHTML = "";
            var notAssigned  = res.data[0].message;
            setTimeout(()=>{toastr.success(notAssigned);
            },1000);
         		clear.style.display="inline-block";
         		if (mgt) {
			        mgt.style.display="none";
			    	}
          }
      })

    });

    $(document).on('change', '.bulkcheckbox', function(event) {
    	event.preventDefault();
    	
    	ccode  = $(this).val();
    		
    		var stdCounts = 0;

	    	var url="<?php echo route('exam.student-count');?>";
	      var cur_url="<?php echo route('secrecy.exams');?>";

	      axios({
	        method: 'POST',
	        url: url,
	        data: {
	          examcode:examcode,
	          degCode:degCode,
	          subject:subject,
	          ccode:ccode
	        }

	      })

	      .then(function(res){

	      	console.log(res);

	      });

    });


    $("#step2Search").on("keyup", function() {

        var value = $(this).val().toLowerCase();
        $(".step2list li").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

    });

    $("#step3Search").on("keyup", function() {

        var value1 = $(this).val().toLowerCase();
        $(".step3List li").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value1) > -1)
        });

    });

    $("#step4Search").on("keyup", function() {

        var value2 = $(this).val().toLowerCase();
        $(".step4List li").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value2) > -1)
        });

    });

  });
</script>
<script>
  window.onbeforeunload = function (e) {
  var message = "Your confirmation message goes here.",
  e = e || window.event;
  if (e) {
    e.returnValue = message;
  }
  return message;
};
</script>
@endsection
