<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lead;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request) {

        $data = $request->all();

        $myValidate = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        if($myValidate->fails()) {
            return response()->json (
                [
                    'success' => false,
                    'errors' => $myValidate->errors()
                ]
                );
        }

        $data = $request->all();

        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save();

        Mail::to('quaglioniandrea@gmail.com')->send(new NewContact($newLead));

        return response()->json([
            'success' => true
        ]);
    }
}
