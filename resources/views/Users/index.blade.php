@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row col-sm-12">
            @if (!Auth::guest())
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
            @endif
    </div>
    <br>
    <table class="table table-striped" id="dataTable" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>SA ID No.</th>
                <th>Mobile No.</th>
                <th>Email Address</th>
                <th>Birth Date</th>
                <th>Language</th>
                <th>Interests</th>
                @if (!Auth::guest())
                    <th>Actions</th>
                @endif


            </tr>
        </thead>
        <tbody>
    @foreach ($users as $user)

<tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->surname }}</td>
    <td>{{ $user->sa_id }}</td>
    <td>{{ $user->mobile_number }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->date_of_birth }}</td>
    <td>{{ App\Http\Controllers\UserLanguageController::getLanguage($user->user_language_id) }}</td>
    <td>
        <a type="button" class="btn btn-primary btn-sm" onclick="loadInterests({{$user->id}},'{{$user->name}} `s Interests')">View Interests</a>
    </td>
    @if (!Auth::guest())
    <td>
        <form action="{{ route('users.destroy',$user->id) }}" method="POST">
            <div class="row">
                <div class="col-sm-4">
                    <a class="small" href="{{ route('users.edit',$user->id) }}"><i class="far fa-edit"></i></a>
                </div>
                <div class="col-sm-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="small deleteLink"><i class="far fa-trash-alt"></i></button>
                </div>
            </div>
        </form>
        @endif
    </td>
</tr>
    @endforeach
        </tbody>
    </table>

    @include('inc.modal')

    {!! $users->links() !!}

@endsection

<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script>
            function loadInterests(user_id,user_name) {
                $(function(){
                    $('#interestsList').empty();
                    $('#modalTitle').text(user_name);
                    $.post('user_interests/interests',{ _token: $('meta[name=csrf-token]').attr('content'), _method : 'POST', user_id : user_id }, function(response){

                        if(response != '')
                        {
                            $.each( response, function( key, value ) {
                                $('#interestsList').append('<li class="list-group-item">'+value+'</li>')
                            });
                        }else{
                            $('#interestsList').append('<i class="far fa-frown">&nbsp;<i>User has no interests</i></i>')
                        }

                    });
                });
                $('#interestsModal').modal('show');
            }


            $( document ).ready(function() {
                $('#dismissModal').on('click', function () {
                    $('#interestsModal').modal('hide');
                })
            });
        </script>
