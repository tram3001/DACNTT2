<?php
namespace App\Imports;
use App\Models\CourseModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CourseImport implements ToModel,WithStartRow
{
    public function model(array $row)
    {  
        if($row[0]!=''&&  $row[1]!='' &&  $row[2]!=''){
            return new CourseModel([
                "id"=>mb_strtoupper($row[0],"UTF-8"),
                'name' => mb_strtoupper($row[1],"UTF-8"),
                'language' => mb_strtoupper($row[2],"UTF-8"),
                'period'=>$row[3],
                "price"=>$row[4],
            ]);
            
        }
    }
    public function startRow(): int
    {
        return 2;
    }
}

