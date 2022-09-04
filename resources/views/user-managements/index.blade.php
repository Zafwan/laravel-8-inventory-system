@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('List of all users') }}</div>

                <div class="card-body">
                    @if(session()->get('success'))
                        <div class="alert alert-success">
                          {{ session()->get('success') }}  
                        </div><br />
                    @endif

                    <a class="btn btn-primary float-end mb-3" href="{{ route('user-managements.create') }}">Add New</a>

                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                              <th scope="row">{{ $users->firstItem() + $key }}</th>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>
                                    <form action="{{ route('user-managements.destroy', $user->id)}}" method="post">
                                        <a href="{{ route('user-managements.edit', $user->id)}}" class="btn btn-secondary">Edit</a>
                                          @csrf
                                          @method('DELETE')
                                          <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                              </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <br>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">

    <!-- The Close Button -->
    <span class="close">&times;</span>

    <!-- Modal Content (The Image) -->
    <img class="modal-content" id="img01">

    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
</div>
</div>
@endsection
