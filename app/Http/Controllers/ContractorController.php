<?php

namespace App\Http\Controllers;

use App\Contractor;
use App\Helpers\CrmHelper;
use App\Services\ContractorService;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    protected $contractorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->contractorService = new contractorService();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractors = Contractor::paginate(CrmHelper::PER_PAGE);

        return view('contractor.index', compact('contractors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contractor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $success = $this->contractorService->create($request);

        if ($success) {

            return redirect()->route('contractor.index', [$this->contractorService->getLastPage()])
                ->with('success', 'Запись добавлена');

        } else {

            return redirect()->back()->with('error', 'Ошибка добавления записи');
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contractor $contractor
     * @return \Illuminate\Http\Response
     */
    public function edit(Contractor $contractor)
    {
        return view('contractor.edit', compact('contractor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Contractor $contractor
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Contractor $contractor)
    {
        $this->validateRequest($request);

        $success = $this->contractorService->update($request, $contractor);

        if ($success) {

            return redirect()->back()->with('success', 'Запись обновлена');

        } else {

            return redirect()->back()->with('error', 'Ошибка обновления записи');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contractor $contractor
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Contractor $contractor)
    {
        $success = $this->contractorService->delete($contractor);

        if ($success) {

            return redirect()->back()->with('success', 'Запись удалена');

        } else {

            return redirect()->back()->with('error', 'Ошибка удаления записи');
        }
    }

    /**
     * Validate request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateRequest(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Укажите наименование подрядчика',
            'phone.required' => 'Укажите телефон подрядчика',
        ]);
    }
}
