<?php

namespace App\Http\Controllers\Students;

use App\Models\Student;
use App\Imports\StudentsImport;
use App\Exports\StudentsExport;
use App\Http\Requests\FileUploadRequest;
use App\Http\Requests\StudentsRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('firstname')->paginate(10);

        return view('students.index')->with(compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentsRequest $request)
    {
        Student::create($request->validated());

        return redirect()->back()->with('success', 'Student added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.update')->with(compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentsRequest $request, Student $student)
    {
        $student->update($request->validated());

        return redirect('/')->with('success', 'Student details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect('/')->with('success', 'Student data permanently removed from database.');
    }

    /**
     * Show the student import form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showImportForm()
    {
        return view('students.file-upload');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function import(FileUploadRequest $request)
    {
        try {
            $import = new StudentsImport;
            Excel::import($import, request()->file('file'));
        } catch (\Exception $e) {
            Log::critical($e->getMessage());
        }

        $count = $import->getRowCount();

        if($import->failures()->isNotEmpty()){
            $failures = $import->failures()->toArray();
            $error_count = count($failures);
           return redirect()->back()->with('error', 'Please note student numbers must be unique, duplicates are not allowed. ' . $count . ' records inserted, and ' . $error_count . ' skipped.');
        }

        return redirect('/')->with('success', 'File has been imported successfully. '. $count . ' records inserted');
    }
}
