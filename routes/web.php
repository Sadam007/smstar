<?php


Route::group(['middleware' => ['XSS']], function () {
		Route::get('/', [
		'uses' =>'Front\HomeController@index',
		'as'   => 'homepage'
		])->middleware(['XSS']);
});

/*
	/ --------------------------------------
	/ Error Handling Routes
	/ --------------------------------------
*/

//Route::get('/restrict');

// Auth::routes();
Route::group(['middleware' => ['XSS']], function () {
	Auth::routes(['register' => false]);
});

//Route::get('/admin/dashboard', 'DashboardController@index')->name('dashboard');

/*
	/ --------------------------------------
	/ Super Admin Routes Controlling Section
	/ --------------------------------------
*/

Route::group(['prefix'=>'admin','middleware'=>'auth','XSS'],function(){

		Route::get('dashboard', [
		'uses' =>'DashboardController@index',
		'as'   => 'dashboard'
		]);

		Route::get('/sessioncsv',[
		'uses' => 'Admin\SessionsController@sessioncsv',
		'as'   => 'sessioncsv'
		]);

		Route::post('/sessioncsvpost',[
		'uses' => 'Admin\SessionsController@sessioncsvprocess',
		'as'   => 'sessioncsvprocess'
		]);

		Route::get('/sessioncsv',[
		'uses' => 'Admin\SessionsController@index',
		'as'   => 'sessioncsv'
		]);

		Route::post('/session/update/{id}',[
		'uses' =>  'Admin\SessionsController@update',
		'as'   =>  'sessionupdate'	
		]);

		Route::get('/sessiondel/delete/{id}',[
		'uses' => 'Admin\SessionsController@sessiondel',
		'as'   => 'sessiondel'
		]);

		Route::get('/sessiondel1/delete/{id}',[
		'uses' => 'Admin\SessionsController@sessiondel1',
		'as'   => 'sessiondel1'
		]);

		Route::get('/signle/session',[
			'uses' =>'Admin\SessionsController@singleSession',
			'as'   => 'singleSession'

		]);

		Route::post('/signle/session',[
			'uses' =>'Admin\SessionsController@singleSessionProcess',
			'as'   => 'singleSession'

		]);

		Route::get('/collegecsv',[
		'uses' => 'Admin\CollegesController@collegecsv',
		'as'   => 'collegecsv'
		]);

		Route::get('/collegecsv',[
		'uses' => 'Admin\CollegesController@index',
		'as'   => 'collegecsv'
		]);

		Route::post('/collegecsvpost',[
		'uses' => 'Admin\CollegesController@collegecsvpost',
		'as'   => 'collegecsvpost'
		]);

		Route::get('/college/degreescsv',[
		'uses' => 'Admin\CollegesController@degreesIndex',
		'as'   => 'degreescsv'
		]);

		Route::post('/college/degreecsvpost',[
		'uses' => 'Admin\CollegesController@degreecsvpost',
		'as'   => 'collegedegreescsvpost'
		]);

		Route::post('/college/degrees',[
		'uses' =>  'Admin\CollegesController@collegeDegrees',
		'as'   =>  'college.degrees'	
		]);
		
		Route::get('/specialusers',[
		'uses' => 'Admin\SpecialUsersController@create',
		'as'   => 'specialusers.create'
		]);

		Route::get('/specialuserinactive/{id}',[
		'uses' => 'Admin\SpecialUsersController@userinactive',
		'as'   => 'specialuserinactive'
		]);

		Route::get('/specialuseractive/{id}',[
		'uses' => 'Admin\SpecialUsersController@useractive',
		'as'   => 'specialuseractive'
		]);

		Route::post('/specialuserspost',[
		'uses' => 'Admin\SpecialUsersController@store',
		'as'   => 'specialuserspost.store'
		]);

		Route::get('/degreecsv',[
		'uses' => 'Admin\DegreesController@index',
		'as'   =>  'degreecsv'
		]);

		Route::post('/degreecsvpost',[
		'uses' => 'Admin\DegreesController@degreecsvpost',
		'as'   => 'degreecsvpost'
		]);

		Route::post('/degree/update/{id}',[
		'uses' =>  'Admin\DegreesController@update',
		'as'   =>  'degreeupdate'	
		]);

		Route::get('/signle/degree',[
			'uses' =>'Admin\DegreesController@singleDegree',
			'as'   => 'singleDegree'

		]);

		Route::post('/signle/degree',[
			'uses' =>'Admin\DegreesController@singleDegreeProcess',
			'as'   => 'singleDegree'

		]);

		Route::get('/degreedel/delete/{id}',[
		'uses' => 'Admin\DegreesController@degreedel',
		'as'   => 'degreedel'
		]);

		Route::get('/district/create',[
		'uses' => 'Admin\GeneralSettingsController@createDistrict',
		'as'   =>  'district.create'
		]);

		Route::post('/district/create',[
		'uses' => 'Admin\GeneralSettingsController@districtProcess',
		'as'   => 'district.process'
		]);

		Route::get('/certificate/create',[
		'uses' => 'Admin\GeneralSettingsController@createCertificate',
		'as'   =>  'certificate.create'
		]);
		
		Route::post('/certificate/create',[
		'uses' => 'Admin\GeneralSettingsController@certificateProcess',
		'as'   => 'certificate.process'
		]);

		Route::get('/subjectscsv',[
		'uses' => 'Admin\SubjectsController@subjectcsv',
		'as'   => 'subjectcsv'
		]);

		Route::post('/subjectscsvpost',[
		'uses' => 'Admin\SubjectsController@subjectscsvpost',
		'as'   => 'subjectscsvpost'
		]);

		Route::get('/examcsv',[
		'uses' => 'Admin\ExamsController@examcsv',
		'as'   => 'examcsv'
		]);

		Route::post('/examcsvpost',[
		'uses' => 'Admin\ExamsController@examcsvpost',
		'as'   => 'examcsvpost'
		]);

		Route::get('/centrecsv',[
		'uses' => 'Admin\ExamsController@centrecsv',
		'as'   => 'centrecsv'
		]);

		Route::post('/centrecsvpost',[
		'uses' => 'Admin\ExamsController@centrecsvpost',
		'as'   => 'centrecsvpost'
		]);

		Route::get('/secrecyuser',[
		'uses' => 'Admin\SecrecyUsersController@create',
		'as'   => 'secrecyuser.create'
		]);

		Route::post('/secrecyuser',[
		'uses' => 'Admin\SecrecyUsersController@store',
		'as'   => 'secrecyuser.store'
		]);

		Route::get('/secrecyuserinactive/{id}',[
		'uses' => 'Admin\SecrecyUsersController@userinactive',
		'as'   => 'secrecyuserinactive'
		]);

		Route::get('/secrecyuseractive/{id}',[
		'uses' => 'Admin\SecrecyUsersController@useractive',
		'as'   => 'secrecyuseractive'
		]);

		/*Export old students records via csv*/

		Route::get('/export/students',[
			'uses' => 'Admin\ExportsController@exportStudents',
			'as'   => 'export.students'
		]);

		Route::post('/export/students',[
			'uses' => 'Admin\ExportsController@exportStudentsProcess',
			'as'   => 'export.students-process'
		]);

		Route::get('/export/rollno',[
			'uses' => 'Admin\ExportsController@exportRollnos',
			'as'   => 'export.rollno'
		]);

		Route::post('/export/rollno',[
			'uses' => 'Admin\ExportsController@exportRollnosProcess',
			'as'   => 'export.rollno-process'
		]);

		Route::get('/export/rollnoCom',[
			'uses' => 'Admin\ExportsController@exportRollnoComDets',
			'as'   => 'export.rollno-comdets'
		]);

		Route::post('/export/rollnoCom',[
			'uses' => 'Admin\ExportsController@exportRollnoComDetsProcess',
			'as'   => 'export.rollno-comdets-process'
		]);

		Route::get('/database/importTxt',[
			'uses' => 'Admin\ExportsController@dbImportTxt',
			'as'   => 'database.import-txt'
		]);

		Route::post('/database/importTxt',[
			'uses' => 'Admin\ExportsController@dbImportTxtProcess',
			'as'   => 'database.import-txt-Process'
		]);

		Route::get('/database/exportTxt',[
			'uses' => 'Admin\ExportsController@dbExportTxt',
			'as'   => 'database.export-txt'
		]);

		Route::get('/profile',[
			'uses' => 'Admin\GeneralSettingsController@adminProfile',
			'as'   => 'admin.profile'
		]);
		Route::post('/profile',[
			'uses' => 'Admin\GeneralSettingsController@adminProfileUpdate',
			'as'   => 'admin.profile-update'
		]);


});

