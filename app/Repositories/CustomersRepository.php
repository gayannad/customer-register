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
        $this->model = $model;
        $this->contact = $contact;
    }

    public function searchCustomers($request)
    {
        return $this->model->when($request->search, function ($query, $search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->paginate(10);
    }

    public function saveCustomer($data)
    {
        $customer = $this->model->create($data);

        $contacts = ["0777123456", "0777123457"];
        foreach ($contacts as $contact) {
            $this->contact->create([
                'customer_id' => $customer->id,
                'telephone' => $contact
            ]);
        }

    }
}
