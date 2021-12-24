@extends('layouts.student')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Import Student Data') }}</div>

                    <div class="card-body">
                        <h4 class="alert alert-info"><b>Note:</b> Only semicolon delimited CSV is allowed.</h4>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-warning">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger mt-1 mb-1">{{ $error }}</div>
                            @endforeach
                        @endif
                        <form method="POST" action="{{ route('import') }}" accept-charset="utf-8" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Student Data File') }}</label>
                                <div class="col-md-6">
                                    <input type="file" name="file" placeholder="Choose file" class="form-control @error('firstname') is-invalid @enderror">

                                    @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Import Data') }}
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