/*
	/ --------------------------------------
	/ Secrecy Users Routes Controlling Section
	/ --------------------------------------
*/

Route::group(['middleware' => ['XSS']], function () {
  	Route::get('/login/secrecyuser',[
		'uses' => 'Admin\SecrecyUsersController@loginSecrecyUser',
		'as'   => 'secrecyuser.login'
	]);
	Route::post('/login/secrecyuser', [
		'uses'=>  'Admin\SecrecyUsersController@secrecyUserAuth',
		'as'  =>  'secrecyuser.login'
	]);
});






Route::group([ 'prefix'=>'secrecy','middleware'=>['auth:secrecyuser', 'disablepreventback','XSS']], function(){

		Route::get('/secdashboard',[
				'uses' => 'Admin\SecrecyUsersController@home',
				'as'   => 'secdashboard' 
		]);

		Route::get('/subjects/{subject}',[
				'uses' => 'Admin\SecrecyUsersController@subjectsList',
				'as'   => 'secrecy.subjectList'
		]);
		Route::get('/examcenter/{code}',[
				'uses' => 'Admin\SecrecyUsersController@examcenters',
				'as'   => 'secrecy.examcenters'
		]);

		Route::post('/examcenter/assignment',[
			'uses'  => 'Admin\SecrecyUsersController@teacherExamcenterAssigment',
			'as'    =>  'examcenter.assignment'
		]);

		Route::post('/logout',[
				'uses' => 'Admin\SecrecyUsersController@logout',
				'as'   => 'secrecyuser.logout'
		]);

});		

