@extends('layouts.student')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Student Details') }}</div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('student.update', $student) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="student_number" class="col-md-4 col-form-label text-md-right">{{ __('Student Number') }}</label>
                                <div class="col-md-6">
                                    <input id="student_number" type="text" class="form-control @error('student_number') is-invalid @enderror"
                                           name="student_number" value="{{ $student->student_number }}" disabled>

                                    @error('student_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>

                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror"
                                           name="firstname" value="{{ $student->firstname }}">

                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror"
                                           name="surname" value="{{ $student->surname }}">

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="course_code" class="col-md-4 col-form-label text-md-right">{{ __('Course Code') }}</label>

                                <div class="col-md-6">
                                    <input id="course_code" type="text" class="form-control @error('course_code') is-invalid @enderror"
                                           name="course_code" value="{{ $student->course_code }}">

                                    @error('course_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="course_description" class="col-md-4 col-form-label text-md-right">{{ __('Course Description') }}</label>

                                <div class="col-md-6">
                                    <input id="course_description" type="text" class="form-control @error('course_description') is-invalid @enderror"
                                           name="course_description" value="{{ $student->course_description }}">

                                    @error('course_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="grade" class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>

                                <div class="col-md-6">
                                    <input id="grade" type="text" class="form-control @error('grade') is-invalid @enderror"
                                           name="grade" value="{{ $student->grade }}">

                                    @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
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
