<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterMail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            Mail::to($request->email)->send(new NewsletterMail());

            return back()->with('success', 'Mail sent successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}