<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lead;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request) {

        $data = $request->all();

        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save();

        Mail::to('quaglioniandrea@gmail.com')->send(new NewContact($newLead));
    }
}
