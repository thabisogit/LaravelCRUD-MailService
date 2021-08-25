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
    @if (Auth::check())
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
                @if (Auth::check())
                    <th style="text-align: center">Actions</th>
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
        <a type="button" class="badge badge-pill badge-info" onclick="loadInterests({{$user->id}},'{{$user->name}} `s Interests')" style="color: white">View Interests</a>
    </td>

    <td>
            <div class="row">
                <div class="col-sm-4">
                    <a class="small" href="{{ route('users.show',$user->id) }}"><i title="Display User" class="fas fa-eye"></i></a>
                </div>
                <div class="col-sm-4">
                    <a class="small" href="{{ route('users.edit',$user->id) }}"><i title="Edit User" class="far fa-edit"></i></a>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="small deleteLink" content="{{$user->id}}"><i title="Delete User" class="far fa-trash-alt"></i></button>
                </div>
            </div>

    </td>
</tr>
    @endforeach
        </tbody>
    </table>
        @else
        <p style="text-align: center;font-weight: bold;" class="h1">USER MANAGEMENT WEB APP</p>
    @endif

    <div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this user?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="delete">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    @include('inc.modal')

    {!! $users->links() !!}

    <script type="application/javascript">

        $('.deleteLink').on('click', function() {
            $('#delete').attr('content',$(this).attr('content'));
                $('#confirmation').modal('show')
                    .on('click', '#delete', function() {
                        deleteUser($(this).attr('content'));
                    });

        });

        function deleteUser(user_id) {
            var url = '{{route("users.destroy",":id")}}';
            var raw_url = url.replace(':id', user_id);

            $.post(raw_url,{ _token: $('meta[name=csrf-token]').attr('content'), _method : 'DELETE', user_id : user_id }, function(response){
                if(response !== '')
                {
                    location.reload();
                }
            });
        }

        function loadInterests(user_id,user_name) {

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

            $('#interestsModal').modal('show');
        }

    </script>

@endsection

