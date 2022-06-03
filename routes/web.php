<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExternalController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MessController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolAdminController;
use App\Http\Controllers\SchoolEmployeeAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', [ExternalController::class,'index'])->name('/');
Route::view('about', 'about');
Route::get('course', [ExternalController::class, 'course'])->name('course');
Route::get('course-details/{courseslug}', [ExternalController::class, 'courseSingle'])->name('course-details');
Route::view('events', 'events');
Route::view('gallery', 'gallery');
Route::view('contact', 'contact');
Route::view('register', 'register');
Route::view('verification', 'verification');
Route::view('login', 'login');
Route::view('blog', 'blog');
Route::view('teacher', 'teacher');
Route::get('thankyou', [ExternalController::class, 'thankyou'])->name('thankyou');
Route::get('login', [ExternalController::class, 'login'])->name('login');
Route::get('gallery',[ExternalController::class,'gallery'])->name('gallery');
Route::get('events',[ExternalController::class, 'events'])->name('events');
Route::post('enquiryContact', [ExternalController::class,'enquiryContact'])->name('enquiryContact');
Route::get('mediupload',[MediaController::class, 'uploadMedia'])->name('mediupload');
Route::post('mediupload',[MediaController::class, 'uploadMedia'])->name('mediupload');

//Student Modules Start
Route::post('studentRegister', [StudentController::class, 'studentRegister'])->name('studentRegister');
Route::post('getotp', [StudentController::class, 'studentGetOTP'])->name('getotp');
Route::post('studentLogin', [StudentController::class, 'studentLogin'])->name('studentLogin');
Route::get('student/logout', [StudentController::class, 'studentLogout'])->name('student/logout');
Route::group(['middleware'=>['StudentAuthCheck']], function(){
    Route::get('student/home', [StudentController::class, 'studentHome'])->name('student.home');
    Route::get('student/applyforexam', [StudentController::class, 'applyforexam'])->name('student.applyforexam');
    Route::get('student/view-profile', [StudentController::class, 'viewProfile'])->name('student.view-profile');
    Route::get('student/update-profile', [StudentController::class, 'updateProfile'])->name('student.update-profile');
    Route::get('student/change-password', [StudentController::class, 'changePassword'])->name('student.change-password');
    Route::post('student/change-password', [StudentController::class, 'changeOldPassword'])->name('student.change-password');
    Route::post('getClassAmount', [StudentController::class, 'getClassAmount'])->name('getClassAmount');
    Route::post('student/entranceExam', [StudentController::class, 'studentEntranceExam'])->name('student.entranceExam');
    Route::post('studentAdmissionApply', [StudentController::class, 'studentAdmissionApply'])->name('studentAdmissionApply');
    Route::get('student/admission-form', [StudentController::class, 'studentAdmissionForm'])->name('student.admission-form');
    Route::get('student/admission-fee', [StudentController::class, 'studentAdmissionFee'])->name('student.admission-fee');
    Route::get('student/admit-card', [StudentController::class, 'studentAdmitCard'])->name('student.admit-card');
    Route::get('student/entrance-exam-preview/{tokenno}', [StudentController::class, 'studentEntranceExamPreview'])->name('student.entrance-exam-preview.{tokenno}');
    Route::post('student.entranceExamEdit', [StudentController::class, 'studentEntranceExamEdit'])->name('student.entranceExamEdit');
    Route::post('student.entrance-final-submit', [StudentController::class, 'studentEntranceFinalSubmit'])->name('student.entrance-final-submit');
    Route::get('student/entrance-form-receiept/{form_id}', [StudentController::class, 'studentEntranceFinalReceipt'])->name('student/entrance-form-receiept/{form_id}');
    Route::get('student/edit-details/{token_no}', [StudentController::class, 'editStudentDetails'])->name('student/edit-details/{token_no}');
    Route::post('getPassportPhoto', [StudentController::class, 'getPassportPhoto'])->name('getPassportPhoto');
    Route::post('getAadharCard', [StudentController::class, 'getAadharCard'])->name('getAadharCard');
    Route::post('getFatherAadharCard', [StudentController::class, 'getFatherAadharCard'])->name('getFatherAadharCard');
    Route::post('getMarkSheet', [StudentController::class, 'getMarkSheet'])->name('getMarkSheet');
    Route::get('generateAdmitCardPDF', [StudentController::class, 'generateAdmitCardPDF'])->name('generateAdmitCardPDF');
    Route::post('getClassNames', [StudentController::class, 'getClassNames'])->name('getClassNames');
    Route::post('getBatchTime', [StudentController::class, 'getBatchTime'])->name('getBatchTime');
    Route::post('getAdmissionFee', [StudentController::class, 'getAdmissionFee'])->name('getAdmissionFee');
    Route::post('admissionPayment', [StudentController::class, 'admissionPaymentPai'])->name('admissionPayment');
    Route::get('student/admission-receiept/{studentid}', [StudentController::class, 'studentAdmissionReceipt'])->name('student/admission-receiept/{studentid}');
    Route::get('student/admission-payment-receipt/{studentid}', [StudentController::class, 'studentAdmissionPaymentReceipt'])->name('student/admission-payment-receiept/{studentid}');
    Route::get('student/admission', [StudentController::class, 'studentAdmission'])->name('student/admission');
});
//Student Modules End

