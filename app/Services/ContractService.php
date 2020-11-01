<?php

namespace App\Services;

use App\Contract;
use App\Helpers\CrmHelper;
use Illuminate\Http\Request;

class ContractService
{
    /**
     * Add record
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $success =  Contract::create([
            'name' => $request->get('name'),
            'amount' => $request->get('amount'),
            'contractor_id' => $request->get('contractor_id'),
            'customer_id' => $request->get('customer_id'),
            'contract_date' => $request->get('contract_date'),
        ]);

        return $success;
    }

    /**
     * Update record
     *
     * @param Request $request
     * @param  \App\Contract $contract
     * @return mixed
     */
    public function update(Request $request, Contract $contract)
    {
        $contract->name = $request->get('name');
        $contract->amount = $request->get('amount');
        $contract->contractor_id = $request->get('contractor_id');
        $contract->customer_id = $request->get('customer_id');
        $contract->contract_date = $request->get('contract_date');

        $success = $contract->save();

        return $success;
    }

    /**
     * Remove record
     *
     * @param  \App\Contract $contract
     * @return mixed
     * @throws \Exception
     */
    public function delete(Contract $contract)
    {
        $success = $contract->delete();

        return $success;
    }

    /**
     * Get last page param
     *
     * @return string
     */
    public function getLastPage()
    {
        return 'page=' . Contract::paginate(CrmHelper::PER_PAGE)->lastPage() ;
    }

}

