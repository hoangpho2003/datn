<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(ContactRequest $contactRequest)
    {
        $data = $contactRequest->validated();

        try {
            $contact = new Contact();
            $contact->name = $data['name'];
            $contact->email = $data['email'];
            $contact->phone = $data['phone'];
            $contact->comment = $data['comment'];
            $contact->save();

            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('errorr', 'Your message has been error!');
        }
    }
}
