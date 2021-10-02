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

    public function index(Request $request)
    {
        return $request->ajax() ? Customer::paginate(2) : abort(404);
//        return $this->sendResponse($customers, '');
    }

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

    public function destroy(Customer $customer)
    {

    }

    public function search(Request $request){
        $key = $request->search;
        $customers = Customer::where('name','LIKE','%'.$key.'%')
            ->get();
        return response()->json([ 'customers' => $customers ],200);
    }
}
