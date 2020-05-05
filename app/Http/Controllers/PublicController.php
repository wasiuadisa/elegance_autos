<?php

/*
    Visitor
    Contributor
    Content Developer (Title Writer, Content Developer, Reviewer)
    Administrator
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Import requests
use App\Http\Requests\ContactUsFormRequest;

//Import the class for sending emails
use Mail;

class PublicController extends Controller
{
    /**
     * Show the application Home or landing page.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /* Get list of recent vehicles */
        $recents = (new \App\Models\Logic\Posts)->posts(4);

        return view('index', [
            'recents' => $recents,
        ]);
    }

    /**
     * Show the application About Us page.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        return view('about-us');
    }

    /**
     * Show the application Stock page.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function instock()
    {
        /* Get list of recent vehicles */
        $recents = (new \App\Models\Logic\Posts)->posts(20);

        return view('in-stock', [
            'recents' => $recents,
        ]);
    }

    /**
     * Show the application News & events page.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function news()
    {
        /* Get list of recent events */
        $recents = (new \App\Models\Logic\Events)->events(4);

        return view('news', [
            'recents' => $recents,
        ]);
    }

    /**
     * Show the application Contact Us page.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        return view('contact-us');
    }

    /**
     * Post the application Contact Us page form data.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contactPost(ContactUsFormRequest $request)
    {
        $name       = $request->input('name');
        $email      = $request->input('email');
        $phone      = $request->input('phone');
        $message    = $request->input('message');

        // Permanent subject is here
        $subject    = 'Message from ' . config('app.name');
        if (!empty($name))
        {
            $subject    .= ': Message sent by ' . ucfirst($name);
        }

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'To: ' . config('app.name') . ' <' . config('app.email') . '>' . "\r\n";
        $headers .= 'From: No Reply <no_reply@' . config('app.short_domain') . '>' . "\r\n";
        $headers .= 'Cc: ' . $email . "\r\n";

        //Email address to send message to
        $to = config('app.email');

        //Send message to the 
        mail($to, $subject, $message, $headers);

        session()->flash('infoStatus', 'Message sent successfully! Thanks for the message. We\'ll get back to you as soon as possible.');

        return redirect()->route('publicContact');
    }
}
