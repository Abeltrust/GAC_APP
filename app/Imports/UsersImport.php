<?php

namespace App\Imports;

use App\Models\UserApi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class UsersImport implements ToModel,WithHeadingRow,WithValidation,WithProgressBar
{

    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        return new UserApi([
            'name'=>$row['name'],
            'email'=>$row['email'],
            'phone'=>$row['phone'],
            'yoc'=>$row['yoc'],
            'scn'=>$row['scn'],
        ]);
    }

    public function rules(): array
    {
        return [
            // '*.phone' => ['unique:user_apis'],
            // '*.email' => ['unique:user_apis'],
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
