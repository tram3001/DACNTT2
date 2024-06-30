<?php
namespace App\Exports\Sheets;
use App\Models\StudentModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

class StaffSheet implements FromCollection, WithTitle
{
    public function collection()
    {   
        
        return StudentModel::where('is_admin', true)->get();
    }

    public function title(): string
    {
        return 'Admins';
    }
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