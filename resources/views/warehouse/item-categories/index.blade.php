@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('List of all item categories') }}</div>

                <div class="card-body">
                    @if(session()->get('success'))
                        <div class="alert alert-success">
                          {{ session()->get('success') }}  
                        </div><br />
                    @endif

                    <a class="btn btn-primary float-end mb-3" href="{{ route('item-categories.create') }}">Add New</a>

                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Name</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($itemCategories as $a)
                            <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td>{{ $a->name }}</td>
                              <td>
                                    <form action="{{ route('item-categories.destroy', $a->id)}}" method="post">
                                        <a href="{{ route('item-categories.edit', $a->id)}}" class="btn btn-secondary">Edit</a>
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
                    {{ $itemCategories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
