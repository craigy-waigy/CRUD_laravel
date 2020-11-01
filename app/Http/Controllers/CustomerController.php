<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Helpers\CrmHelper;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->customerService = new CustomerService();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(CrmHelper::PER_PAGE);

        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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

        $success = $this->customerService->create($request);

        if ($success) {

            return redirect()->route('customer.index', [$this->customerService->getLastPage()])->with('success', 'Запись добавлена');

        } else {

            return redirect()->back()->with('error', 'Ошибка добавления записи');
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Customer $customer
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validateRequest($request);

        $success = $this->customerService->update($request, $customer);

        if ($success) {

            return redirect()->back()->with('success', 'Запись обновлена');

        } else {

            return redirect()->back()->with('error', 'Ошибка обновления записи');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer $customer
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Customer $customer)
    {
        $success = $this->customerService->delete($customer);

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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
        ], [
            'first_name.required' => 'Укажите имя заказчика',
            'last_name.required' => 'Укажите фамилию заказчика',
            'phone.required' => 'Укажите телефон заказчика',
        ]);
    }
}
