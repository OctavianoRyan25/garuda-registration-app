<?php

namespace App\Exports;

use App\Models\Apply;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ApplyExport implements FromQuery, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Apply::all();
    // }

    public function query()
    {
        return Apply::with('status', 'document');
    }

    public function headings(): array
    {
        return [
            'ID',
            'No Register',
            'First Name',
            'Family Name',
            'Email',
            'Phone',
            'Nationality',
            'Passport Number',
            'Department',
            'Status',
            'Created At',
            'Updated At',
        ];
    }

    public function map($apply): array
    {
        return [
            $apply->id,
            $apply->no_register,
            $apply->document->first_name,
            $apply->document->family_name,
            $apply->document->email,
            $apply->document->phone_number,
            $apply->document->nationality,
            $apply->document->passport_number,
            $apply->document->department,
            $apply->status->name,
            $apply->created_at,
            $apply->updated_at,
        ];
    }
}