/*
	/ --------------------------------------
	/ Special Users Routes Controlling Section
	/ --------------------------------------
*/

Route::group(['middleware' => ['XSS']], function () {

		Route::get('/login/specialuser',[
			'uses' => 'Admin\SpecialUsersController@loginSpecialUser',
			'as'   => 'specialuser.login'
		]);

		Route::post('/login/specialuser', [
		'uses'=>  'Admin\SpecialUsersController@specialUserAuth',
		'as'  =>  'specialuser.login'
		]);
});

Route::group([ 'prefix'=>'special','middleware'=>'auth:specialuser','XSS'], function(){

		Route::get('/sdashboard',[
				'uses' => 'Admin\SpecialUsersController@home',
				'as'   => 'sdashboard' 
		]);

		Route::get('/createstaff',[
				'uses' => 'Front\Staff\StaffsController@create',
				'as'   => 'createstaff'

		]);
		Route::post('/staffpost',[
				'uses' => 'Front\Staff\StaffsController@store',
				'as'   => 'staffpost'

		]);

		Route::get('/staffuserinactive/{id}',[
		'uses' => 'Front\Staff\StaffsController@staffuserinactive',
		'as'   => 'staffuserinactive'
		]);

		Route::get('/staffuseractive/{id}',[
		'uses' => 'Front\Staff\StaffsController@staffuseractive',
		'as'   => 'staffuseractive'
		]);

		Route::get('/college/teachers',[
		'uses' => 'Admin\SpecialUsersController@teachersList',
		'as'   => 'college.teachers'
		]);

		Route::get('/teacheractive/{id}',[
		'uses' => 'Admin\SpecialUsersController@teacheractive',
		'as'   => 'teacheractive'
		]);
		Route::get('/teacherinactive/{id}',[
		'uses' => 'Admin\SpecialUsersController@teacherinactive',
		'as'   => 'teacherinactive'
		]);

		Route::get('/degreeadmin',[
				'uses' => 'Front\DegAdmin\DegreesAdminsController@create',
				'as'   => 'degreeadmin'

		]);
		Route::post('/degreeadmin',[
				'uses' => 'Front\DegAdmin\DegreesAdminsController@store',
				'as'   => 'degreeadmin'

		]);

		Route::get('/degreeadmin/assignment',[
				'uses' => 'Front\DegAdmin\DegreesAdminsController@degreeAdminAssignment',
				'as'   => 'degree.admin-assignment'

		]);

		Route::post('/degreeadmin/assignment',[
				'uses' => 'Front\DegAdmin\DegreesAdminsController@degreeAdminAssignmentProcess',
				'as'   => 'degree.admin-assignment-process'

		]);

		Route::get('/degadmininactive/{id}',[
		'uses' => 'Front\DegAdmin\DegreesAdminsController@degadmininactive',
		'as'   => 'degadmininactive'
		]);

		Route::get('/degadminactive/{id}',[
		'uses' => 'Front\DegAdmin\DegreesAdminsController@degadminactive',
		'as'   => 'degadminactive'
		]);

		Route::post('/logout',[
				'uses' => 'Admin\SpecialUsersController@logout',
				'as'   => 'specialuser.logout'
		]);
});

