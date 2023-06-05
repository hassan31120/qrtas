<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest('id')->paginate(10);
        if (count($contacts) > 0) {
            return ContactResource::collection($contacts);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such contacts',
            ], 200);
        }
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            return response()->json([
                'success' => true,
                'message' => 'contact has been deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such contact',
            ], 404);
        }
    }
}
