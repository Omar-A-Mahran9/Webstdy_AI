<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreContact_usRequest;
use App\Models\Contact_us;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{

    public function store(StoreContact_usRequest $request)
    {
        $contact_us = $request->validated();
        Contact_us::create($contact_us);
        return $this->success(__('Contact Us has been registered successfully'));
    }

public function reply(Request $request, $id)
{
    $request->validate([
        'reply' => 'required|string',
    ]);

    $contact = Contact_us::findOrFail($id);

    $contact->update([
        'reply' => $request->reply,
        'replied_at' => now(),
    ]);
     return redirect()
        ->route('dashboard.contact-requests.show', $contact->id)
        ->with('success', 'Reply sent successfully.');
}


}
