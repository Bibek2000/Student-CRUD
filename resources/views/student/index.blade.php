@extends('layouts.app1')

<style>
    /* CSS for the table */
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* CSS for the links */
    .links a {
        display: inline-block;
        padding: 6px 12px;
        text-decoration: none;
        color: #fff;
        background-color: #007bff;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .links a:hover {
        background-color: #0056b3;
    }

    /* CSS for the "View Details" link */
    .view-details {
        background-color: #007bff;
    }

    .view-details:hover {
        background-color: #0056b3;
    }

    /* CSS for the "Edit" link */
    .edit-link {
        background-color: #ffc107;
    }

    .edit-link:hover {
        background-color: #ffaa00;
    }

    /* CSS for the buttons */
    .btn {
        border: none;
        padding: 6px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        border-radius: 4px;
    }

    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border: none;
    }

    .btn-danger:hover {
        background-color: #b02634;
    }

</style>
@section('content')
<table>
    <tr>
        <th>S.N</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Profile Picture</th>
        <th>Date of Birth</th>
        <th></th>
    </tr>
    @foreach($data['records'] as $record)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$record->name}}</td>
            <td>{{$record->email}}</td>
            <td>{{$record->phone}}</td>
            <td>{{$record->address}}</td>
            <td>
                <img src="{{ asset('public/Image/'.$record->image) }}" alt="Image" height="50" width="50">
            </td>
            <td>{{$record->dob}}</td>
            <th class="links">
                <a href="{{route('student.show',$record->id)}}" class="btn btn-primary view-details">View Details</a>
                <a href="{{route('student.edit',$record->id)}}" class="btn btn-warning edit-link">Edit</a>
                <form action="{{route('student.destroy',$record->id)}}" method="post" style="display:inline-block">
                    @method("delete")
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            </th>
        </tr>
    @endforeach

</table>
@endsection
