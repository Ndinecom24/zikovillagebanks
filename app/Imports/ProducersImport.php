<?php

namespace App\Imports;

use App\Models\Producers;
use Maatwebsite\Excel\Concerns\ToModel;

class ProducersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Producers([
            //
        ]);
    }
}
