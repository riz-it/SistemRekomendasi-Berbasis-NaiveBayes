<?php

namespace App\Imports;

use App\Models\Database;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Database([
            'data_to' => $row['data_to'],
            'stock_name' => $row['stock_name'],
            'first_stock' => $row['first_stock'],
            'stock_in' => $row['stock_in'],
            'stock_out' => $row['stock_out'],
            'last_stock' => $row['last_stock'],
        ]);
    }
}
