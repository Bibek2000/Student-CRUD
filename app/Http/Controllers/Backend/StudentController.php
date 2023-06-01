<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Student;
use App\Models\Backend\Education;

class StudentController extends Controller
{
    public function index()
    {
        $data['records'] = Student::get();
        return view('student.index', compact('data'));
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(Request $student)
    {
        $data = $student->validate([
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'dob' => 'required',
            'level' => 'array|required',
            'college' => 'array|required',
            'university' => 'array|required',
            'start_date' => 'array|required',
            'end_date' => 'array|required'
        ]);
        if ($student->file('image')) {
            $file = $student->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/Image'), $filename);

            $data['image'] = $filename;
        }

        $record = Student::create($data);
        if ($record) {
            foreach ($student['level'] as $key => $educationData) {
                $education = new Education();
                $education->student_id = $record->id;
                $education['level'] = $data['level'][$key];
                $education['college'] = $data['college'][$key];
                $education['university'] = $data['university'][$key];
                $education['start_date'] = $data['start_date'][$key];
                $education['end_date'] = $data['end_date'][$key];
                $education->save();
            }
            return redirect('index')->with('success', "Student Created successfully");
        } else {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $data['record'] = Student::find($id);
        if (!$data['record']) {
            request()->session()->flash('error', "Error:Invalid Request");
            return redirect()->route('student.index');

        }
        return view('student.show', compact('data'));
    }

    public function edit($id)
    {
        $data['record'] = Student::find($id);
        if (!$data['record']) {
            request()->session()->flash('error', "Error:Invalid Request");
            return redirect()->route('student.index');

        }
        return view('student.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'dob' => 'required',
            'level' => 'array|required',
            'college' => 'array|required',
            'university' => 'array|required',
            'start_date' => 'array|required',
            'end_date' => 'array|required'
        ]);

        $student = Student::findOrFail($id);

        if ($request->hasFile('image')) {
            $oldImagePath = public_path('public/Image/') . $student->image;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
    }
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/Image'), $filename);

            $data['image'] = $filename;
        }

        $student->update($data);

        // Update education records
        $student->educations()->delete(); // Delete existing education records

        foreach ($request['level'] as $key => $educationData) {
            $education = new Education();
            $education->student_id = $student->id;
            $education['level'] = $data['level'][$key];
            $education['college'] = $data['college'][$key];
            $education['university'] = $data['university'][$key];
            $education['start_date'] = $data['start_date'][$key];
            $education['end_date'] = $data['end_date'][$key];
            $education->save();
        }

        return redirect('index')->with('success', "Student updated successfully");
    }


    public function destroy($id)
    {
        $data['record']=Student::find($id);
        if(!$data['record' ]){
            request()->session()->flash('error',"Error:Invalid Request");
            return redirect()->route('student.index');
        }
        if($data["record"]->delete())
        {
            request()->session()->flash('success',"Successfully Deleted");
        }else{
            request()->session()->flash('error',"Error:Delete Failed ");
        }
        return redirect()->route('student.index');
    }
}
