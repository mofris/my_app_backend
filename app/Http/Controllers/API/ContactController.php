<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        $contact = Contact::all();

        if ($contact) {
            return response()->json([
                'success' => true,
                'data' => $contact,
                'message' => 'Get Data Successfuly!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Get Data Failed!'
            ]);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'number' => 'required',
        ]);

        $contact = Contact::create($validated);

        if ($contact) {
            return response()->json([
                'success' => true,
                'data' => $contact,
                'message' => 'Successfuly'
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Failed'
            ], 404);
        }
    }

    public function show($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $contact
        ]);
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json([
                'success' => false,
                'message' => 'Not found',
                'data' => null
            ], 404);
        }

        $contact->update($request->only(['name', 'number']));

        if ($contact) {
            return response()->json([
                'success' => true,
                'data' => $contact,
                'message' => 'Successfuly'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Failed'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(
                [
                    'success' => false,
                    'data' => null,
                    'message' => 'Not found'
                ],
                404
            );
        }

        $contact->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Contact deleted successfully'
        ], 200);
    }
}
