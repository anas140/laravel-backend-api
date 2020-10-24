<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class ProductsImport implements ToModel, WithValidation, WithHeadingRow
{


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name'  => $row['name'],
            'price' => $row['price'],
            'sku'   => $row['sku'],
            'description' => $row['description']
        ]);
    }

    public function rules(): array
    {
        return [
            'name'  => 'required|max:255',
            'price' => 'required|numeric',
            'sku'   => 'required|unique:products,sku',
            'description' => 'required'
        ];
    }
   
}
