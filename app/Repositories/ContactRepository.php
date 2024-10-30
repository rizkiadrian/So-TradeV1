<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    protected $model;

    /**
     * Constructor.
     * 
     * @param Contact $model The contact model that will be used to interact with the database.
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new contact.
     * 
     * This method creates a new contact if one does not already exist with the given email.
     * 
     * @param object $data Data to use for creating the contact. At least 'full_name', 'email', 'phone_number', 'subject', and 'message' must be present.
     * 
     * @return Contact
     */
    public function create($data): Contact
    {
        return $this->model->firstOrCreate(
            [
                'full_name' => $data->full_name,
                'email' => $data->email,
                'phone_number' => $data->phone_number,
                'subject' => $data->subject,
                'message' => $data->message

            ]
        );
    }
}
