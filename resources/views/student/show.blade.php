@extends('layouts.app1')
@section('content')
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <td>{{$data['record']->name}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{$data['record']->email}}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{$data['record']->phone}}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{$data['record']->address}}</td>
            </tr>
            <tr>
                <th>Profile</th>
                <td>
                    @if($data['record']->image)
                        <img src="{{ asset('public/Image/'.$data['record']->image) }}" alt="Image" height="50" width="50">
                    @else
                        <img src={{asset('public/Image/default.jpeg')}} alt="Image" height="50" width="50">
                    @endif
                </td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>
                    @if($data['record']->gender == 1)
                        Male
                    @elseif($data['record']->gender == 2)
                        Female
                    @endif
                </td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>{{$data['record']->dob}}</td>
            </tr>
            </thead>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>S.N.</th>
                <th>Level</th>
                <th>College</th>
                <th>University</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['record']->educations as $records)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$records->level}}</td>
                    <td>{{$records->college}}</td>
                    <td>{{$records->university}}</td>
                    <td>{{$records->start_date}}</td>
                    <td>{{$records->end_date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
