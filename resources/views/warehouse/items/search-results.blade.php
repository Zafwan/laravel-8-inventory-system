@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Search Item') }}</div>

                <div class="card-body">
                    <form method="GET" action="{{ route('item-search') }}">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="sku" class="col-md-4 col-form-label text-md-end">{{ __('SKU') }}</label>

                            <div class="col-md-6">
                                <input id="sku" type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" value="{{ old('sku') }}">

                                @error('sku')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="item_categories_id" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select class="form-select @error('item_categories_id') is-invalid @enderror" name="item_categories_id">
                                    <option selected disabled>Please select...</option>
                                    @foreach ($itemCategory as $key => $a)
                                        <option value="{{ $a->id }}" {{ ( $selectedID == $a->id) ? 'selected' : '' }}> 
                                            {{ $a->name }} 
                                        </option>
                                    @endforeach    
                                </select>

                                @error('item_categories_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The category field is required.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 mt-5">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <hr>

                    <!-- Search Result -->
                    <h3 class="mb-5">Search Results</h3>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Name</th>
                          <th scope="col">SKU</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Category</th>
                          <th scope="col">Image</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key => $item)
                            <tr>
                              <th scope="row">{{ $data->firstItem() + $key }}</th>
                              <td>{{ $item->name }}</td>
                              <td>{{ $item->sku }}</td>
                              <td>{{ $item->quantity }}</td>
                              <td>{{ $item->itemCategories->name }}</td>
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
                    {{ $data->appends(request()->except('page'))->links() }}
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
@endsection
