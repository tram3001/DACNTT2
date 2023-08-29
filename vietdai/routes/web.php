<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\CheckLogin;

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
//login
Route::get('/login',[
    AuthController::class,'formlogin'
]);
Route::post('/login',[
    AuthController::class,'login'
]);
Route::get('/change_password',[
    AuthController::class,'change_password'
]);
Route::post('/change_password',[
    AuthController::class,'save_password'
]);
Route::get('/test',[
    BranchController::class,'test'
]);
Route::middleware('checklogin')->group(function(){
    Route::middleware('checktype')->group(function(){
        //Admin
        //Branch
        Route::name('branch')->group(function(){
            Route::get('/branch',[
                BranchController::class,'branch'
            ]);
            Route::post('/reset_password',[
                AuthController::class,'reset_pass'
            ]);
            //search branch
            Route::get('/branch/search',[
                BranchController::class,'search_branch'
            ])->name('branch.search');
            Route::post('/branch/create',[
                BranchController::class,'create_branch'
            ]);
            Route::get('/branch/{id}',[
                BranchController::class,'delete'
            ]);
            Route::post('/branch/edit',[
                BranchController::class,'edit'
            ]);
            Route::get('/branch/detail/branch={id}',[
                BranchController::class,'detail_branch'
            ]);
            Route::post('/delete_branch',[
                BranchController::class,'delete_branch'
            ]);
        });
        
        //Room
        Route::name('room')->group(function(){
            Route::get('/room',[
                BranchController::class,'room'
            ]);
            Route::get('/room/branch={id}',[
                BranchController::class,'room_branch'
            ]);
            Route::get('/room/calendar',[
                BranchController::class,'calendar_room'
            ]);
            Route::post('/room/create',[
                BranchController::class,'create_room'
            ]);
            Route::get('/room/calendar_week/branch={id}',[
                BranchController::class,'calendar_roomB'
            ]);
            Route::get('/room/calendar_week',[
                BranchController::class,'calendar_rom_week'
            ]);
            Route::get('/room/calendar_general/branch={id}',[
                BranchController::class,'calendar_rom_general'
            ]);
            //hide room
            Route::post('/hide_room',[
                BranchController::class,'hide_room'
            ]);
            // display room
            Route::post('/display_room',[
                BranchController::class,'display_room'
            ]);
            //delete room
            Route::post('/delete_room',[
                BranchController::class,'delete_room'
            ]);
            //edit room
            Route::post('/edit_room',[
                BranchController::class,'edit_room'
            ]);


        });
        //Excel all staff
        Route::name('Export')->group(function(){
            Route::post('/export/excel_staff',[
                BranchController::class,'export_staff'
            ]);
            Route::post('/import/import_staff',[
                BranchController::class,'import_staff'
            ]);
            //Excel student class
            Route::post('/export/class/excel_student',[
                StudentController::class,'export_student_class'
            ]);
            //Excel course
            Route::post('/export/excel_course',[
                CourseController::class,'export_course'
            ]);
            Route::post('/import/import_course',[
                CourseController::class,'import_course'
            ]);
            //Excel course
            Route::post('/export/excel_student',[
                StudentController::class,'export_student'
            ]);
            Route::post('/import/import_student',[
                StudentController::class,'import_student'
            ]);
        });
   
        /*********************************/
        Route::get('/logout',[
            AuthController::class,'logout'
        ]);
         //home
        Route::name('home')->group(function(){
            Route::get('/home',[
                BranchController::class,'home'
            ]);
            Route::post('/home',[
                BranchController::class,'home'
            ]);
        });
        //language
        Route::name('languages')->group(function(){
            Route::get('/language',[
                CourseController::class,'select_language'
            ]);
            //delete language
            // Route::pots('/delete_language',[
            //     CourseController::class,'delete_language'
            // ]);
        });
        //Course
        Route::name('course')->group(function () {
            Route::get('/course',[
                CourseController::class,'index'
            ]);
            Route::get('/course/search',[
                CourseController::class,'search_course'
            ]);
            // Route::get('/course/{id}',[
            //     CourseController::class,'get_language'
            // ]);
            Route::get('/course/delete_course/{id}',[
                CourseController::class,'delete_course'
            ]);
            Route::post('/course/create',[
                CourseController::class,'create'
            ]);
            Route::post('/course/create_class',[
                CourseController::class,'create_class'
            ]);
            Route::get('/course/create_class/{id}&&{course}&&{form}',[
                CourseController::class,'get_teacher'
            ]);
            
            Route::post('/course/edit',[
                CourseController::class,'edit'
            ]);
            //search course form
            // Route::get('/course/detail/',[
            //     CourseController::class,'search_course_form'
            // ]);
            //class
            Route::post('/course/create_class/confirm_class',[
                CourseController::class,'confirm_class'
            ]);
            Route::post('/course/create_class/confirm_class/save',[
                CourseController::class,'save_class'
            ]);
            //hide course
            Route::post('/hide_course',[
                CourseController::class,'hide_course'
            ]);
            //display course
            Route::post('/display_course',[
                CourseController::class,'display_course'
            ]);
            //delete course
            Route::post('/delete_course',[
                CourseController::class,'delete_course'
            ]);
        
        });
         //class
        Route::name('class')->group(function(){        
            Route::get('/class',[
                CourseController::class,'list_class'
            ]);
            Route::get('/class/id_course={id}',[CourseController::class,'detail_course']);
            Route::get('/class/search_class',[
                CourseController::class,'search_class']);
            // Route::get('/class/search',[
            //     CourseController::class,'search_class'
            // ]);
            Route::get('/class/add/{id}',[
                StudentController::class,'get'
            ]);
            Route::post('/class/add',[
                StudentController::class,'insert'
            ]);
           
           
            Route::get('/class/search',[
                CourseController::class,'search_class'
            ]);
            //filter 
            Route::get('/class/filter',[
                CourseController::class,'filter'
            ]);
            // edit class
            Route::post('/edit_class',[
                CourseController::class,'edit_class'
            ]);
            //delete class
            Route::post('/delete_class',[
                CourseController::class,'delete_class'
            ]);
            //change room
            Route::post('/change_room',[
                CourseController::class,'change_room'
            ]);

        });
    
         //test mail
        Route::get('/tinymce',[
            CourseController::class,'tinymce'
        ]);
         //calendar branch
        Route::name('calendar_branch')->group(function(){
            Route::get('/calendar_branch',[
                BranchController::class,'calendar_branch'
            ]);
            Route::get('/calendar_branch/week',[
                BranchController::class,'calendar_branch_week'
            ]);
            Route::get('/calendar_branch/branch={id}',[
                BranchController::class,'search_calendar'
            ]);
            Route::get('/general_calendar/branch={id}',[
                BranchController::class,'search_calendarB'
            ]);
            Route::get('/general_calendar',[
                BranchController::class,'general_calendar'
            ]);
        });
        //staff
        Route::name('staff')->group(function(){
            Route::get('/staff',[
                BranchController::class,'staff'
            ]);
            Route::get('/staff/create',[
                BranchController::class,'create_staff'
            ]);
            Route::post('/staff/save',[
                BranchController::class,'insert_staff'
            ]);
            Route::get('/staff/filter',[
                BranchController::class,'filter_staff'
            ]);
            Route::get('/staff/search_staff',[
                BranchController::class,'search_staff'
            ]);
            Route::get('/staff/detail/staff={id}',[
                BranchController::class,'detail_staff'
            ]);
            Route::post('/staff/detail_staff/update',[
                BranchController::class,'update_staff'
            ]);
            //edit calendar
            Route::get('/calendar/edit_calendar/staff={id}',[
                BranchController::class,'edit_calendar'
            ]);
            Route::post('/calendar/edit_calendar',[
                BranchController::class,'save_calendar'
            ]);
            //calendar
            Route::get('/calendar/staff={id}',[
                BranchController::class,'calendar'
            ]);
            //calendar week
            Route::get('/calendar/staff/week',[
                BranchController::class,'calendar_week'
            ]);
            //calendar general
            Route::get('/calendar/general/staff={id}',[
                BranchController::class,'general_calendar_staff'
            ]);
            //staff list class
            Route::get('/staff/list_class/staff={id}',[
                CourseController::class,'list_class_staff'
            ]);
          
            //hide teacher
            Route::post('/hide_teacher',[
                BranchController::class,'hide_teacher'
            ]);
            //list hide teacher
            Route::get('/staff/hide',[
                BranchController::class,'list_hide_teacher'
            ]);
            ///display_teacher
            Route::post('/display_teacher',[
                BranchController::class,'display_teacher'
            ]);
            //search hide teacher
            Route::get('/staff/hide/search_staff',[
                BranchController::class,'search_hide_teacher'
            ]);
           
        });
        Route::name('student')->group(function(){
            Route::get('/student',[
                StudentController::class,'select_all'
            ]);
            Route::get('/student/branch={id}',[
                StudentController::class,'select_branch'
            ]);
            Route::get('/student/detail_student/{id}',[
                StudentController::class,'detail_student'
            ]);
            Route::post('/student/detail_student',[
                StudentController::class,'update_student'
            ]);
            //search 
            Route::get('/student/search_student',[
            StudentController::class,'search_all' 
            ]);
            //student
            Route::post('/student/save',[
                StudentController::class,'create'
            ]);
            //insert_student enter class
            Route::get('/class/insert_student/class={id}',[
                StudentController::class,'insert_student'
            ]);
            Route::get('/class/insert_student/search',[
                StudentController::class,'search_addstudent'
            ]);

            Route::post('/class/insert_student/add',[
                StudentController::class,'add_student'
            ]);
            Route::post('/student/branch/save',[
                StudentController::class,'save_studentBranch'
            ]);
            Route::post('/delete_student',[
                StudentController::class,'delete_student'
            ]);
        
    
        });
    });
    Route::name('staff')->group(function(){
        Route::get('/staff/detail/staff={id}',[
            BranchController::class,'detail_staff'
        ]);
    });
    Route::name('calendar_branch')->group(function(){
        //calendar week
        Route::get('/calendar/staff/week',[
            BranchController::class,'calendar_week'
        ]);
        //calendar general
        Route::get('/calendar/general/staff={id}',[
            BranchController::class,'general_calendar_staff'
        ]);
        //staff list class
       
    });
    Route::name('class')->group(function(){
        Route::get('/staff/list_class/staff={id}',[
            CourseController::class,'list_class_staff'
        ]);
        Route::get('/class/detail_class/class={id}',[
            StudentController::class,'select'
        ]);
        Route::get('/class/detail_class/search_student',[
            StudentController::class,'search'
        ]);
        Route::get('/staff/list_class/search',[
            CourseController::class,'list_class_search'
        ]);
          //filter class staff
          Route::get('/staff/list_class/filter',[
            CourseController::class,'list_class_filter'
        ]);
      

    });

    
});
