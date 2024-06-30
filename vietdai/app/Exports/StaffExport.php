<?php
namespace App\Exports;
use App\Models\StaffModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class StaffExport implements FromCollection,WithHeadings,WithColumnWidths,ShouldAutoSize,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
       return StaffModel::select("name", "sex","date_birthday","address","address1","phone","email","cccd","form_work","id_branch","languages","calendar")->get();

    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Họ và tên", "Giới tính","Ngày tháng năm sinh","Quê quán","Địa chỉ liên hệ","Số điện thoại","Email","CCCD/CMND","Hình thức làm việc","Chi nhánh","Bộ môn giảng dạy","Lịch làm việc"];
    }
    public function columnWidths(): array
    {
        return ['L'=>50];
    }
    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet->getStyle('L1:L'.$sheet->getHighestRow())->getAlignment()->setWrapText(true);
        
    }
    
}