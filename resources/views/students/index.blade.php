@extends('layouts.student')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Student List') }}
                        <a href="{{ route('student.create') }}" class="btn btn-info float-end">Add Student</a>
                        <a href="{{ route('import') }}" class="btn btn-info float-end mx-2">Upload Student</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($students->isEmpty())
                            <div class="alert alert-info text-center" role="alert">
                                <p class="font-bold">Student database empty. click <a href="{{ route('import') }}">here</a> to upload a list of students or <a href="{{ route('student.create') }}">here</a> to add students manually.</p>
                            </div>
                        @else
                            <table id="example" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Student Number</th>
                                        <th>Firstname</th>
                                        <th>Surname</th>
                                        <th>Course Code</th>
                                        <th>Course Description</th>
                                        <th>Grade</th>
                                        <th colspan="2" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->student_number }}</td>
                                        <td>{{ $student->firstname }}</td>
                                        <td>{{ $student->surname }}</td>
                                        <td>{{ $student->course_code }}</td>
                                        <td>{{ $student->course_description }}</td>
                                        <td>{{ $student->grade }}</td>
                                        <td>
                                            <a href="{{ route('student.edit', $student) }}" class="btn btn-info">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('student.destroy', $student) }}" method="post"
                                                  onclick="return confirm('Are you sure, you want to delete student data?')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="m-auto text-center  float-end">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item">{{ $students->links('pagination::bootstrap-4') }}</li>
                                    </ul>
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
