<?php

namespace App\HTTP\Controllers;

use App\Post;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Mail;

class PagesController extends Controller {

	public  function getIndex() {
		$posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
		return view('pages/welcome')->withPosts($posts);
	}


	public  function getAbout() {
		$first = "Rajan";
		$last = "Acharya";
		$fullname = $first." ".$last;
		$email = "acharya.rajanpkr@gmail.com";
		$data = array(
					"f_name" => $first,
					"l_name" => $last,
					"email" => $email
				);
		return view('pages/about')->withAbout($data);
	}


	public  function getContact() {
		return view('pages/contact');
	}


	public function postContact(Request $request) {
		$this->validate($request, array(
                'email' => 'required|email|max:255',
                'subject' => 'required|max:255',
                'message' => 'required'
            ));

		$data = array(
				'email' => $request->email,
				'subject' => $request->subject,
				'message_body' => $request->message
			);
		Mail::send('emails.contact', $data, function($message) use($data) {
			$message->from($data['email'], $data['email']);
		    $message->sender('john@johndoe.com', 'John Doe');
		
		    $message->to('a33101f2060-f6a75e@inbox.mailtrap.io', 'Rajan Acharya');
		
		    $message->replyTo($data['email'], $data['email']);
		
		    $message->subject($data['subject']);
		});

		Session::flash('success', 'Mail successfully sent.');

        return redirect('contact');

		/*Mail::send('Html.view', $data, function ($message) {
		    $message->from('john@johndoe.com', 'John Doe');
		    $message->sender('john@johndoe.com', 'John Doe');
		
		    $message->to('john@johndoe.com', 'John Doe');
		
		    $message->cc('john@johndoe.com', 'John Doe');
		    $message->bcc('john@johndoe.com', 'John Doe');
		
		    $message->replyTo('john@johndoe.com', 'John Doe');
		
		    $message->subject('Subject');
		
		    $message->priority(3);
		
		    $message->attach('pathToFile');
		});*/
	}



}
