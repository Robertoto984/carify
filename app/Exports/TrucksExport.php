<?php

namespace App\Exports;

use App\Models\Truck;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TrucksExport implements FromCollection, WithHeadings,WithStyles, ShouldAutoSize 
{
     public function collection()
    {
        return Truck::all();
    }

    public function headings(): array
    {
        return [
            "#",
            "النوع",
            "الصانع",
            "السنة",
            "التسجيل",
            "الموديل",
            "رقم اللوحة",
            "رقم الشاسيه",
            "رقم المحرك",
            "رقم رخصة السير",
            "تاريخ الترسيم",
            "اللون",
            "نوع الوقود",
            "عدد الركاب",
            "الوزن القائم",
            "الوزن الفارغ",
            "الحمولة",
            "رقم العداد",
            "الحالة الفنية",
            "الحالة القانونية",
            "توصيفات القطع",
            "تاريخ الإنشاء",
            "تاريخ آخر التحديث",
        ];
    }

    public function styles($sheet)
{
    $sheet->getStyle('A1:Z1000')
          ->getAlignment()
          ->setHorizontal('center')
          ->setVertical('center');

    return [
        1 => [
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => '007bff'],
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ],
    ];
}

}
