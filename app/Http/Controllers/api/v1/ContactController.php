<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;

use App\Http\Requests\ContactRequest;

use App\Repositories\ContactRepository;

use App\Http\Responses\ApiResponse;


class ContactController extends Controller
{
    protected $contactRepository;

    public function __construct(
        ContactRepository $contactRepository
    ) {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Creates a new contact message.
     *
     * This endpoint handles the creation of a new contact message. It takes a validated ContactRequest object,
     * which has the following properties:
     * - full_name: the name of the person who is sending the message
     * - email: the email address of the person who is sending the message
     * - phone_number: the phone number of the person who is sending the message
     * - subject: the subject of the message
     * - message: the message itself
     *
     * @param ContactRequest $request Instance of App\Http\Requests\ContactRequest
     *
     * @return JsonResponse
     */
    public function create(ContactRequest $request)
    {
        // Validate the request data
        $contactData = (object) $request->validated();
        // Call a helper function to wrap our code in a transaction. If the transaction fails,
        // we will return an error to the user.
        $result = TransactionHelper::execute(function () use ($contactData) {
            // Call the ContactRepository to create a new contact message
            return $this->contactRepository->create($contactData);
        });
        // Return a successful response to the user
        return ApiResponse::success($result, 'Contact message has been created', 201);
    }
}
