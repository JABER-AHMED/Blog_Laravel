<?php 


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Mail;
use Session;
use App\Category;
use App\Tag;

class PagesController extends controller
{

	public function getIndex(){

		$posts = Post::orderBy('created_at', 'desc')
				->with('user', 'category', 'tags')->paginate(5);

		$categories = Category::take(10)->get();

		$tags = Tag::take(30)->get();

		$data = [

			'posts' => $posts,
			'categories' => $categories,
			'tags' => $tags
		];
		
		//return $data;

		return view('pages.welcome')->with($data);
	}
	public function getAbout(){

		$first = 'Jaber';
		$last = 'Ahmed';

		$full = $first." ".$last;
		$email = 'jaber.hexit@gmail.com';
		/*return view('pages.about')->withFullname($full)->withEmail($email);*/

		#Also access using array
		$data = [];
		$data['full'] = $full;
		$data['email'] = $email;
		return view('pages.about')->withInfo($data);

	}
	public function getContact(){

		return view('pages.contact');
	}
	public function postContact(Request $request)
	{
		$this->validate($request, array(

			'email' => 'required|email',
			'subject' => 'min:5',
			'message' => 'min:10'
		));

		$data = array(

				'email' => $request->email,
				'subject' => $request->subject,
				'bodyMessage' => $request->message
			);

		Mail::send('emails.contact', $data, function($message) use ($data) {

			$message->from($data['email']);
			$message->to('placidcse@gmail.com');
			$message->subject($data['subject']);
		});

		Session::flash('success', 'Your email was successfully sent!!');

		return redirect('/home');
	}

}