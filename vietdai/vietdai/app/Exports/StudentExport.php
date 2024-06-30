<?php
namespace App\Exports;
use App\Models\StudentModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class StudentExport implements FromCollection,WithHeadings,ShouldAutoSize,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
        return StudentModel::select( "name", "sex","date_of_birth","nationality","phone","branch")->get();
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Họ và tên", "Giới tính","Ngày tháng năm sinh","Quốc tịch","Số điện thoại","Chi nhánh"];
    }
    // public function columnWidths(): array
    // {
    //     return ['L'=>50];
    // }
    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
        // $sheet->getStyle('L1:L'.$sheet->getHighestRow())->getAlignment()->setWrapText(true);
        
    }
    
}