@extends('layouts.app')
@section('content')
{{--    <div class="loading" style="display: none">Loading&#8230;</div>--}}
<div class="wrap" style="display: none">
    <div class="loading">
        <div class="bounceball"></div>
        <div class="text">CREATING USER</div>
    </div>
</div>


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New User</h2>
            </div>
            <div class="pull-right" style="text-align: right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>

            <div class="alert alert-danger" id="errors-div" style="display: none">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul id="errors">
                </ul>
            </div>

{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
{{--            <ul id="errors">--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

    <form action="{{ route('users.store') }}" method="POST" id="userForm">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Surname:</strong>
                    <input type="text" name="surname" id="surname" class="form-control" placeholder="Surname" value="{{ old('surname') }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>SA ID:</strong>
                    <input type="text" name="sa_id" id="sa_id" class="form-control" placeholder="SA ID" maxlength="13" value="{{ old('sa_id') }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Mobile Number:</strong>
                    <input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number" maxlength="10" value="{{ old('mobile_number') }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date Of Birth:</strong>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Date Of Birth" value="{{ old('date_of_birth') }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Language:</strong>
                    <select class="form-control" name="user_language_id" id="language">
                        <option value="">Please select Language</option>
                        @foreach ($items as $item)
                            <option value="{{$item->id}}">{{$item->language}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Interests:</strong>
                    <select class="form-control" name="user_interest_id[]" multiple id="interestsId">
                        <option selected value="0">Please select Interests</option>
                        @foreach ($interest_items as $interest_item)
                            <option value="{{$interest_item->id}}">{{$interest_item->interest}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" id="createUser">Submit</button>
            </div>
        </div>

    </form>
@endsection



