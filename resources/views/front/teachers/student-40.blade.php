@extends('layouts.teacher')

@section('page-title')
<title> Exam Portal | Teachers Dashboard | Forty Marks Entry </title>
@endsection
@section('theme-css-plugins')


<link href="{{asset('backend/css/toastr.min.css')}}" rel="stylesheet">


@endsection

@section('custom-css')
<style>
/* ==== Custom Styles Area ====*/
.circle{
      width: 24px;
      height: 24px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      padding: 5px 8px;
}

 .cus-title{
  font-size: 18px;
  color: #bc9128;
  text-transform: capitalize;
 }
</style>
@endsection

@section('main')

@include('front.teachers.components.header-component')

<div class="page-inner">
  <header class="page-title-bar">
    <button type="button" class="btn btn-success btn-floated">
      <span class="fa fa-plus"></span>
    </button>
  </header>
  <div class="page-section">
    <section class="card card-fluid">
      <!-- .card-header -->
      <div class="card-header">
    
        <a href="{{ route('tdashboard') }}" style="height: " class="btn btn-outline-primary btn-sm float-right">
                    <span class="fa fa-arrow-left"></span></a>
        @if(count($results40) > 0)
          <h5 class="cus-title">Course Name : {{  $results40[0]->Na }}</h5>
        @endif  
       
            <div class="card-body">
             
                    <div class="table-responsive" id="internalMarksTable">
                      <!-- .table -->
                      <table class="table">
                        <!-- thead -->
                        @if(count($results40) > 0)
                        <thead>
                        <?php //dd($results40);?>
                          <tr>
                            
                            <th>Name </th>
                            <th> Father Name </th>
                            <th> Roll No </th>
                            <th> Entered Marks </th>
                            <th> 40 % Marks </th>
                            
                          </tr>
                        </thead>
                             @endif
                        <tbody>
                          @if(count($results40) > 0)
                              @foreach($results40 as $result40)
                                <tr>
                                  <td class="align-middle">{{ $result40->stdName }}</td>
                                  <td class="align-middle">{{ $result40->stdfName }}</td>
                                  <td class="align-middle">{{ $result40->rollno }}</td>
                                  <td class="align-middle"> 
                                    @if($result40->obt40 === NULL)
                                        {{ "Marks not entered" }}  

                                        @else 
                                        <span class="result-40">{{ $result40->obt40  }}</span>
                                    @endif
                                  </td>
                                  <td class="align-middle">
                                    <form id="marksFortyForm-{{ $result40->rollno }}">
                                      <input type="hidden" class="hiddenComId" name="hiddenComId" value="{{ $result40->roll_no_com_det_id }}">
                                      <input type="hidden" class="hiddenRollno" name="hiddenRollno" value="{{ $result40->rollno }}">
                                      <input type="hidden" class="hiddenExamcode" name="hiddenExamcode" value="{{ $result40->examcode }}">
                                      
                                      <input type="number" class="form-control marks-40">
                                    </form>

                                  </td>
                                </tr>

                              @endforeach
                            @else
                            <tr>
                              <td colspan="4">No data found for this subject</td>
                            </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  
                  </div>
     

      </div>

    </section>
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
    $(".marks-40").on('change', function (e) {
        var mks40     =  $(this).val();
        var stdForm   =  $(this).closest('form');
        var rollno    =  stdForm.find('.hiddenRollno').val();
        var examcode  =  stdForm.find('.hiddenExamcode').val();
        var comId     =  stdForm.find('.hiddenComId').val();

        var url="<?php echo route('subject.fortyprocess');?>";
        var cur_url= document.URL;

        axios({
                method: 'POST',
                url: url,
                data: {
                  mks40:mks40,
                  rollno:rollno,
                  examcode:examcode,
                  comId:comId,

                }
          }) 
          .then(function(res){
            var tos=res.data[0].message;

            var good=res.data[0].Good;
            if(good==true){
             setTimeout(()=>{toastr.success(tos);
             },1000);

             $('body').load(document.URL+'#internalMarksTable');
           }
         })
          .catch(function(err){
            setTimeout(()=>{toastr.warning("Marks could not be entered.");
          },1000);
            $('body').load(document.URL+'#internalMarksTable')});
   
    });

  </script>
  @endsection
