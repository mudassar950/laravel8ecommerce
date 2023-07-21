<?php

namespace App\Imports;

use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Concerns\ToModel;

class PermissionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Permission([
            'id'     => $row[0],
            'name'     => $row[1],
            'guard_name'    => $row[2],
            'group_name'    => $row[3], 
            'created_at'    => $row[4], 
            'updated_at'    => $row[5], 
        ]);
    }
}
