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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
