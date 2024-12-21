<?php

namespace App\Exports;

use App\Models\MovementCommand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MovementCommandExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return MovementCommand::all();
    }

    public function headings(): array
    {
        return [
            "#",
            "الرقم",
            "منظم الأمر",
            "التاريخ",
            "الجهة الطالبة",
            "رقم السيارة",
            "السائق",
            "المرافق",
            "وجهة التنقل",
            "المهمة",
            "توقيت البدء",
            "توقيت الانتهاء",
            "رقم العداد بداية",
            "رقم العداد نهاية",
            "المسافة المقطوعة",
            "ملاحظات"
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
