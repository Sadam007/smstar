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
.step2list li:first-child{
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
                <h3 class="task-title mr-auto"> Exams</h3>
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
                    <i class="fa fa-ellipsis-v"></i>
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


@endsection
@section('page-js-plugins')
{{-- @include('backend.includes.components.scripts.dashboard-chart-component') --}}

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
  $(document).ready(function($) {

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

        var img=document.createElement("img");
        img.setAttribute("src",base_url+'front/images/loading.gif');
        var loader=document.querySelector("#loader");loader.appendChild(img);

        var mgt  = document.querySelector(".mgt");
        $("#step-2").removeClass('animated animatedd slideInRight');
        var actualScroll = $("#step-2").scrollLeft();
        var url="<?php echo route('exam.degrees');?>";
        var cur_url="<?php echo route('secrecy.exams');?>";

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
              var degId = item.id;
              var Det1  = item.Det1;
              var DegCode = item.DegCode;
              var M_Title = item.M_Title;
              step2list.innerHTML += `<li> <a href="#" class="secrecydegree" data-id="${DegCode}">${Det1}</a></li>`;
            });

            $(".board").scrollLeft(actualScroll+330);
            $("#step-2").addClass('animated animatedd slideInRight');
            appDiv.setAttribute("style","display:inline-block");
            board.appendChild(appDiv);
            img.style.display="none";
            document.querySelector("#degCount").innerHTML = degCount;
          }
          else{

            appDiv.setAttribute("class","empty-box");
            appDiv.setAttribute("style","display:inline-block");
            board.appendChild(appDiv);
            dive.setAttribute("class","mgt");
            var msg  = dive.innerHTML =  res.data.Message;
            // loader.appendChild(dive);
            alert(msg);
            img.style.display="none"; 
            $('body').load(document.URL+'#step-1');

            step2Search.style.display = "none";

          }

        })
      }
    });

    $(document).on('click','.secrecydegree',function(e) {
     e.preventDefault();

      $('.secrecydegree.cus-active').removeClass('cus-active'); 
      $(this).addClass('cus-active');

     //secrecydegree.setAttribute("class","cus-active");
     var subcontainer = document.querySelector("#subMsg");

     step3list.innerHTML = "";
     subcontainer.innerHTML = "";

     /*
        var img=document.createElement("img");
          img.setAttribute("src",base_url+'front/images/loading.gif');
        var hidd  = $(".step2list>li").hide('slow', function() {
        var step2Loader   = document.querySelector("#step2Loader");

        setTimeout(()=>{

          step2Loader.appendChild(img); 

         },5000);
        });  

    */
    
        

     degCode  = $(this).data("id");
     $("#step-3").removeClass('animated animatedd slideInRight');
     var actualScroll = $("#step-0").scrollLeft();
     var url="<?php echo route('exam.degrees-subjects');?>";
     var cur_url="<?php echo route('secrecy.exams');?>";

      var step3Search = document.querySelector("#step3Search");

     axios({
       method: 'POST',
       url: url,
       data: {
        degCode: degCode,
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
          step3list.innerHTML += `<li> <a href="#" class="secrecysubjects" data-id="${code}">${Na}</a></li>`;
        });

        $(".board").scrollLeft(actualScroll+660);
        $("#step-3").addClass('animated animatedd slideInRight');
        var appDiv = document.createElement("span");
        appDiv.setAttribute("class","empty-box");
        appDiv.setAttribute("style","display:inline-block");
        var board = document.querySelector(".board");
        board.appendChild(appDiv);
        // $(board).find('span:first').remove(); 
        document.querySelector("#subCount").innerHTML = subCount;
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
        // $(board).find('span:first').remove();
        step3Search.style.display = "none";
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
      subject  = $(this).data("id");

      $("#step-3").removeClass('animated animatedd slideInRight');
      var actualScroll = $("#step-0").scrollLeft();

      var url="<?php echo route('exam.degrees-subjects-colleges');?>";
      var cur_url="<?php echo route('secrecy.exams');?>";

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
            step4List.innerHTML += `<li> <a href="#" class="secrecysubjectscenter" data-id="${ccode}">${cname}</a></li>`;

          });

          $(".board").scrollLeft(actualScroll+960);
          $("#step-4").addClass('animated animatedd slideInRight');

          var appDiv = document.createElement("span");
          appDiv.setAttribute("class","empty-box");
          appDiv.setAttribute("style","display:inline-block");
          var board = document.querySelector(".board");
          board.appendChild(appDiv);

          // $(board).find('span:first').remove();    
          document.querySelector("#examCenterCount").innerHTML = examCenterCount; 
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


      ccode  = $(this).data("id");

      $("#step-4").removeClass('animated animatedd slideInRight');
      var actualScroll = $("#step-0").scrollLeft();

      var url="<?php echo route('exam.degrees-subjects-colleges-assignment');?>";
      var cur_url="<?php echo route('secrecy.exams');?>";

      /*var linkremove  = document.querySelector(".secrecysubjectscenter").length;

      console.log(linkremove);*/



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
            step5List.innerHTML += `<li> <a href="#" class="secrecysubjectscenter" draggable="false" data-tooltip="${college}" data-id="${teacher_id}">${teacher_name}</a></li>`;

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
          

        }

            

      })  

    });

    


    $(document).on('keyup','.teacherSearchBox',function(e) {
      e.preventDefault();

      /*var examcode;
      var degCode;
      var subject;
      var ccode;*/

      var searchVal    = $(this).val().toLowerCase();
      var html = document.querySelector(".searchDivFinal");
      if (searchVal.length > 0) {
        var url="<?php echo route('exam.search-teacher');?>";
        var cur_url="<?php echo route('secrecy.exams');?>";
    
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
        }
        else{

            html.innerHTML = "";

            var msg  = res.data.Message;

            html.innerHTML = msg;
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
          }
          else{
            step5List.innerHTML = "";
            var notAssigned  = res.data[0].message;
            setTimeout(()=>{toastr.warning(notAssigned);
            },1000);
         
          }
      })




    });

    /*$("#step2Search").on('keyup', function(event) {
      event.preventDefault();
      alert(4);
    });*/

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
@endsection
