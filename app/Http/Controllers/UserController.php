<?php

namespace App\Http\Controllers;

use App\User;
use App\UserInterest;
use App\UserInterestLink;
use App\UserLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedInUser = Auth::id();

        $users = User::latest()->whereNotIn('id',[$loggedInUser])->paginate(5);

        return view('users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = UserLanguage::all('language', 'id');
        $interest_items = UserInterest::all('interest', 'id');
        return view('users.create',['items'=>$items,'interest_items'=>$interest_items]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->user_interest_id);
        $this->validateInputs($request);
        $user = User::create(['name'=>$request->name, 'surname'=>$request->surname, 'sa_id'=>$request->sa_id, 'mobile_number'=>$request->mobile_number, 'email'=>$request->email, 'date_of_birth'=>$request->date_of_birth, 'user_language_id'=>$request->user_language_id, 'user_interest_id'=>$request->user_interest_id]);

        foreach ($request->user_interest_id as $interest_id){
            UserInterestLink::create(['user_id'=>$user->id, 'user_interest_id'=>$interest_id]);
        }


        // email data
        $email_data = array(
            'name' => $request->name,
            'email' => $request->email,
        );

        // send email with the template
        Mail::send('inc.email_temp', $email_data, function ($message) use ($email_data) {
            $message->to($email_data['email'], $email_data['name'])
                ->subject('Welcome to ProPay')
                ->from('no-reply@site.com', 'ProPay');
        });


        return redirect()->route('users.index')
            ->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $items = UserLanguage::all('language', 'id');
        $interest_items = UserInterest::all('interest', 'id');
        return view('users.edit',compact('user','items','interest_items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($request->user_interest_id != null){
            UserInterestLink::where('user_id', $user->id)->delete();
            foreach ($request->user_interest_id as $interest_id){
                UserInterestLink::create(['user_id'=>$user->id, 'user_interest_id'=>$interest_id]);
            }
        }
        $this->validateInputs($request);

        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }

    public function validateInputs(Request $request){
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'sa_id' => 'required',
            'mobile_number' => 'required',
            'email' => 'required',
            'date_of_birth' => 'required',
            'user_language_id' => 'required',
        ]);
    }
}
