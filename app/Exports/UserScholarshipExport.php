<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class UserScholarshipExport implements FromCollection, ShouldAutoSize, WithEvents, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $data;

    protected $scholarshipName;

    public function __construct(array $data, $scholarshipName)
    {
        $this->data = $data;
        $this->scholarshipName = $scholarshipName;
    }

    public function collection()
    {
        // Memproses data untuk hanya memilih kolom-kolom tertentu
        $counter = 1;
        $filteredData = collect($this->data)->map(function ($item) use (&$counter) {
            return [
                'No' => $counter++,
                'NIM' => $item['user']->nim,
                'Nama' => $item['user']->name,
                'JK' => $item['user']->jk,
                'Prodi' => $item['user']->prodi,
                'SKS' => $item['user']->total_sks,
                'IPK' => $item['user']->ipk,
                'Alamat' => $item['user']->address,
                'No.Hp' => $item['user']->no_hp,
                'Nama Bank' => $item['user']->name_bank,
                'No.Rek' => $item['user']->no_rek,
                'Nama Pada Rekening' => $item['user']->name_rek,
                'Pekerjaan Ortu' => $item['user']->job_parent,
                'Penghasilan Ortu' => $item['user']->income_parent,
            ];
        });

        return $filteredData;
    }

    public function headings(): array
    {
        return [
            [$this->scholarshipName],
            [
                'No',
                'NIM',
                'Nama Mahasiswa',
                'Jenis Kelamin',
                'Prodi',
                'Jumlah SKS',
                'IPK',
                'Alamat',
                'No. HP',
                'Nama Bank',
                'No. Rekening',
                'Nama Pada Rekening',
                'Pekerjaan Ortu',
                'Penghasilan Ortu',
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Menambahkan baris di atas heading
                $event->sheet->mergeCells('A1:N1');
                $event->sheet->setCellValue('A1', 'Daftar Kelulusan Beasiswa ' . $this->scholarshipName);

                // Mengatur style untuk baris nama beasiswa
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $event->sheet->getStyle('A2:N2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FF0FFDDD'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $event->sheet->getDelegate()->getStyle('A2:N' . ($event->sheet->getDelegate()->getHighestRow()))
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            },
        ];
    }
}
