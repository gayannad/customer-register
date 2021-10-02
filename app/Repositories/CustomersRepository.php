<?php


namespace App\Repositories;


use App\Models\Contact;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomersRepository extends BaseRepository
{
    /**
     * @var Customer
     */
    private $model;
    /**
     * @var Contact
     */
    private $contact;

    public function __construct(Customer $model, Contact $contact)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->contact = $contact;
    }

    public function searchCustomers($request)
    {
        return $this->model->when($request->search, function ($query, $search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->paginate(2);
    }

    public function saveCustomer($data)
    {
        $customer = $this->model->create($data);

        $contacts = $data['phone_numbers'];

        foreach ($contacts as $contact) {
            if (!is_null($contact)) {
                $this->contact->create([
                    'customer_id' => $customer->id,
                    'telephone' => $contact
                ]);
            }
        }

        return $customer;
    }
}
