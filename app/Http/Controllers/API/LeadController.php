<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead;
use App\Mail\NewLeadEmail;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $lead = Lead::create($request->all());

        Mail::to('info@boolpress.com')->send(new NewLeadEmail($lead));

        return response()->json(
            [
                'success' => true,
                'message' => 'Il messaggio è stato inviato correttamente 👍'
            ]
            );
    }
}