/*
	/ --------------------------------------
	/ College Degree Admins Routes Controlling Section
	/ --------------------------------------
*/
Route::group(['middleware' => ['XSS']], function () {
	Route::get('/login/degadmin',[
		'uses' => 'Front\DegAdmin\DegreesAdminsController@loginDegAdmin',
		'as'   => 'degadmin.login'
	]);

	Route::post('/login/degadmin', [
		'uses'=>  'Front\DegAdmin\DegreesAdminsController@DegAdminAuth',
		'as'  =>  'degadmin.login'
	]);
});
Route::group([ 'prefix'=>'degAdmin','middleware'=>'auth:degAdmin','XSS'], function(){

		Route::get('/degAdmindashboard',[
				'uses' => 'Front\DegAdmin\DegreesAdminsController@home',
				'as'   => 'degAdmindashboard' 
		]);

		Route::get('/crossTabDegrees',[
				'uses' => 'Front\DegAdmin\DegreesAdminsController@crossTabDegrees',
				'as'   => 'crossTabDegrees' 
		]);

		Route::get('/crossTabDegrees/pdf/{degrees}',[
				'uses' => 'Front\DegAdmin\DegreesAdminsController@crossTabDegreesPdf',
				'as'   => 'crossTabDegreespdf' 
		]);

		Route::get('/degree/semester/{degree}',[
			'uses'  => 'Front\DegAdmin\DegreesAdminsController@degreesSemesters',
			'as'    =>  'degAdmin.degrees.semesters'

		]);
		Route::get('/semester/subjects/{semester}/{degree}',[
			'uses'  => 'Front\DegAdmin\DegreesAdminsController@semesterSubjects',
			'as'    =>  'semester.subjects'

		]);

		Route::get('/degree/student/{degree}/{department}',[
			'uses'  => 'Front\DegAdmin\DegreesAdminsController@degreesStudents',
			'as'    =>  'degAdmin.student.degrees'

		]);

		Route::post('/subject/assignment',[
			'uses'  => 'Front\DegAdmin\DegreesAdminsController@teacherSubjectAssigment',
			'as'    =>  'subject.assignment'
		]);

		Route::post('/logout',[
				'uses' => 'Front\DegAdmin\DegreesAdminsController@logout',
				'as'   => 'degAdmin.logout'
		]);
});		



/*
	/ --------------------------------------
	/ Teacher Routes Controlling Section
	/ --------------------------------------
*/
Route::group(['middleware' => ['XSS']], function () {
	Route::get('/teachers/registration',[
		'uses' => 'Front\TeachersController@create',
		'as'   => 'teacher.create'
	]);

	Route::post('/register/teacher', [
		'uses'  => 'Front\TeachersController@registerTeachers',
		'as'    => 'register.teacher'
	]);

	Route::post('/login/teacher', [
		'uses' => 'Front\TeachersController@TeacherAuth',
		'as'   => 'teacher.login',
	]);
});

Route::group([ 'prefix'=>'teacher','middleware'=>'auth:teacher','XSS'], function(){
		
		
		Route::post('/logout/teacher',[ 
			'uses'  =>'Front\TeachersController@logout',
			'as'    => 'teacher.logout',
		]);

		Route::get('/tdashboard',[
			'uses' => 'Front\TeachersController@home',
			'as'   => 'tdashboard' 
		]);
		Route::get('/subject/forty/{subject}/{code}', [
			'uses'  => 'Front\TeachersController@subjectforty',
			'as'    => 'subject.forty'

		]);

		Route::post('/subject/forty', [
			'uses'  => 'Front\TeachersController@subjectfortyprocess',
			'as'    => 'subject.fortyprocess'

		]);
	
});

