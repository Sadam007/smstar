<?php
    //$URL = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];


    //if ($URL != "examportal.pk/student/registration")
    //die("/\*sry, no acces rights\*/");
?>
<script>
	
	
	$("#stdDepartment").on("change", function(e){
		e.preventDefault();
		var deptValue = $(this).val();
		var url = "<?php echo route('check.college.degrees');?>";
		var stdDegree = document.querySelector("#stdDegree");

		//stdDegree.innerHTML += `<option value="">Please select an option</option>`;
		if (stdDegree) {
			axios({
            method: 'POST',
            url: url,
            data: {
              deptValue: deptValue,
            }
          })
		.then(function(res){

			var arr = res.data.data;

			stdDegree.innerHTML = "";
        	arr.forEach(function(item,value){
        		var degId = item.id;
        		var Det1  = item.Det1;
        		var DegCode = item.DegCode;
        		var M_Title = item.M_Title;
        		stdDegree.innerHTML += `<option value="${DegCode}"> ${Det1}</option>`;


        	});
        	
         })
		.catch(function(err){
			//console.log(err.data);
			var notFound = document.querySelector("#stdDegree");
				notFound.innerHTML = "";
				notFound.innerHTML += `<option value=""> No degree found in this college</option>`
		});
		}
		else{
			alert("The selected department is not found");
		}
	});


	$('#step-three-table').DataTable({      
		"searching": false,
		"paging": false, 
		"info": false,         
		"lengthChange":false ,
		"ordering": false,
	});

	$('#stddob').datetimepicker({
		format:'d.m.Y',
		timepicker:false,
		theme:'dark'
	});

	function backPage(form_hide,form_show){
		$('#'+form_hide).hide();
		$('#'+form_show).show();
	}

	$(document).ready(function () {

		$.validator.addMethod("lettersonly", function(value, element) 
            {
            return this.optional(element) || /^[a-z," "]+$/i.test(value);
        },'Letters and white spaces are allowed');
 		
 		$.validator.addMethod("specialLetters", function(value, element) 
            {
            return this.optional(element) || /^[a-zA-Z\:/\s]+$/i.test(value);
        },'Letters, white spaces, / and : are allowed');

        $.validator.addMethod('filesize', function (value, element, param) {
	      return this.optional(element) || (element.files[0].size <= param)
	  	}, function(size){
	   		 return "MAX SIZE " + filesize(size,{exponent:2,round:1});
	  	});

      $.validator.addMethod("validMobile", function(value,element) {
            return this.optional(element) ||  /^[0]?[789]\d{11}$/.test(value);
    	}, "Please enter your mobile with country code and without dashes"); 

 		
		$('#stdDepartment').select2({
			width: '100%',
			placeholder: 'Search  department / college',
			language: {
				noResults: function() {
					return '<button id="no-results-btn" onclick="noResultsButtonClicked()" class="btn btn-sm">No Result Found</a>';
				},
			},
			escapeMarkup: function(markup) {
				return markup;
			},
		});	

		

		$("#metricSelect").on('change',  function(evt) {
			 evt.preventDefault();
			$("#metricGroup").append('<option value="">Select Group</option>');
			$("#metricGroup").append('<option value="Arts">Arts</option>');
			$("#metricGroup").append('<option value="Science">Science</option>');
			
		});
// 
		$("#fscSelect").on('change',  function(ev) {
			 ev.preventDefault();
	
			var fscGroup = $(this).val();
			if (fscGroup == 2) 
				{
					$("#fscGroup").append('<option value="">Select Group</option>');
					$("#fscGroup").append('<option value="Medical">Pre Medical</option>');
					$("#fscGroup").append('<option value="Engineering">Pre Engineering</option>');
				}
				if (fscGroup == 3){
					$("#fscGroup").append('<option value="">Select Group</option>');
					$("#fscGroup").append('<option value="Civil">Civil</option>');
					$("#fscGroup").append('<option value="Electrical">Electrical</option>');
					$("#fscGroup").append('<option value="Chemical">Chemical</option>');
					$("#fscGroup").append('<option value="Electronics">Electronics</option>');
					$("#fscGroup").append('<option value="Petroleum">Petroleum</option>');
				}
		});

		$("#bscSelect").on('change',  function(et) {
			et.preventDefault();
			var bscGroup = $(this).val();
			if (bscGroup == 4) 
				{
					$("#bscGroup").append('<option value="B.A">Arts</option>');
				}
				if (bscGroup == 5){
					
					$("#bscGroup").append('<option value="B.Sc">Science</option>');
				
				}
		});
		$('#stdDomicile').select2({
			width: '100%',
			placeholder: 'Search your domicile',
			language: {
				noResults: function() {
					return '<button id="no-results-btn" onclick="noResultsButtonClicked()" class="btn btn-sm">No Result Found</a>';
				},
			},
			escapeMarkup: function(markup) {
				return markup;
			},
		}); 

		$('#btn-1').on('click', function () {
			$("form#form-1").validate({
				errorElement: 'span',
				errorClass: 'help-block err',
				ignore: ":hidden:not(select)",
				debug:true,
				rules: {
					stdDepartment: {
						required: true,
					},
					stdSession: {
						required: true,
					},
					stdDegree:{
						required:true,
					},
				},
					highlight: function (element) {
						$(element)
						.closest('.form-control').addClass('err');
					},
					errorPlacement: function (error, element) {
			    		if(element.hasClass('select2') && element.next('.select2-container').length) {
			        		error.insertAfter(element.next('.select2-container'));
			        	} 
			        	else if (element.parent('.form-group').length) {
			            error.insertAfter(element.parent());
			        	}
			        	else {
			            	error.insertAfter(element);
			        	}
			    	},
					success: function (label) {
						label.closest('.form-control').removeClass('err');
						label.remove();
					},
					invalidHandler:function(form,validator){
						if(!validator.numberOfInvalids())return;
					},
					messages: {
					},
					submitHandler: function (form) {
	        			$('#form-1').hide();
	              $('#form-2').show();
	        }
	    });
		});

		$('#btn-2').on('click', function () {
			$("form#form-2").validate({
				errorElement: 'span',
				errorClass: 'help-block err',
				ignore: ":hidden:not(select)",
				rules: {
					stdName: {
						required: true,
						lettersonly:true,
						minlength:3,
					},
					stdfName:{
						required:true,
						lettersonly:true,
						minlength:3,
					},
					stddob:{
						required:true,
					},
					stdDomicile:{
						required:true,
					},
					stdAddress:{
						required:true,
						specialLetters:true,
					},
					stdPhoto:{
						required:true,
						extension: "jpg|jpeg|png",
                        filesize:1000 * 1024
					}
				},
				highlight: function (element) {
					$(element)
					.closest('.form-control').addClass('err');
				},
				errorPlacement: function (error, element) {
			    		if(element.hasClass('select2') && element.next('.select2-container').length) {
			        		error.insertAfter(element.next('.select2-container'));
			        	} 
			        	else if (element.parent('.form-group').length) {
			            error.insertAfter(element.parent());
			        	}
			        	else {
			            	error.insertAfter(element);
			        	}
			    	},
				success: function (label) {
					label.closest('.form-control').removeClass('err');
					label.remove();
				},
				invalidHandler:function(form,validator){
					if(!validator.numberOfInvalids())return;
				},
				messages: {
					stdPhoto:{
                        	required:"This field is required",
                            extension:"These extension (jpg | jpeg | png) are allowed to upload",  
                            filesize:"Image size must be less than 1MB",  
                    },
				},
				submitHandler: function (form) {
        			$('#form-2').hide();
        			$('#form-3').show();
        }
    	});
		});

		$('#btn-3').on('click', function () {
			$("form#form-3").validate({
				errorElement: 'span',
				errorClass: 'help-block err',
				ignore: ":hidden:not(select)",
				rules: {
					metricSelect: {
						required: true,
					},
					metricGroup:{
						required:true,
					},
					metricRollno:{
						required:true,
						number:true,
					},
					metricYear:{
						required:true,
						number:true,
					},
					metricObtMarks:{
						required:true,
						number:true,
					},
					metricTotMarks:{
						required:true,
						number:true,
					},
					metricInstitue:{
						required:true,
						lettersonly:true,
					},
					metricBoard:{
						required:true,
					},
					fscSelect:{
						required:true,
					},
					fscGroup:{
						required:true,
					},
					fscRollno:{
						required:true,
						number:true,
					},
					fscYear:{
						required:true,
						number:true,
					},
					fscObtMarks:{
						required:true,
						number:true,
					},
					fscTotMarks:{
						required:true,
						number:true,
					},
					fscInstitue:{
						required:true,
						lettersonly:true,
					},
					fscBoard:{
						required:true,
					},
					// bscSelect:{
					// 	required:true,
					// },
					// bscGroup:{
					// 	required:true,
					// },
					// bscRollno:{
					// 	required:true,
					// 	number:true,
					// },
					// bscYear:{
					// 	required:true,
					// 	number:true,
					// },
					// bscObtMarks:{
					// 	required:true,
					// 	number:true,
					// },
					// bscTotMarks:{
					// 	required:true,
					// 	number:true,
					// },
					// bscInstitue:{
					// 	required:true,
					// 	lettersonly:true,
					// },
					// bscBoard:{
					// 	required:true,
					// },
				},
				highlight: function (element) {
					$(element)
					.closest('.form-control').addClass('err');
				},
				success: function (label) {
					label.closest('.form-control').removeClass('err');
					label.remove();
				},
				invalidHandler:function(form,validator){
					if(!validator.numberOfInvalids())return;
				},
				messages: {
				},
				submitHandler: function (form) {
              $('#form-3').hide();
              $('#form-4').show();

                            
        }
      });
		});

		$('#btn-4').on('click', function () {
			$("form#form-4").validate({
				errorElement: 'span',
				errorClass: 'help-block err',
				ignore: ":hidden:not(select)",
				debug:true,
				rules: {
					stdEmail: {
						required: true,
						email:true,
					},
					stdContact:{
						required:true,
	               		minlength:13,
	               		maxlength:13,
	               	validMobile: true,
					}
				},
				highlight: function (element) {
					$(element)
					.closest('.form-control').addClass('err');
				},
				success: function (label) {
					label.closest('.form-control').removeClass('err');
					label.remove();
				},
				invalidHandler:function(form,validator){
					if(!validator.numberOfInvalids())return;
				},
				messages: {
				},
				submitHandler: function (form,ett) {

					// Form 1 values
					var stdDepartment  = $('#stdDepartment').val();
					var stdSession     = $('#stdSession').val();

					var sessionId     = $('#sessionId').val();
					var stdDegree      = $('#stdDegree').val();
					// Form 2 values
					var stdName        = $('#stdName').val();
					var stdfName       = $('#stdfName').val();
					var stddob         = $('#stddob').val();
					var stdDomicile    = $('#stdDomicile').val();
			
					var stdAddress     = $('#stdAddress').val();
					// Form 3 values
					var metricSelect   = $('#metricSelect').val();
					var metricGroup    = $('#metricGroup').val();
					var metricRollno   = $('#metricRollno').val();
					var metricYear     = $('#metricYear').val();
					var metricObtMarks = $('#metricObtMarks').val();
					var metricTotMarks = $('#metricTotMarks').val();
					var metricInstitue = $('#metricInstitue').val();
					var metricBoard    = $('#metricBoard').val();

					var fscSelect      = $('#fscSelect').val();
					var fscGroup       = $('#fscGroup').val();
					var fscRollno      = $('#fscRollno').val();
					var fscYear        = $('#fscYear').val();
					var fscObtMarks    = $('#fscObtMarks').val();
					var fscTotMarks    = $('#fscTotMarks').val();
					var fscInstitue    = $('#fscInstitue').val();
					var fscBoard       = $('#fscBoard').val();

					var bscSelect      = $('#bscSelect').val();
					var bscGroup       = $('#bscGroup').val();
					var bscRollno      = $('#bscRollno').val();
					var bscYear        = $('#bscYear').val();
					var bscObtMarks    = $('#bscObtMarks').val();
					var bscTotMarks    = $('#bscTotMarks').val();
					var bscInstitue    = $('#bscInstitue').val();
					var bscBoard       = $('#bscBoard').val();

					// Form 4 values
					var stdEmail       = $('#stdEmail').val();
					var stdContact     = $('#stdContact').val();

					var data = new FormData();
					data.set('stdDepartment', stdDepartment);
					data.set('stdSession', stdSession);
					data.set('sessionId', sessionId);
					data.set('stdDegree', stdDegree);
					data.set('stdName', stdName);
					data.set('stdfName', stdfName);
					data.set('stddob', stddob);
					data.set('stdDomicile', stdDomicile);
					data.set('stdAddress', stdAddress);
					data.set('metricSelect', metricSelect);
					data.set('metricGroup', metricGroup);
					data.set('metricRollno', metricRollno);
					data.set('metricYear', metricYear);
					data.set('metricObtMarks', metricObtMarks);
					data.set('metricTotMarks', metricTotMarks);
					data.set('metricInstitue', metricInstitue);
					data.set('metricBoard', metricBoard);
					data.set('fscSelect', fscSelect);
					data.set('fscGroup', fscGroup);
					data.set('fscRollno', fscRollno);
					data.set('fscYear', fscYear);
					data.set('fscObtMarks', fscObtMarks);
					data.set('fscTotMarks', fscTotMarks);
					data.set('fscInstitue', fscInstitue);
					data.set('fscBoard', fscBoard);
					data.set('bscSelect', bscSelect);
					data.set('bscGroup', bscGroup);
					data.set('bscRollno', bscRollno);
					data.set('bscYear', bscYear);
					data.set('bscObtMarks', bscObtMarks);
					data.set('bscTotMarks', bscTotMarks);
					data.set('bscInstitue', bscInstitue);
					data.set('bscBoard', bscBoard);
					data.set('stdEmail', stdEmail);
					data.set('stdContact', stdContact);
					
					data.append('stdPhoto', document.getElementById('stdPhoto').files[0]);

					var url="<?php echo route('register.student');?>";
            		var cur_url="<?php echo route('student.create');?>";

            	axios({
            		method: 'POST',
            		url: url,
            		data: data
          		})
          		.then(function(res){
          			var tos=res.data[0].message;
			    	var good=res.data[0].Good;
			        if(good==true){
			        	setTimeout(()=>{toastr.success(tos);
			            },1000);
			        $('body').load(document.URL);    
		            }
		        })
		        .catch(function(err){
           			setTimeout(()=>{toastr.error("User already exists.");
         			},1000);
         		});
					
					ett.preventDefault();
				}
			});
		});
	});

function noResultsButtonClicked() {
	alert('Please search another keywords to match some record." button.');
}	

	
</script>