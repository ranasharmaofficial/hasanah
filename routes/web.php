<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExternalController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\UserController;
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
Route::view('blog', 'blog');
Route::view('teacher', 'teacher');
Route::get('gallery',[ExternalController::class,'gallery'])->name('gallery');
Route::get('events',[ExternalController::class, 'events'])->name('events');
Route::post('enquiryContact', [ExternalController::class,'enquiryContact'])->name('enquiryContact');
// Dashboard Modules Start

Route::get('dashboard/home', [DashboardController::class, 'home'])->name('dashboard.home');
Route::get('dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
Route::get('dashboard/auth/login', [DashboardController::class, 'login'])->name('dashboard.auth.login');
Route::get('dashboard/auth/forget-password', [DashboardController::class, 'forgetPassword'])->name('dashboard.auth.forget-password');

// Dashboard Modules End

// Admin Modules Start
Route::get('admin/auth/login', [AdminController::class, 'login'])->name('admin.auth.login')->middleware('AlreadyLoggedIn');
Route::post('adminAuthLogin', [AdminController::class, 'adminAuthLogin'])->name('adminAuthLogin')->middleware('AlreadyLoggedIn');

//User Register
// Route::view('user/register','registers');
Route::get('user/registers',[UserController::class,'registers']);
Route::get('user/login',[UserController::class,'login']);
Route::get('user/work-list',[UserController::class,'workList']);
Route::get('user/work-details',[UserController::class,'workDetails']);
Route::get('user/applied-project',[UserController::class,'appliedProject']);
Route::get('user/my-project',[UserController::class,'myProject']);
Route::get('user/upload-image',[UserController::class,'uploadImage']);
Route::get('user/upload-video',[UserController::class,'uploadVideo']);

Route::group(['middleware'=>['AdminAuthCheck']], function () {
    Route::get('distributor/project-request',[DistributorController::class,'projectRequest'])->name('distributor.project-request');
    Route::get('distributor/user-list',[DistributorController::class,'userList'])->name('distributor.user-list');
    Route::get('distributor/create-project',[DistributorController::class,'createProject'])->name('distributor.create-project');
    Route::get('distributor/project-list',[DistributorController::class,'projectList'])->name('distributor.project-list');
    Route::get('distributor/view-project',[DistributorController::class,'viewProject'])->name('distributor.view-project');

    Route::get('admin/home', [AdminController::class, 'adminHome'])->name('admin.home');
    Route::get('admin/add-student', [AdminController::class, 'addStudent'])->name('admin.add-student');
    Route::get('admin/view-student', [AdminController::class, 'viewStudent'])->name('admin.view-student');
    Route::get('admin/update-student', [AdminController::class, 'updateStudent'])->name('admin.update-student');
    Route::get('admin/remove-student', [AdminController::class, 'removeStudent'])->name('admin.remove-student');
    Route::get('admin/student-list', [AdminController::class, 'studentList'])->name('admin.student-list');

    Route::get('admin/add-distributor', [AdminController::class, 'addDistributor'])->name('admin.add-distributor');
    Route::get('admin/view-distributor', [AdminController::class, 'viewDistributor'])->name('admin.view-distributor');
    Route::get('admin/update-distributor', [AdminController::class, 'updateDistributor'])->name('admin.update-distributor');
    Route::get('admin/distributor-list', [AdminController::class, 'distributorList'])->name('admin.distributor-list');
    
    Route::get('admin/user-list', [AdminController::class, 'userList'])->name('admin.user-list');
    
    Route::get('admin/create-project', [AdminController::class, 'createProject'])->name('admin.create-project');
    Route::get('admin/create-project-category', [AdminController::class, 'createProjectCategory'])->name('admin.create-project-category');
    Route::get('admin/project-list', [AdminController::class, 'projectList'])->name('admin.project-list');

    Route::get('admin/add-employee', [AdminController::class, 'addEmployee'])->name('admin.add-employee');
    Route::get('admin/view-employee', [AdminController::class, 'viewEmployee'])->name('admin.view-employee');
    Route::get('admin/update-employee', [AdminController::class, 'updateEmployee'])->name('admin.update-employee');
    Route::get('admin/employee-list', [AdminController::class, 'employeeList'])->name('admin.employee-list');

    Route::get('admin/create-company',[AdminController::class,'createCompany'])->name('admin.create-company');
    Route::get('admin/company-list',[AdminController::class,'companyList'])->name('admin.company-list');
    Route::get('admin/view-company',[AdminController::class,'viewCompany'])->name('admin.view-company');
    Route::get('admin/update-company',[AdminController::class,'updateCompany'])->name('admin.update-company');

    Route::get('admin/view-teacher', [AdminController::class, 'viewTeacher'])->name('admin.view-teacher');
    Route::get('admin/update-teacher', [AdminController::class, 'updateTeacher'])->name('admin.update-teacher');
    Route::get('admin/remove-teacher', [AdminController::class, 'removeTeacher'])->name('admin.remove-teacher');
    Route::get('admin/teacher-list', [AdminController::class, 'teacherList'])->name('admin.teacher-list');


    Route::get('admin/receive-payment', [AdminController::class, 'receivePayment'])->name('admin.receive-payment');
    Route::get('admin/view-payment-details', [AdminController::class, 'viewPaymentDetails'])->name('admin.view-payment-details');

    Route::get('admin/view-attendance', [AdminController::class, 'viewAttendace'])->name('admin.view-attendace');
    Route::get('admin/make-attendance', [AdminController::class, 'makeAttendace'])->name('admin.make-attendace');
    Route::get('admin/set-teacher-routine', [AdminController::class, 'setTeacherRoutine'])->name('admin.set-teacher-routine');
    Route::get('admin/set-classtime-table', [AdminController::class, 'setClassTimeTable'])->name('admin.set-classtime-table');

    Route::get('admin/employee-salary', [AdminController::class, 'employeeSalary'])->name('admin.employee-salary');
    Route::get('admin/teacher-salary', [AdminController::class, 'teacherSalary'])->name('admin.teacher-salary');

    Route::get('admin/add-course', [AdminController::class, 'addCourse'])->name('admin.add-course');
    Route::get('admin/course-list', [AdminController::class, 'courseList'])->name('admin.course-list');

    Route::get('admin/add-event', [AdminController::class, 'addEvent'])->name('admin.add-event');
    Route::get('admin/event-list', [AdminController::class, 'eventList'])->name('admin.event-list');

    Route::get('admin/add-gallery', [AdminController::class, 'addGallery'])->name('admin.add-gallery');
    Route::get('admin/gallery-list', [AdminController::class, 'galleryList'])->name('admin.gallery-list');

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