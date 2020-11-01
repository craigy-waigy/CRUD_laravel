<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Contractor;
use App\Customer;
use App\Helpers\CrmHelper;
use App\Services\ContractService;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    protected $contractService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->contractService = new contractService();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::with(['contractor', 'customer'])
            ->orderBy('contract_date')
            ->paginate(CrmHelper::PER_PAGE);

        return view('contract.index', [
            'contracts' => $contracts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contractors = Contractor::all();
        $customers = Customer::all();

        return view('contract.create',
            compact('contractors', 'customers')
        );
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

        $success = $this->contractService->create($request);

        if ($success) {

            return redirect()->route('contract.index', [$this->contractService->getLastPage()])
                ->with('success', 'Запись добавлена');

        } else {

            return redirect()->route('contract.index')->with('error', 'Ошибка добавления записи');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        $contractors = Contractor::all();
        $customers = Customer::all();

        return view('contract.edit', compact('contract', 'contractors', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Contract $contract
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Contract $contract)
    {
        $this->validateRequest($request);

        $success = $this->contractService->update($request, $contract);

        if ($success) {

            return redirect()->back()->with('success', 'Запись обновлена');

        } else {

            return redirect()->back()->with('error', 'Ошибка обновления записи');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract $contract
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Contract $contract)
    {
        $success = $this->contractService->delete($contract);

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
            'amount' => 'required|integer|min:1',
            'contractor_id' => 'required|integer',
            'customer_id' => 'required|integer',
            'contract_date' => 'required|date|date_format:Y-m-d',
        ], [
            'name.required' => 'Укажите название контракта',
            'amount.required' => 'Укажите сумму контракта',
            'contractor_id.required' => 'Выберите подрядчика из списка',
            'customer_id.required' => 'Выберите заказчика из списка',
            'contract_date.required' => 'Укажите дату контракта',
            'contract_date.date_format' => 'Укажите дату в формате Y-m-d',
            'contract_date.date' => 'Укажите дату в формате Y-m-d',
            'amount.integer' => 'Сумма контракта должна быть целым числом',
            'amount.min' => 'Минимальная сумма контракта: 1',
            'contractor_id.integer' => 'Идентификатор подрядчика должен быть целым числом',
            'customer_id.integer' => 'Идентификатор заказчика должен быть целым числом',
        ]);
    }
}
