@extends('layouts.app')
@section('content')
{{--    <div class="loading" style="display: none">Loading&#8230;</div>--}}



    <div class="alert alert-danger" id="errors-div" style="display: none">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul id="errors">
        </ul>
    </div>


    <form action="{{ route('users.store') }}" method="POST" id="userForm">
        @csrf
        <div style="margin-left: 13px;">
            <h2>Add New User</h2>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-sm-6">
                    <strong>Name:</strong>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                </div>

                <div class="form-group col-sm-6">
                    <strong>Surname:</strong>
                    <input type="text" name="surname" id="surname" class="form-control" placeholder="Surname" value="{{ old('surname') }}">
                </div>


                <div class="form-group col-sm-6">
                    <strong>SA ID:</strong>
                    <input type="text" name="sa_id" id="sa_id" class="form-control" placeholder="SA ID" maxlength="13" value="{{ old('sa_id') }}">
                </div>

                <div class="form-group col-sm-6">
                    <strong>Date Of Birth:</strong>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Date Of Birth" value="{{ old('date_of_birth') }}">
                </div>



                <div class="form-group col-sm-6">
                    <strong>Mobile Number:</strong>
                    <input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number" maxlength="10" value="{{ old('mobile_number') }}">
                </div>

                <div class="form-group col-sm-6">
                    <strong>Email:</strong>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                </div>




                <div class="form-group col-sm-6">
                    <strong>Language:</strong>
                    <select class="form-control" name="user_language_id" id="language">
                        <option value="">Please select Language</option>
                        @foreach ($items as $item)
                            <option value="{{$item->id}}">{{$item->language}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-sm-6">
                    <strong>Interests:</strong>
                    <select class="form-control" name="user_interest_id[]" multiple id="interestsId">
{{--                    <select class="selectpicker" multiple data-live-search="true">--}}
                        <option selected value="0">Please select Interests</option>
                        @foreach ($interest_items as $interest_item)
                            <option value="{{$interest_item->id}}">{{$interest_item->interest}}</option>
                        @endforeach
                    </select>

{{--                    <select class="interests" multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm">--}}
{{--                        <option>Mustard</option>--}}
{{--                        <option>Ketchup</option>--}}
{{--                        <option>Relish</option>--}}
{{--                    </select>--}}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary" id="createUser">Save User</button>
                <a class="btn btn-secondary" href="{{ route('users.index') }}"> Back</a>
            </div>


    </form>
@endsection




