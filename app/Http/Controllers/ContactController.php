<?php

Namespace App\Http\Controllers;

use App\Notifications\InboxMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Admin;
use App\Post;

Class ContactController extends Controller
{
	public function __construct(){
        view()->composer('partials.menu', function($view){
            $types = Post::pluck('post_type', 'id')->unique();
            $view->with('types', $types);
        });
    }

	public function show() 
	{
		return view('front.contact');
	}

	public function mailToAdmin(ContactFormRequest $message, Admin $admin)
	{        //send the admin an notification
		$admin->notify(new InboxMessage($message));
		// redirect the user back
		return redirect()->back()->with('message', 'Merci pour votre Message, Nous reviendrons vers vous bientôt!');
	}


}