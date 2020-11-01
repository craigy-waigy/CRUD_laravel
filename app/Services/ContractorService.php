<?php

namespace App\Services;

use App\Contractor;
use App\Helpers\CrmHelper;
use Illuminate\Http\Request;

class ContractorService
{
    /**
     * Add record
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $success =  Contractor::create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone')
        ]);

        return $success;
    }

    /**
     * Update record
     *
     * @param Request $request
     * @param  \App\Contractor $contractor
     * @return mixed
     */
    public function update(Request $request, Contractor $contractor)
    {
        $contractor->name = $request->get('name');
        $contractor->phone = $request->get('phone');

        $success = $contractor->save();

        return $success;
    }

    /**
     * Remove record
     *
     * @param  \App\Contractor $contractor
     * @return mixed
     * @throws \Exception
     */
    public function delete(Contractor $contractor)
    {
        $success = $contractor->delete();

        return $success;
    }

    /**
     * Get last page param
     *
     * @return string
     */
    public function getLastPage()
    {
        return 'page=' . Contractor::paginate(CrmHelper::PER_PAGE)->lastPage() ;
    }

}