//School Admin Modules Start
Route::get('schooladmin/login', [SchoolAdminController::class, 'login'])->name('schooladmin/login');
Route::get('schooladmin/logout', [SchoolAdminController::class, 'schoolAdminLogout'])->name('schooladmin/logout');
Route::post('schooladminLogin', [SchoolAdminController::class, 'schooladminLogin'])->name('schooladminLogin');

Route::group(['middleware'=>['SchoolAdminAuthCheck']], function(){
    Route::get('schooladmin/home', [SchoolAdminController::class, 'schoolAdminHome'])->name('schooladmin/home');
    Route::get('schooladmin/student-list', [SchoolAdminController::class, 'studentList'])->name('schooladmin/student-list');
    Route::get('schooladmin/addclass', [SchoolAdminController::class, 'addClass'])->name('schooladmin/addclass');
    Route::post('uploadClass', [SchoolAdminController::class, 'uploadClass'])->name('uploadClass');
    Route::get('schooladmin/class-list', [SchoolAdminController::class, 'classList'])->name('schooladmin/class-list');
    Route::get('schooladmin/form-pending', [SchoolAdminController::class, 'schoolAdminFormPending'])->name('schooladmin/form-pending');    
    Route::post('getAadharCard', [SchoolAdminController::class, 'getAadharCard'])->name('getAadharCard');
    Route::post('getFatherAadharCard', [SchoolAdminController::class, 'getFatherAadharCard'])->name('getFatherAadharCard');
    Route::post('getMarkSheet', [SchoolAdminController::class, 'getMarkSheet'])->name('getMarkSheet');
    Route::post('entranceApprove', [SchoolAdminController::class, 'entranceApprove'])->name('entranceApprove');
    Route::post('entranceRejected', [SchoolAdminController::class, 'entranceRejected'])->name('entranceRejected');
    Route::get('schooladmin/setSchedule', [SchoolAdminController::class, 'setSchedule']);
    Route::post('schooladmin/exam_schedules', [SchoolAdminController::class, 'Exam_schedules'])->name('schooladmin.exam_schedules');
    Route::get('schooladmin/schedulelist', [SchoolAdminController::class, 'scheduleList'])->name('schooladmin.schedulelist');
    Route::get('schooladmin/addschool', [SchoolAdminController::class, 'addSchool'])->name('schooladmin/addschool');
    Route::post('uploadSchool', [SchoolAdminController::class, 'uploadSchool'])->name('uploadSchool');
    Route::get('schooladmin/school-list', [SchoolAdminController::class, 'schoolList'])->name('schooladmin/school-list');
    Route::get('schooladmin/add-academic-year', [SchoolAdminController::class, 'addAcademicYear'])->name('schooladmin/add-academic-year');
    Route::post('uploadAcademicYear', [SchoolAdminController::class, 'uploadAcademicYear'])->name('uploadAcademicYear');
    Route::get('schooladmin/add-batch-time', [SchoolAdminController::class, 'addBatch'])->name('schooladmin.add-batch-time');
    Route::post('uploadBatchTime', [SchoolAdminController::class, 'uploadBatchTime'])->name('uploadBatchTime');
    Route::get('schooladmin/fix-admission-fee', [SchoolAdminController::class, 'fixAdmissionFee'])->name('schooladmin.fix-admission-fee');
	Route::get('schooladmin/admission-fee-list', [SchoolAdminController::class, 'admissionsFeeList'])->name('schooladmin.admission-fee-list');
    Route::post('uploadAdmissionFee', [SchoolAdminController::class, 'uploadAdmissionFee'])->name('uploadAdmissionFee');
    Route::get('schooladmin/add-employee', [SchoolAdminController::class, 'addEmployee'])->name('schooladmin.add-employee');
    Route::post('uploadEmployeeData', [SchoolAdminController::class, 'uploadEmployeeData'])->name('uploadEmployeeData');
    Route::post('uploadTeacherData', [SchoolAdminController::class, 'uploadTeacherData'])->name('uploadTeacherData');
    Route::get('schooladmin/teacher-category', [SchoolAdminController::class, 'teacherCategory'])->name('schooladmin.teacher-category');
    Route::post('uploadTeacherCategory', [SchoolAdminController::class, 'uploadTeacherCategory'])->name('uploadTeacherCategory');
    Route::get('schooladmin/add-teacher', [SchoolAdminController::class, 'addTeacher'])->name('schooladmin.add-teacher');
    Route::get('schooladmin/entrance-result', [SchoolAdminController::class, 'entranceResult'])->name('schooladmin.entrance-result');
    Route::get('schooladmin/entranceExamResult', [SchoolAdminController::class, 'entranceExamResult'])->name('schooladmin.entranceExamResult');
    Route::post('schooladmin/saveEnteranceResult', [SchoolAdminController::class, 'saveEnteranceResult'])->name('schooladmin.saveEnteranceResult');
    Route::post('getSchoolClassName', [SchoolAdminController::class, 'getSchoolClassName'])->name('getSchoolClassName');
    Route::get('schooladmin/schoolemployeelist', [SchoolAdminController::class, 'schoolemployeeList'])->name('schooladmin.schoolemployeeList');
    Route::get('schooladmin/admission-list', [SchoolAdminController::class, 'admissionList'])->name('schooladmin.admission-list');
    Route::get('schooladmin/admission-details/{$id}', [SchoolAdminController::class, 'studentAdmissionDetails'])->name('schooladmin/admission-details/{$id}');
});

