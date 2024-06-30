<?php
namespace App\Imports;
use App\Models\StaffModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StaffImport implements ToModel,WithStartRow
{
    public function model(array $row)
    {  
        if($row[0]!=''&&  $row[1]!='' && $row[2]!=''&& $row[3]!=''&& $row[5]!='' && $row[7]!=''){
            if(Auth::user()->type==0){
                return new StaffModel([
                    'name' => $row[0],
                    'sex' => $row[1],
                    'date_birthday'=> \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]),
                    "address"=>$row[3],
                    "address1"=>$row[4],
                    "phone"=>$row[5],
                    "email"=>$row[6],
                    "cccd"=>$row[7],
                    "form_work"=>$row[8],
                    "id_branch"=>$row[9],
                    "languages"=>$row[10],
                    "calendar"=>$row[11],
                    "status"=>1
                ]);
            }else{
                return new StaffModel([
                    'name' => $row[0],
                    'sex' => $row[1],
                    'date_birthday'=> \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]),
                    "address"=>$row[3],
                    "address1"=>$row[4],
                    "phone"=>$row[5],
                    "email"=>$row[6],
                    "cccd"=>$row[7],
                    "form_work"=>$row[8],
                    "id_branch"=>Auth::user()->branch,
                    "languages"=>$row[10],
                    "calendar"=>$row[11],
                    "status"=>1
                ]);
            }
            
        }
    }
    public function startRow(): int
    {
        return 2;
    }
}

