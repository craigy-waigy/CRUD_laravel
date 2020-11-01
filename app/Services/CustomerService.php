<?php

namespace App\Services;

use App\Customer;
use App\Helpers\CrmHelper;
use Illuminate\Http\Request;

class CustomerService
{
    /**
     * Add record
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $success =  Customer::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'address'=> $request->get('address'),
            'phone' => $request->get('phone')
        ]);

        return $success;
    }

    /**
     * Update record
     *
     * @param Request $request
     * @param  \App\Customer $customer
     * @return mixed
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->first_name = $request->get('first_name');
        $customer->last_name = $request->get('last_name');
        $customer->address = $request->get('address');
        $customer->phone = $request->get('phone');

        $success = $customer->save();

        return $success;
    }

    /**
     * Remove record
     *
     * @param \App\Customer $customer
     * @return mixed
     * @throws \Exception
     */
    public function delete(Customer $customer)
    {
        $success = $customer->delete();

        return $success;
    }

    /**
     * Get last page param
     *
     * @return string
     */
    public function getLastPage()
    {
        return 'page=' . Customer::paginate(CrmHelper::PER_PAGE)->lastPage() ;
    }

}