/*
	/ --------------------------------------
	/ Student Routes Controlling Section
	/ --------------------------------------
*/
Route::group(['middleware' => ['XSS']], function () {
	Route::get('/student/registration',[
		'uses' => 'Front\StudentsController@create',
		'as'   => 'student.create'
	]);

	Route::post('/register/student', [
			'uses'  => 'Front\StudentsController@registerStudents',
			'as'    => 'register.student'
	]);

	Route::get('/student/login',[
			'uses' => 'Front\StudentsController@studentLogin',
			'as'   => 'login.student'
	]);

	Route::get('/student/email-verify/{id}/{regno}',[
			'uses' => 'Front\StudentsController@emailVerify',
			'as'   => 'student-email-verify'
	]);

	Route::post('/login/student', [
		'uses' => 'Front\StudentsController@StudentAuth',
		'as'   => 'student.login',
	]);

	Route::post('/student/college/degree',[
		'uses'  => 'Front\StudentsController@checkCollegesDegrees',
		'as'    => 'check.college.degrees'
	]);
});

Route::group([ 'prefix'=>'student','middleware'=>['auth:student','protectStudentLogin','XSS']], function(){
		
		
		Route::post('/logout/student',[ 
			'uses'  =>'Front\StudentsController@logout',
			'as'    => 'student.logout',
		]);
		Route::get('/stddashboard',[
				'uses' => 'Front\StudentsController@home',
				'as'   => 'stddashboard' 
		]);

		Route::get('/enrolled/exams',[
			'uses'  =>'Front\StudentsController@ViewEnrolledExams',
			'as'    => 'student.enrolled-exams',
		]);

		/*Route::get('/enrolled/exams/{rollno}/{examcode}',[
			'uses'  =>'Front\StudentsController@ViewExamCodes',
			'as'    => 'student.examcodes',
		]);*/

		Route::get('/datesheet/{examid}/{examcode}/{exam}',[
			'uses'  =>'Front\StudentsController@ViewStudentDateSheet',
			'as'    => 'student.datesheet',
		]);
		Route::get('/dmc',[
			'uses'  =>'Front\StudentsController@ViewStudentDMC',
			'as'    => 'student.dmc',
		]);
		Route::get('/apply/rechecking',[
			'uses'  =>'Front\StudentsController@ViewStudentApplyForRechecking',
			'as'    => 'student.apply-Rechecking',
		]);


	
});

/*
	/ --------------------------------------
	/ Clerks Routes Controlling Section
	/ --------------------------------------
*/
Route::group(['middleware' => ['XSS']], function () {
	Route::get('/login/clerk',[
		'uses' => 'Front\Staff\StaffsController@clerkLogin',
		'as'   => 'clerk.login'
	]);

	Route::post('/login/clerk', [
		'uses'=>  'Front\Staff\StaffsController@clerkAuth',
		'as'  =>  'clerk.login'
	]);

	Route::get('/loginfirst/clerk',[
		'uses' => 'Front\Staff\StaffsController@clerkFirstLogin',
		'as'   => 'clerk.firstlogin'
	]);

	Route::post('/loginfirst/clerk',[
		'uses' => 'Front\Staff\StaffsController@clerkFirstProcess',
		'as'   => 'clerk.first.login.process'
	]);
});

Route::group([ 'prefix'=>'clerk','middleware'=>'auth:clerk','XSS'], function(){
		
		
		Route::post('/logout/clerk',[ 
			'uses'  =>'Front\Staff\StaffsController@logout',
			'as'    => 'clerk.logout',
		]);

		Route::get('/degree/student/{degree}/{department}',[
			'uses'  => 'Front\Staff\StaffsController@degreesStudents',
			'as'    =>  'clerk.student.degrees'

		]);

		Route::post('/studentinactive',[
		'uses' => 'Front\Staff\StaffsController@studentinactive',
		'as'   => 'studentinactive'
		]);

		Route::post('/studentactive',[
		'uses' => 'Front\Staff\StaffsController@studentactive',
		'as'   => 'studentactive'
		]);

		Route::get('/cdashboard',[
				'uses' => 'Front\Staff\StaffsController@home',
				'as'   => 'cdashboard' 
		]);
});