//School Admin Modules End

//School Employee Modules Start
Route::get('schoolemployee/login', [SchoolEmployeeAdmin::class, 'schoolEmployeeLogin'])->name('schoolemployee.login')->middleware('AlreadySchoolEmployeeLogged');;
Route::get('schoolemployee/logout', [SchoolEmployeeAdmin::class, 'schoolEmployeeLogout'])->name('schoolemployee.logout');
Route::post('schoolemployeeLogin', [SchoolEmployeeAdmin::class, 'schoolEmployeeLoginSection'])->name('schoolemployeeLogin')->middleware('AlreadySchoolEmployeeLogged');;
Route::group(['middleware'=>['SchoolEmployeeAuthCheck']], function(){
    Route::get('schoolemployee/home', [SchoolEmployeeAdmin::class, 'schoolEmployeeHome'])->name('schoolemployee.home');
    Route::get('schoolemployee/student-view', [SchoolEmployeeAdmin::class, 'studentView'])->name('schoolemployee.student-view');
    Route::get('schoolemployee/add-teacher', [SchoolEmployeeAdmin::class, 'addTeacher'])->name('schoolemployee.add-teacher');
    Route::post('schoolemployee/uploadTeacherData', [SchoolEmployeeAdmin::class, 'uploadTeacherData'])->name('schoolemployee.uploadTeacherData');
    Route::get('schoolemployee/teacher-list', [SchoolEmployeeAdmin::class, 'teacherList'])->name('schoolemployee.teacher-list');
    Route::get('schoolemployee/view-profile', [SchoolEmployeeAdmin::class, 'viewProfile'])->name('schoolemployee.view-profile');
    Route::get('schoolemployee/manage-room', [SchoolEmployeeAdmin::class, 'manageRoom'])->name('schoolemployee.manage-room');
    Route::post('schoolemployee.manageRoomBed', [SchoolEmployeeAdmin::class, 'manageRoomBed'])->name('schoolemployee.manageRoomBed');
    Route::get('schoolemployee/admit-student', [SchoolEmployeeAdmin::class, 'admitStudent'])->name('schoolemployee.admit-student');
    Route::get('schoolemployee/view-student-details', [SchoolEmployeeAdmin::class, 'viewStudentDetails'])->name('schoolemployee.view-student-details');
    Route::post('schoolemployee/admitInHostel', [SchoolEmployeeAdmin::class, 'admitInHostel'])->name('schoolemployee.admitInHostel');
    Route::get('schoolemployee/receive-hostel-fee', [SchoolEmployeeAdmin::class, 'receiveHostelFee'])->name('schoolemployee.receive-hostel-fee');
    Route::get('schoolemployee/getPaymentDetails', [SchoolEmployeeAdmin::class, 'getPaymentDetails'])->name('schoolemployee.getPaymentDetails');
    Route::post('schoolemployee/receiveHostelPayment', [SchoolEmployeeAdmin::class, 'receiveHostelPayment'])->name('schoolemployee.receiveHostelPayment');
    //Rana routes
    Route::get('schoolemployee/hostel-student-list', [SchoolEmployeeAdmin::class, 'hostelStudentLists'])->name('schoolemployee.hostel-student-list');
    Route::get('schoolemployee/add-course', [SchoolEmployeeAdmin::class, 'addCourse'])->name('schoolemployee.add-course');
    Route::get('schoolemployee/course-list', [SchoolEmployeeAdmin::class, 'courseList'])->name('schoolemployee.course-list');
    Route::post('schoolemployee/uploadCourseDetails', [SchoolEmployeeAdmin::class, 'uploadCourseDetails'])->name('schoolemployee/uploadCourseDetails');
    
    Route::get('schoolemployee/add-event', [SchoolEmployeeAdmin::class, 'addEvent'])->name('schoolemployee.add-event');
    Route::get('schoolemployee/event-list', [SchoolEmployeeAdmin::class, 'eventList'])->name('schoolemployee.event-list');
    Route::post('schoolemployee/deleteEvent', [SchoolEmployeeAdmin::class, 'deleteEvent'])->name('schoolemployee/deleteEvent');
    Route::post('schoolemployee/uploadEvent', [SchoolEmployeeAdmin::class, 'uploadEvent'])->name('schoolemployee/uploadEvent');
    Route::get('schoolemployee/add-gallery', [SchoolEmployeeAdmin::class, 'addGallery'])->name('schoolemployee.add-gallery');
    Route::get('schoolemployee/gallery-list', [SchoolEmployeeAdmin::class, 'galleryList'])->name('schoolemployee.gallery-list');
    Route::post('schoolemployee/deleteGalleryImage', [SchoolEmployeeAdmin::class, 'deleteGalleryImage'])->name('schoolemployee.deleteGalleryImage');
    Route::post('schoolemployee/uploadGalleryImage', [SchoolEmployeeAdmin::class, 'uploadGalleryImage'])->name('schoolemployee.uploadGalleryImage');
    Route::get('schoolemployee/add-notice', [SchoolEmployeeAdmin::class, 'addNotice'])->name('schoolemployee.add-notice');
    Route::get('schoolemployee/notice-list', [SchoolEmployeeAdmin::class, 'noticeList'])->name('schoolemployee.notice-list');
    Route::post('schoolemployee/uploadNotice', [SchoolEmployeeAdmin::class, 'uploadNotice'])->name('schoolemployee.uploadNotice');
    Route::post('schoolemployee/deleteNotice', [SchoolEmployeeAdmin::class, 'deleteNotice'])->name('schoolemployee.deleteNotice');
    
    Route::get('schoolemployee/enquiry-list', [SchoolEmployeeAdmin::class, 'enquiryList'])->name('schoolemployee.enquiry-list');
    Route::get('schoolemployee/emailsubscription-list', [SchoolEmployeeAdmin::class, 'emailsubscriptionList'])->name('schoolemployee.emailsubscription-list');
    Route::get('schoolemployee/addclass', [SchoolEmployeeAdmin::class, 'addClass'])->name('schoolemployee/addclass');
    Route::post('schoolemployee/uploadClass', [SchoolEmployeeAdmin::class, 'uploadClass'])->name('schoolemployee.uploadClass');
    Route::get('schoolemployee/class-list', [SchoolEmployeeAdmin::class, 'classList'])->name('schoolemployee/class-list');

    Route::get('schoolemployee/schedulelist', [SchoolEmployeeAdmin::class, 'scheduleList'])->name('schoolemployee.schedulelist');
    Route::get('schoolemployee/addschool', [SchoolEmployeeAdmin::class, 'addSchool'])->name('schoolemployee/addschool');
    Route::post('schoolemployee/uploadSchool', [SchoolEmployeeAdmin::class, 'uploadSchool'])->name('schoolemployee.uploadSchool');
    Route::get('schoolemployee/school-list', [SchoolEmployeeAdmin::class, 'schoolList'])->name('schoolemployee/school-list');
    Route::get('schoolemployee/add-academic-year', [SchoolEmployeeAdmin::class, 'addAcademicYear'])->name('schoolemployee/add-academic-year');
    Route::get('schoolemployee/fix-admission-fee', [SchoolEmployeeAdmin::class, 'fixAdmissionFee'])->name('schoolemployee.fix-admission-fee');
    Route::get('schoolemployee/admission-fee-list', [SchoolEmployeeAdmin::class, 'admissionFeeList'])->name('schoolemployee.fix-admission-fee-list');
    Route::post('schoolemployee/uploadAdmissionFee', [SchoolEmployeeAdmin::class, 'uploadAdmissionFee'])->name('schoolemployee.uploadAdmissionFee');
    // Mess Management Start
    Route::get('schoolemployee/mess/admit-student', [MessController::class, 'messAdmitStudent'])->name('schoolemployee.mess.admit-student');
    Route::get('schoolemployee/mess/mess-student-list', [MessController::class, 'messStudentList'])->name('schoolemployee.mess.mess-student-list');
    Route::get('schoolemployee/mess/view-student-details', [MessController::class, 'messViewStudentDetails'])->name('schoolemployee.mess.view-student-details');
    Route::post('schoolemployee/mess/admitInMess', [MessController::class, 'admitInMess'])->name('schoolemployee.mess.admitInMess');
    Route::get('schoolemployee/mess/create-manage-mess-menu', [MessController::class, 'messCreateManageMessMenu'])->name('schoolemployee.mess.create-menage-mess-menu');
    Route::post('schoolemployee/mess/insertDish', [MessController::class, 'insertDish'])->name('schoolemployee.mess.insertDish');
    Route::get('schoolemployee/mess/assign-mess-menu', [MessController::class, 'messAssignMessMenu'])->name('schoolemployee.mess.assign-mess-menu');
    Route::post('schoolemployee/mess/assignMessMenu', [MessController::class, 'assignMessMenu'])->name('schoolemployee.mess.assignMessMenu');
    Route::get('schoolemployee/mess/add-stock', [MessController::class, 'messAddStock'])->name('schoolemployee.mess.add-stock');
    Route::post('schoolemployee/mess/insertMessStock', [MessController::class, 'insertMessStock'])->name('schoolemployee.mess.insertMessStock');
    Route::get('schoolemployee/mess/stock-list', [MessController::class, 'stockList'])->name('schoolemployee.mess.stock-list');
    Route::get('schoolemployee/mess/expense-stock', [MessController::class, 'messExpenseStock'])->name('schoolemployee.mess.expense-stock');
    Route::get('schoolemployee/mess/meal-report', [MessController::class, 'messMealReport'])->name('schoolemployee.mess.meal-report');
    Route::get('schoolemployee/mess/daily-meal', [MessController::class, 'messDailyMeal'])->name('schoolemployee.mess.daily-meal');
    Route::get('schoolemployee/mess/mess-bills', [MessController::class, 'messBills'])->name('schoolemployee.mess.mess-bills');
    Route::get('schoolemployee/mess/mess-fee', [MessController::class, 'messFee'])->name('schoolemployee.mess.mess-fee');
    Route::get('schoolemployee/mess/messFeeSearch', [MessController::class, 'messFeeSearch'])->name('schoolemployee.mess.messFeeSearch');
    Route::post('schoolemployee/mess/receiveMessPayment', [MessController::class, 'receiveMessPayment'])->name('schoolemployee.mess.receiveMessPayment');
    Route::get('schoolemployee/mess/mess-fee-details', [MessController::class, 'messFeeDetails'])->name('schoolemployee.mess.mess-fee-details');
    Route::get('schoolemployee/mess/messFeeDetails', [MessController::class, 'messFeeDetailsGet'])->name('schoolemployee.mess.messFeeDetails');
    Route::get('schoolemployee/mess/mess-attendance', [MessController::class, 'messAttendance'])->name('schoolemployee.mess.mess-attendance');
    Route::get('schoolemployee/mess/messAttendanceShow', [MessController::class, 'messAttendanceShow'])->name('schoolemployee.mess.messAttendanceShow');
    Route::post('schoolemployee/mess/makeAttendance', [MessController::class, 'makeAttendance'])->name('schoolemployee.mess.makeAttendance');
    // Mess Management End

});
//School Employee Modules End

