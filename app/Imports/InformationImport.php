<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Information;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InformationImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Check if any of the required fields are null
        if (is_null($row['ref_no']) ||
            is_null($row['zonename']) ||
            is_null($row['businame']) ||
            is_null($row['ownername']) ||
            is_null($row['mob']) ||
            is_null($row['busiadd'])) {
            return null;
        }

        return new Information([
            'ref_no' => $row['ref_no'],
            'zonename' => $row['zonename'],
            'businame' => $row['businame'],
            'ownername' => $row['ownername'],
            'mob' => $row['mob'],
            'busiadd' => $row['busiadd'],
        ]);
    }

    public function onError(ValidationException $e)
    {
        $errors = $e->errors();
        return redirect()->back()->withErrors($errors)->withInput();
    }
}
