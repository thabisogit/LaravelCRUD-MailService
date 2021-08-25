@extends('layouts.app')

@section('content')
{{--    <div class="wrap" style="display: none">--}}
{{--        <div class="loading">--}}
{{--            <div class="bounceball"></div>--}}
{{--            <div class="text">UPDATING USER</div>--}}
{{--        </div>--}}
{{--    </div>--}}

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update',$user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div style="margin-left: 13px;">
            <h2><u><strong>Edit User</strong></u></h2>
        </div>

            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-sm-6">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Name">
                </div>

                <div class="form-group col-sm-6">
                    <strong>Surname:</strong>
                    <input type="text" name="surname" value="{{ $user->surname }}" class="form-control" placeholder="Surname">
                </div>

                <div class="form-group col-sm-6">
                    <strong>SA ID:</strong>
                    <input type="text" name="sa_id" value="{{ $user->sa_id }}" class="form-control" placeholder="SA ID" maxlength="13">
                </div>

                <div class="form-group col-sm-6">
                    <strong>Date Of Birth:</strong>
                    <input type="date" name="date_of_birth" value="{{ $user->date_of_birth }}" class="form-control" placeholder="Date Of Birth">
                </div>


                <div class="form-group col-sm-6">
                    <strong>Mobile Number:</strong>
                    <input type="text" name="mobile_number" value="{{ $user->mobile_number }}" class="form-control" maxlength="10" placeholder="Mobile Number">
                </div>

                <div class="form-group col-sm-6">
                    <strong>Email:</strong>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control" placeholder="Email">
                </div>

                <div class="form-group col-sm-6">
                    <strong>Language:</strong>
                    <select class="form-control" name="user_language_id">
                        <option disabled="disabled">Please select Language</option>
                        @foreach ($items as $item)
                            <option value="{{$item->id}}" {{$item->id == $user->user_language_id ? 'selected' : ''}} >{{$item->language }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-sm-6">
                    <strong>Interests:</strong>
                    <select class="form-control" name="user_interest_id[]" multiple>
                        <option disabled="disabled">Please select Interests</option>
                        @foreach ($interest_items as $interest_item)
                            <option value="{{$interest_item->id}}"  {{$interest_item->id == $user->user_interest_id ? 'selected' : ''}} >{{$interest_item->interest}}</option>
                        @endforeach
                    </select>
                </div>


</div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Update User</button>
                <a class="btn btn-secondary" href="{{ route('users.index') }}"> Back</a>
            </div>

    </form>
@endsection
