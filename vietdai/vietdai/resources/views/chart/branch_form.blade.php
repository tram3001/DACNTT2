<div class="col-lg-6 col-md-6 col-sm-6">
    <input type="text" hidden id='title' value="THỐNG KẾ SỐ LỚP HỌC THEO CHI NHÁNH" >
    <input type="text" hidden id='language' value="{{$branch_}}" >
    <input type="text" hidden id='course' value="{{$count_class}}" >
    <div class="col1" style="background: white; padding:15px">                  
        <canvas id="courseChart" style="width:100%; height:200px"></canvas>
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
    <input type="text" hidden id='title_' value="THỐNG KẾ SỐ LỚP HỌC THEO HÌNH THỨC" >
    <input type="text" hidden id='form' value="{{$form_}}" >
    <input type="text" hidden id='count' value="{{$count_form}}" >
    <div class="col1" style="background: white; padding:15px">                  
        <canvas id="countForm" style="width:100%; height:200px"></canvas>
    </div>
</div>