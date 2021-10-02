<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Repositories\CustomersRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * @var CustomersRepository
     */
    private $customersRepository;

    /**
     * CustomerController constructor.
     * @param CustomersRepository $customersRepository
     */
    public function __construct(CustomersRepository $customersRepository)
    {
        $this->customersRepository = $customersRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Customers/CustomerList', [
            'customers' => $this->customersRepository->searchCustomers($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Customers/CustomerList', [
            'customers' => $this->customersRepository->searchCustomers($request)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nic' => 'required',
            'address' => 'required',
            "phone_numbers"    => "required|array",
            "phone_numbers.*"  => "required|string",
        ]);

        try {
            $this->customersRepository->saveCustomer($request->toArray());
            return redirect()->route('customers.index')->banner('Customer created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('subscriptions')->dangerBanner('Subscription cancellation failed.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