// Employee Modules Start
Route::get('employee/login',[EmployeeController::class,'login'])->name('employee.login')->middleware('AlreadyLoggedEmployee');
Route::post('employee/login',[EmployeeController::class,'EmployeeAuthLogin'])->name('employee.login')->middleware('AlreadyLoggedEmployee');

Route::group(['middleware'=>['EmployeeAuthCheck']], function(){
    Route::get('employee/home', [EmployeeController::class, 'employeeHome'])->name('employee.home');
    Route::get('employee/logout', [EmployeeController::class, 'employeeLogout'])->name('employee/logout');
    Route::get('employee/ongoing-project', [EmployeeController::class, 'onGoingProject'])->name('employee/ongoing-project');
    Route::get('employee/view-project-details', [EmployeeController::class, 'viewProjectDetailsOn'])->name('employee/view-project-details');
    Route::get('employee/project-image-details/{projectid}/{userid}/{id}', [EmployeeController::class, 'projectImageDetails'])->name('employee/project-image-details/{projectid}/{userid}/{id}');
    Route::post('employee/upload-comment', [EmployeeController::class, 'uploadComment'])->name('employee.upload-comment');
    Route::get('employee/change-password',[EmployeeController::class,'changePassword'])->name('employee.change-password');
    Route::post('employee.change-password', [EmployeeController::class, 'employeeChangePassword'])->name('employee.change-password');
});
// Employee Modules End


