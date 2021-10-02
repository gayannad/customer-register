<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Customer;
use App\Repositories\CustomersRepository;
use Illuminate\Http\Request;

class CustomerAPIController extends BaseController
{
    /**
     * @var CustomersRepository
     */
    private $customersRepository;
    /**
     * @var Contact
     */
    private $contact;

    /**
     * CustomerAPIController constructor.
     * @param CustomersRepository $customersRepository
     */
    public function __construct(CustomersRepository $customersRepository, Contact $contact)
    {
        $this->customersRepository = $customersRepository;
        $this->contact = $contact;
    }

    /**
     * return customer list
     * @param Request $request
     */
    public function index(Request $request)
    {
        return $request->ajax() ? Customer::paginate(10) : abort(404);
    }

    /**
     * save customer
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nic' => 'required',
            'address' => 'required',
        ]);

        try {
            $data = $request->all();
            $customer = $this->customersRepository->saveCustomer($data);
            return $this->sendResponse($customer, 'Customer created successfully');
        } catch (\Exception $e) {
            return $this->sendError([], $e->getMessage());
        }
    }

    /**update customer
     * @param Request $request
     * @param Customer $customer
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name' => 'required',
            'nic' => 'required',
            'address' => 'required',
        ]);

        try {
            $data = $request->all();
            $this->customersRepository->update($data, $customer->id);
            return $this->sendResponse($customer, 'Customer updated successfully');
        } catch (\Exception $e) {
            return $this->sendError([], $e->getMessage());
        }
    }

    /**
     * delete customer
     * @param Customer $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return $this->sendResponse($customer, 'Customer deleted successfully');
        } catch (\Exception $e) {
            return $this->sendError([], $e->getMessage());
        }
    }

}
