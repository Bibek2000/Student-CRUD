@extends('layouts.app1')
@section('title','Create')
<style>
/* Form container */
form {
background-color: #f2f2f2;
padding: 20px;
width: 400px;
margin: 0 auto;
}

/* Form heading */
form h1 {
text-align: center;
margin-bottom: 20px;
}

/* Form input fields */
form input {
width: 100%;
padding: 12px;
margin-top: 8px;
margin-bottom: 16px;
border: 1px solid #ccc;
box-sizing: border-box;
}

/* Error message */
.text-danger {
color: red;
margin-top: -10px;
margin-bottom: 10px;
}

/* Form button */
form button {
background-color: #4CAF50;
color: white;
padding: 12px 20px;
border: none;
cursor: pointer;
width: 100%;
}

/* Form button hover effect */
form button:hover {
opacity: 0.8;
}

/* Tab styling (optional) */
.tab {
display: block;
}

.tab p {
margin-top: 0;
}

</style>
@section('content')

    <form action="{{ route('user.password.update') }}" method="POST">
        @csrf
        @method('PUT')
        <h1>Password Change Form</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="text-danger">{{$error}}</p>
            @endforeach
        @endif
        <div class="tab">
            <p> <input type="password" name="current_password" id="name" value="" required placeholder="Current Password"></p>
            <p><input type="password" name="new_password"  value="" required placeholder="New Password"></p>
            <p><input type="password" name="confirm_new_password"  value="" required placeholder="Confirm New Password"></p>

        </div>
        <button type="submit" class="btn btn-primary" ><i class="fa fa-edit"></i> Update</button>

    </form>


@endsection
@section('scripts')

    var currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    }


@endsection