// Dashboard Modules Start
Route::get('distributor/login',[DistributorController::class,'login'])->name('distributor.login')->middleware('AlreadyLoggedDistributor');
Route::post('distributor/login',[DistributorController::class,'distributorAuthLogin'])->name('distributor.login')->middleware('AlreadyLoggedDistributor');

Route::group(['middleware'=>['DistributorAuthCheck']], function(){
    Route::get('distributor/home', [DistributorController::class, 'distributorHome'])->name('distributor.home');
    Route::get('distributor/user-list',[DistributorController::class,'userList'])->name('distributor.user-list');
    Route::get('distributor/create-project',[DistributorController::class,'createProject'])->name('distributor.create-project');
    Route::get('distributor/project-list',[DistributorController::class,'projectList'])->name('distributor.project-list');
    Route::get('distributor/view-project',[DistributorController::class,'viewProject'])->name('distributor.view-project');
    Route::get('distributor/view-profile', [DistributorController::class,'viewProfile'])->name('distributor.view-profile');
    Route::get('distributor/project-request',[DistributorController::class,'projectRequest'])->name('distributor.project-request');

    Route::post('getImageDetails',[DistributorController::class, 'getImageDetails'])->name('getImageDetails');
    Route::post('getVideoDetails',[DistributorController::class, 'getVideoDetails'])->name('getVideoDetails');
    Route::get('distributor/ongoing-project', [DistributorController::class, 'ongoingProject'])->name('distributor.ongoing-project');
    Route::get('distributor/view-project-details', [DistributorController::class, 'viewProjectDetails'])->name('distributor.view-project-details');
    Route::get('distributor/completed-project', [DistributorController::class, 'completedProject'])->name('distributor.completed-project');
    Route::get('distributor/logout', [DistributorController::class, 'distributorLogout'])->name('distributor/logout');
    Route::post('distributor/project-approve', [DistributorController::class, 'distributorProjectApprove'])->name('distributor.project-approve');
    Route::get('distributor/project-request-details',[DistributorController::class, 'projectRequestDetails'])->name('distributor/project-request-details');
    Route::post('distributor/project-request-details',[DistributorController::class, 'projectRequestDetails'])->name('distributor/project-request-details');
    Route::post('giveProjectAccess',[DistributorController::class, 'giveProjectAccess'])->name('giveProjectAccess');
    
});
// Dashboard Modules End

