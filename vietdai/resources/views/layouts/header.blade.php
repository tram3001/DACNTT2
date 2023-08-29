<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
        crossorigin="anonymous">
    
    <link href="https://www.flaticon.com/blog/your-path-to-uicons/css/uicons-regular-rounded.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    
  </head>
  <body>
    <header>
        <div class="inner-header container">
            <button id='menu' onclick="btnsidebar()"><img src="{{asset('storage/menu.png')}}" style="width:100%"></button>
        </div>
        <div class="avatar">
            <a style="font-size: 15px" href="/change_password">{{Auth::user()->name}}<img src="{{asset('storage/user.png')}}" style="width:40px;margin-left:5px" alt=""></a>
            
        </div>
    </header>
    <div id="bg" class="bgsidebar" style="display: block;" style="margin-top:0px">
       <div class="row">
        <div class="col-lg-12 ">
            <table class="sidebar">
                @if (Auth::user()->type!=2)
                    {{-- <tr>
                        <a class="fi-icon" > </a>
                        <td class="td_sidebar"><a class="a_sidebar" style="text-decoration: none;" ><i class="fi fi-rr-home fi-header" style="color: rgb(115, 137, 216);"></i>Trang chủ hệ thống</a></td>
                    </tr> --}}
                    <tr><td class="td_sidebar @if(Route::currentRouteName() =='branch' ) active @endif"><a class="a_sidebar"style="text-decoration: none;" href="/branch">
                        <i class="fi fi-rr-home-location-alt  fi-header" style=" color: rgb(115, 137, 216);"></i>Quản lý chi nhánh
                        </a>
                    </td></tr>
                    <tr><td class="td_sidebar @if(Route::currentRouteName() =='room' ) active @endif"><a class="a_sidebar" href="/room" style="text-decoration: none;">
                        <i class="fi fi-rr-chair-office fi-header"style="color: rgb(115, 137, 216);"></i>Quản lý phòng học
                        </a>
                    </td></tr>
                    <tr>
                        <td class="td_sidebar @if(Route::currentRouteName() =='languages' ) active @endif" >
                            <a class="a_sidebar" href="/language" style="text-decoration: none;">
                                <i class="fi fi-rr-language fi-header" style="color: rgb(115, 137, 216);"></i>
                                Quản lý ngôn ngữ
                            </a><br>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="td_sidebar @if(Route::currentRouteName() =='course' ) active @endif" >
                            <a class="a_sidebar" href="/course" style="text-decoration: none;">
                                <i class="fi fi-rr-graduation-cap fi-header" style="color: rgb(115, 137, 216);"></i>
                                Quản lý khóa học
                            </a><br>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="td_sidebar @if(Route::currentRouteName() =='class' ) active @endif">
                            <a class="a_sidebar" href="/class" style="text-decoration: none;">
                                <i class="fi fi-rr-e-learning fi-header" style="color: rgb(115, 137, 216);"></i>
                                Quản lý Lớp học
                            </a><br>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="td_sidebar @if(Route::currentRouteName() =='calendar_branch' ) active @endif">
                            <a class="a_sidebar" href="/calendar_branch" style="text-decoration: none;">
                                <i class="fi fi-rr-calendar-days fi-header" style="color: rgb(115, 137, 216);"></i>
                                Quản lý lịch làm việc
                            </a><br>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="td_sidebar @if(Route::currentRouteName() =='staff' ) active @endif">
                            <a class="a_sidebar" href="/staff"style="text-decoration: none;">
                                <i class="fi fi-rr-following  fi-header" style="color: rgb(115, 137, 216);"></i>
                                Quản lý giáo viên
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_sidebar @if(Route::currentRouteName() =='student' ) active @endif">
                            <a class="a_sidebar" href="/student" style="text-decoration: none;">
                                <i class="fi fi-rr-book-open-reader  fi-header" style="color: rgb(115, 137, 216);"></i>
                                Quản lý học viên
                            </a>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td class="td_sidebar @if(Route::currentRouteName() =='staff' ) active @endif">
                            <a class="a_sidebar" href="/student" style="text-decoration: none;">
                                <i class="fi fi-rr-book-open-reader  fi-header" style="color: rgb(115, 137, 216);"></i>
                                Thông tin cá nhân
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_sidebar @if(Route::currentRouteName() =='calendar_branch' ) active @endif">
                            <a class="a_sidebar" href="/calendar/staff/week" style="text-decoration: none;">
                                <i class="fi fi-rr-calendar-days fi-header" style="color: rgb(115, 137, 216);"></i>
                               Lịch làm việc
                            </a><br>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="td_sidebar @if(Route::currentRouteName() =='class' ) active @endif">
                            <a class="a_sidebar" href="/staff/list_class/staff={id}" style="text-decoration: none;">
                                <i class="fi fi-rr-e-learning fi-header" style="color: rgb(115, 137, 216);"></i>
                                Quản lý Lớp học
                            </a><br>
                            
                        </td>
                    </tr>
                    
                @endif
               
                <tr><td class="td_sidebar"><a class="a_sidebar" href="/logout"style="text-decoration: none;">
                    <i class="fi fi-rr-exit  fi-header" style="color: rgb(115, 137, 216);"></i>
                   Đăng xuất</a>
                </td></tr>
                
            </table>
        </div>
       </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

   
   
