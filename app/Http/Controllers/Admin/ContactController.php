<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function delete($id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        return redirect()->route('admin.contacts')->with("success", 'Contact deleted successfully!');
    }
}