// Admin Modules Start
Route::get('admin/auth/login', [AdminController::class, 'login'])->name('admin.auth.login')->middleware('AlreadyLoggedIn');
Route::post('adminAuthLogin', [AdminController::class, 'adminAuthLogin'])->name('adminAuthLogin')->middleware('AlreadyLoggedIn');

//User Register
// Route::view('user/register','registers');
Route::get('user/login',[UserController::class,'login'])->name('user.login')->middleware('AlreadyLoggedUser');
Route::post('user/login',[UserController::class,'userAuthLogin'])->name('user.login')->middleware('AlreadyLoggedUser');
Route::get('user/registers',[UserController::class,'registers']);
Route::post('getcategoryname', [AdminController::class, 'getcategoryname'])->name('getcategoryname');
Route::post('user/registration', [UserController::class, 'registerUser'])->name('user.registration');
Route::get('user/mailVerification/{code}/{userid}', [UserController::class, 'verifyUser'])->name('user.mailVerification.{code}.{userid}');

Route::group(['middleware'=>['UserAuthCheck']], function(){
    Route::get('user/home', [UserController::class, 'userHome']);
    Route::get('user/work-list',[UserController::class,'workList']);
    Route::get('user/work-details',[UserController::class,'workDetails']);
    Route::post('user/work-details', [UserController::class, 'workDetails'])->name('user.workdetails');
    Route::get('user/applied-project',[UserController::class,'appliedProject']);
    Route::post('applyForProject', [UserController::class, 'applyForProject'])->name('applyForProject');
    Route::get('user/my-project',[UserController::class,'myProject']);
    Route::get('user/mywallet', [UserController::class, 'myWallet'])->name('user.myWallet');
    // Route::get('user/upload-image',[UserController::class,'uploadImage']);
    Route::get('user/upload-image',[UserController::class,'uploadImage'])->name('user/upload-image');
    Route::get('user/upload-video',[UserController::class,'uploadVideo']);
    Route::get('user/view-profile',[UserController::class,'viewProfile']);
    Route::post('user/update-profile', [UserController::class, 'updateProfileData'])->name('user.update-profile');
    Route::get('user/update-profile',[UserController::class,'updateProfile']);
    Route::post('user/user-profile-update', [UserController::class, 'userProfileUpdate'])->name('user.user-profile-update');
    Route::get('user/change-password',[UserController::class,'changePassword']);
    Route::get('user/logout', [UserController::class, 'userLogout'])->name('user/logout');
    Route::post('user/postrequest', [UserController::class, 'userPostRequest'])->name('user.postrequest');
    Route::post('uploadUserImage',[UserController::class, 'uploadUserImage'])->name('uploadUserImage');
    Route::get('user/viewProjectDetails',[UserController::class, 'viewProjectDetails'])->name('user/viewProjectDetails');
    Route::get('user/bank-details',[UserController::class,'bankDetails']);
    Route::get('user/fetch-bank-details',[UserController::class,'fetchBankDetails'])->name('user.fetch-bank-details');
    Route::post('user/update-bank-details',[UserController::class,'updateBankDetails'])->name('user.update-bank-details');
    Route::post('user/change-password', [UserController::class, 'userPasswordChange'])->name('user.change-password');
});

