<?php

namespace App\Exports;

use App\Models\Buyer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BuyersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Buyer::all();
    }

    public function headings(): array
    {
        return ["id","Name","Password", "Address","Phone Number","Buyer Category",];
    }

    public function map($buyer): array
    {
        return [
            $buyer->id,
            $buyer->name,
            $buyer->password,
            $buyer->address,
            $buyer->phone_no,
            config('constant.buyerCategory')[$buyer->buyer_category] ?? '', // Replace 'constant.buyerCategory' with your actual configuration key
        ];
    }
}
