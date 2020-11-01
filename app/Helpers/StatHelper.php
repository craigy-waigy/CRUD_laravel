<?php

namespace App\Helpers;

use App\Contract;
use Illuminate\Support\Facades\DB;

class StatHelper
{
    public static function getContractStatByMonths()
    {

        return Contract::select(
            DB::raw('sum(amount) as `sums`'),
            DB::raw("DATE_FORMAT(contract_date,'%Y.%m') as months")
        )
            ->groupBy('months')
            ->orderBy('months')
            ->get()
            ->pluck('months', 'sums')
            ->toArray();
    }
}