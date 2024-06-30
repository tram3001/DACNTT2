<?php
namespace App\Exports;
use App\Models\CourseModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class CourseExport implements FromCollection,WithHeadings,ShouldAutoSize,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
    
        return CourseModel::select("id","name", "language","period","price")->get();
     
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Mã lớp","Tên khóa học", "Ngôn ngữ","Số buổi","Học phí"];
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