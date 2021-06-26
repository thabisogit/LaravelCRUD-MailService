@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> {{ $user->name . '\'s Details'}}</h2>
            </div>
            <div class="pull-right" style="text-align: right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $user->name . ' '. $user->surname }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>SA ID:</strong>
                {{ $user->sa_id}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Contact Details:</strong>
                Mobile No.{{': '. $user->mobile_number.' | Email: '}}<a href="mailto:{{$user->email}}">{{$user->email}}</a>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date of Birth:</strong>
                {{ $user->date_of_birth}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Language:</strong>
                {{ App\Http\Controllers\UserLanguageController::getLanguage($user->user_language_id) }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Interests:</strong>
                @if($interestsArray != null)
                    @foreach ($interestsArray as $interest)
                    {{'*'.$interest}}
                    @endforeach
                @else
                    <i class="far fa-frown"></i>&nbsp;<i>User has no interests</i>&nbsp;<i class="far fa-frown"></i>
                @endif
            </div>
        </div>
    </div>
@endsection