// Route::get('distributor/login', [DistributorController::class, 'login']);

Route::group(['middleware'=>['AdminAuthCheck']], function () {
    
    // Route::get('distributor/home', [DistributorController::class, 'distributorHome'])->name('distributor.home');
    // Route::get('distributor/project-request',[DistributorController::class,'projectRequest'])->name('distributor.project-request');
    // Route::get('distributor/user-list',[DistributorController::class,'userList'])->name('distributor.user-list');
    // Route::get('distributor/create-project',[DistributorController::class,'createProject'])->name('distributor.create-project');
    // Route::get('distributor/project-list',[DistributorController::class,'projectList'])->name('distributor.project-list');
    // Route::get('distributor/view-project',[DistributorController::class,'viewProject'])->name('distributor.view-project');

    Route::get('admin/home', [AdminController::class, 'adminHome'])->name('admin.home');
    Route::get('admin/projectreport', [AdminController::class, 'projectReport'])->name('admin.projectreport');
    Route::get('admin/add-student', [AdminController::class, 'addStudent'])->name('admin.add-student');
    Route::get('admin/view-student', [AdminController::class, 'viewStudent'])->name('admin.view-student');
    Route::get('admin/update-student', [AdminController::class, 'updateStudent'])->name('admin.update-student');
    Route::get('admin/remove-student', [AdminController::class, 'removeStudent'])->name('admin.remove-student');
    Route::get('admin/student-list', [AdminController::class, 'studentList'])->name('admin.student-list');

    Route::get('admin/add-distributor', [AdminController::class, 'addDistributor'])->name('admin.add-distributor');
    Route::get('admin/view-distributor', [AdminController::class, 'viewDistributor'])->name('admin.view-distributor');
    Route::post('admin/view-distributor', [AdminController::class, 'viewDistributor'])->name('admin.view-distributor');
    Route::get('admin/update-distributor/{distributorid}', [AdminController::class, 'updateDistributor'])->name('admin.update-distributor.{distributorid}');
    Route::get('admin/distributor-list', [AdminController::class, 'distributorList'])->name('admin.distributor-list');
    Route::post('uploadDistributorData',[AdminController::class, 'uploadDistributorData'])->name('uploadDistributorData');
    Route::post('updateDistributorData', [AdminController::class, 'updateDistributorData'])->name('updateDistributorData');
    Route::post('admin/removeDistributor', [AdminController::class, 'removeDistributor'])->name('admin.removeDistributor');
    Route::post('admin/unBlockDistributor', [AdminController::class, 'unBlockDistributor'])->name('admin.unBlockDistributor');
    
    Route::get('admin/user-list', [AdminController::class, 'userList'])->name('admin.user-list');
    Route::post('blockUserContract', [AdminController::class, 'blockUserContract'])->name('blockUserContract');
    Route::post('unBlockUserContract', [AdminController::class, 'unBlockUserContract'])->name('unBlockUserContract');
    Route::post('getuserdetails', [AdminController::class, 'getuserdetails'])->name('getuserdetails');
    Route::post('disApproveContractor', [AdminController::class, 'disApproveContractor'])->name('disApproveContractor');
    Route::post('approveContractor', [AdminController::class, 'approveContractor'])->name('approveContractor');
    
    Route::get('admin/create-project', [AdminController::class, 'createProject'])->name('admin.create-project');
    Route::get('admin/create-project-category', [AdminController::class, 'createProjectCategory'])->name('admin.create-project-category');
    Route::get('admin/project-list', [AdminController::class, 'projectList'])->name('admin.project-list');
    Route::get('admin/project-category-list', [AdminController::class, 'projectCategoryList'])->name('admin.project-category-list');
    Route::post('uploadProjectCategory', [AdminController::class, 'uploadProjectCategory'])->name('uploadProjectCategory');
    Route::post('uploadProjectData', [AdminController::class, 'uploadProjectData'])->name('uploadProjectData');
    Route::post('getamountofproject', [AdminController::class, 'getamountofproject'])->name('getamountofproject');
    Route::post('getProjectName', [AdminController::class, 'getProjectName'])->name('getProjectName');

    Route::get('admin/add-employee', [AdminController::class, 'addEmployee'])->name('admin.add-employee');
    Route::get('admin/view-employee', [AdminController::class, 'viewEmployee'])->name('admin.view-employee');
    Route::post('admin/view-employee', [AdminController::class, 'viewEmployee'])->name('admin.view-employee');
    Route::get('admin/update-employee/{employeeid}', [AdminController::class, 'updateEmployee'])->name('admin.update-employee.{employeeid}');
    Route::get('admin/employee-list', [AdminController::class, 'employeeList'])->name('admin.employee-list');
    Route::post('addEmployee', [AdminController::class, 'addEmployeeData'])->name('addEmployee');
    Route::post('updateEmployee', [AdminController::class, 'updateEmployeeData'])->name('updateEmployee');

    Route::get('admin/create-company',[AdminController::class,'createCompany'])->name('admin.create-company');
    Route::get('admin/company-list',[AdminController::class,'companyList'])->name('admin.company-list');
    Route::get('admin/view-company',[AdminController::class,'viewCompany'])->name('admin.view-company');
    Route::post('admin/viewcompany',[AdminController::class,'viewCompany'])->name('admin.viewcompany');
    Route::get('admin/update-company/{companyid}',[AdminController::class,'updateCompany'])->name('admin.update-company.{companyid}');
    Route::post('admin/create-company', [AdminController::class,'createHtrustCompany'])->name('admin.create-company');
    Route::post('admin/update-company', [AdminController::class,'updateHtrustCompany'])->name('admin.update-company');

    Route::get('admin/add-course', [AdminController::class, 'addCourse'])->name('admin.add-course');
    Route::get('admin/course-list', [AdminController::class, 'courseList'])->name('admin.course-list');

    Route::get('admin/add-event', [AdminController::class, 'addEvent'])->name('admin.add-event');
    Route::get('admin/event-list', [AdminController::class, 'eventList'])->name('admin.event-list');
    Route::post('deleteEvent', [AdminController::class, 'deleteEvent'])->name('deleteEvent');

    Route::get('admin/add-gallery', [AdminController::class, 'addGallery'])->name('admin.add-gallery');
    Route::get('admin/gallery-list', [AdminController::class, 'galleryList'])->name('admin.gallery-list');
    Route::post('deleteGalleryImage', [AdminController::class, 'deleteGalleryImage'])->name('deleteGalleryImage');

    Route::get('admin/add-notice', [AdminController::class, 'addNotice'])->name('admin.add-notice');
    Route::get('admin/notice-list', [AdminController::class, 'noticeList'])->name('admin.notice-list');

    Route::get('admin/enquiry-list', [AdminController::class, 'enquiryList'])->name('admin.enquiry-list');
    Route::get('admin/emailsubscription-list', [AdminController::class, 'emailsubscriptionList'])->name('admin.emailsubscription-list');

    Route::get('admin/reset-password', [AdminController::class, 'resetPassword'])->name('admin.reset-password');

    Route::get('admin/add-slider', [AdminController::class, 'addSlider'])->name('admin.add-slider');
    Route::get('admin/slider-list', [AdminController::class, 'sliderList'])->name('admin.slider-list');
    Route::get('admin/update-logo', [AdminController::class, 'updateLogo'])->name('admin.update-logo');
    Route::get('admin/contact-details', [AdminController::class, 'updateContactDetails'])->name('admin.contact-details');
    Route::get('admin/social-media', [AdminController::class, 'socialMediaLinks'])->name('admin.social-media');
    Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('uploadHeaderLogo', [AdminController::class, 'uploadHeaderLogo'])->name('uploadHeaderLogo');
    Route::post('uploadFooterLogo', [AdminController::class, 'uploadFooterLogo'])->name('uploadFooterLogo');
    Route::post('uploadFaviconLogo', [AdminController::class, 'uploadFaviconLogo'])->name('uploadFaviconLogo');
    Route::post('uploadContactDetails', [AdminController::class, 'uploadContactDetails'])->name('uploadContactDetails');
    Route::post('updateContactDetailsU', [AdminController::class, 'updateContactDetailsU'])->name('updateContactDetailsU');
    Route::post('uploadCourseDetails', [AdminController::class, 'uploadCourseDetails'])->name('uploadCourseDetails');
    Route::post('getcoursedetails', [AdminController::class, 'getcoursedetails'])->name('getcoursedetails');
    Route::post('uploadsociallinks', [AdminController::class, 'uploadSocialLinks'])->name('uploadsociallinks');
    Route::post('updateSocialLinks', [AdminController::class, 'updateSocialLinks'])->name('updateSocialLinks');
    Route::post('uploadSlider', [AdminController::class, 'uploadSlider'])->name('uploadSlider');
    Route::post('updateSlider', [AdminController::class, 'updateSlider'])->name('updateSlider');
    Route::post('uploadEvent', [AdminController::class, 'uploadEvent'])->name('uploadEvent');
    Route::post('uploadGalleryImage', [AdminController::class, 'uploadGalleryImage'])->name('uploadGalleryImage');
    Route::post('uploadNotice', [AdminController::class, 'uploadNotice'])->name('uploadNotice');
});
// Admin Modules End