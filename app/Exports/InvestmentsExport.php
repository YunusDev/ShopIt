<?php

namespace App\Exports;

use App\Model\User\Investment;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvestmentsExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */


    protected $investment;

    public function __construct(array $investment)
    {
        $this->investment = $investment;
    }

    public function array(): array
    {
        return $this->investment;
    }


}
