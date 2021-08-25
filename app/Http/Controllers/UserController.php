<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use App\User;
use App\UserInterest;
use App\UserInterestLink;
use App\UserLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
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
        if(!Auth::check()){
            return redirect('/login');
        }

        //get logged in user and exclude them from list of users
        $loggedInUser = Auth::id();
        $users = User::latest()->whereNotIn('id',[$loggedInUser])->paginate(10);

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
        if(!Auth::check()){
            return redirect('/login');
        }
        //pull data from database to populate dropdown selects for language and interest and pass arrays to the view
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
        if(!Auth::check()){
            return redirect('/login');
        }
        $this->validateInputs($request);
        $user = User::create(['name'=>$request->name, 'surname'=>$request->surname, 'sa_id'=>$request->sa_id, 'mobile_number'=>$request->mobile_number, 'email'=>$request->email, 'date_of_birth'=>$request->date_of_birth, 'user_language_id'=>$request->user_language_id, 'user_interest_id'=>$request->user_interest_id]);

        //save list of user's interests if user_interest is not null
        if($request->user_interest_id != null){
            foreach ($request->user_interest_id as $interest_id){
                UserInterestLink::create(['user_id'=>$user->id, 'user_interest_id'=>$interest_id]);
            }
        }

        //trigger an event to send an email passing the email and user name to the event
        Event::dispatch(new SendMail($request->email,$request->name.' '.$request->surname));

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
        if(!Auth::check()){
            return redirect('/login');
        }

        //get list of user's interest and pass it to the view
        $interestsArray = [];
        $interests = UserInterestLink::where('user_id',$user->id)->get();
        foreach ($interests as $interest){
            $interestName = UserInterest::where('id', $interest->getAttributes()['user_interest_id'])->pluck('interest');
            $interestsArray[] = $interestName[0];
        }
        return view('users.show',compact('user','interestsArray'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(!Auth::check()){
            return redirect('/login');
        }

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
        if(!Auth::check()){
            return redirect('/login');
        }

        //reset user's interests by deleting and recreating new users interests
        if($request->user_interest_id != null){
            UserInterestLink::where('user_id', $user->id)->delete();
            foreach ($request->user_interest_id as $interest_id){
                UserInterestLink::create(['user_id'=>$user->id, 'user_interest_id'=>$interest_id]);
            }
        }

        //validate inputs
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
        if(!Auth::check()){
            return redirect('/login');
        }

        $user->delete();

        //delete users interest when user is being deleted
        UserInterestLink::where('user_id', $user->id)->delete();

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
            'user_language_id' => ['required'],
        ]);
    }
}
