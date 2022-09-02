@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('List of all items') }}</div>

                <div class="card-body">
                    @if(session()->get('success'))
                        <div class="alert alert-success">
                          {{ session()->get('success') }}  
                        </div><br />
                    @endif

                    <a class="btn btn-primary float-end mb-3" href="{{ route('items.create') }}">Add New</a>

                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Name</th>
                          <th scope="col">SKU</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Image</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($items as $key => $item)
                            <tr>
                              <th scope="row">{{ $items->firstItem() + $key }}</th>
                              <td>{{ $item->name }}</td>
                              <td>{{ $item->sku }}</td>
                              <td>{{ $item->quantity }}</td>
                              <td><img id="myImg" class="img-thumbnail" width="50" src="{{ asset('storage/' . $item->image) }}"></td>
                              <td>
                                    <form action="{{ route('items.destroy', $item->id)}}" method="post">
                                        <a href="{{ route('items.edit', $item->id)}}" class="btn btn-secondary">Edit</a>
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
                    {{ $items->links() }}
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
