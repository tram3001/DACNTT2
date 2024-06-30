<?php
namespace App\Imports;
use App\Models\StudentModel;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentImport implements ToModel,WithStartRow
{
    public function model(array $row)
    {  
        if($row[0]!=''&&  $row[1]!='' &&  $row[2]!='' &&  $row[3]!='' &&  $row[4]!=''){
            $date=strtotime($row[2]);
            if(Auth::user()->type==0){
                return new StudentModel([
                    "name" =>$row[0],
                    "sex"=>$row[1],
                    "date_of_birth"=> \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]),
                    "nationality"=>$row[3],
                    "phone" =>$row[4],
                    "branch"=>$row[5]
                   
                ]);
            }else{
                return new StudentModel([
                    "name" =>$row[0],
                    "sex"=>$row[1],
                    "date_of_birth"=>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]),
                    "nationality"=>$row[3],
                    "phone" =>$row[4],
                    "branch"=>Auth::user()->branch,
                   
                ]);
            }
            
            
        }
    }
    public function startRow(): int
    {
        return 2;
    }
}

