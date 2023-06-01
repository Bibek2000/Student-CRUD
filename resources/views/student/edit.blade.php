@extends('layouts.app1')
<style>
    * {
        box-sizing: border-box;
    }

    body {
        background-color: #f1f1f1;
    }

    #regForm {
        background-color: #ffffff;
        margin-top: 10px ;
        margin-left: 50px;
        font-family: Raleway;
        padding: 40px;
        width: 50%;
        min-width: 300px;
    }

    h1 {
        text-align: center;
    }

    input {
        padding: 10px;
        width: 80%;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
    }

    .male{
        width: 20%;
        display: flex;
    }

    .female{
        margin-left: 10px;
        width: 20%;
        display: flex;
    }


    /* Mark input boxes that gets an error on validation: */
    input.invalid {
        background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
        display: none;
    }

    button {
        background-color: #04AA6D;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.8;
    }

    #prevBtn {
        background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #04AA6D;
    }
</style>
@section('content')

<form name="register-form" id="regForm" action="{{route('student.update', $data['record']->id)}}" method="post" enctype="multipart/form-data">
    @if($errors->any())
        @foreach($errors as $error)
            <span class="text-danger">{{$error}}</span>
        @endforeacH
    @endif

    <input type="hidden" name="_method" value="PUT">
    @csrf
    <h1>Register:</h1>
    <!-- One "tab" for each step in the form: -->
    <div class="tab">
        <label for="name">Name:</label><br><p>
            <input type="text" placeholder="Full name" oninput="this.className = ''" name="name" value="{{$data['record']->name}}"></p>
        <p class="error fullname-error"></p>
        <label for="email">Email:</label><br> <p>
            <input type="email" placeholder="Email" oninput="this.className = ''" name="email" value="{{$data['record']->email}}"></p>
        <p class="error email-error"></p>
        <label for="phone">Phone Number:</label><br><p>
            <input type="number" placeholder="Phone" oninput="this.className = ''" name="phone" value="{{$data['record']->phone}}"></p>
        <p class="error phone-error"></p>
        <label for="address">Address:</label><br><p>
            <input type="text" placeholder="Address" oninput="this.className = ''" name="address" value="{{$data['record']->address}}"></p>
        <p class="error address-error"></p>
        <br>
        <img src="{{ asset('storage/images/'.$data['record']->image) }}" alt="Student Image" height="100px" width="100">
        <p>Replace Image</p>
        Image:
        <div id="imagePreviewContainer" style="display: none;">
            <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 200px; max-height: 200px;">
        </div>

        <p><input onchange="previewImage(this)" oninput="this.className = ''" name="image" type="file"></p>
        <br>
        <label for="gender">Gender:</label><br>
        @if($data['record']->gender == 1)
        <p class="male">
            <input type="radio" placeholder="Gender" value="1" oninput="this.className = ''" name="gender" checked>
            <label for="male">Male</label>
        </p>
        <p class="female">
            <input type="radio" placeholder="Gender" value="2" oninput="this.className = ''" name="gender">
            <label for="female">Female</label>
        </p>
            @elseif($data['record']->gender == 2)
            <p class="male">
                <input type="radio" placeholder="Gender" value="1" oninput="this.className = ''" name="gender" >
                <label for="male">Male</label>
            </p>
            <p class="female">
                <input type="radio" placeholder="Gender" value="2" oninput="this.className = ''" name="gender" checked>
                <label for="female">Female</label>
            </p>
        @endif
        <label for="dob">Date of Birth:</label><br>
        <p><input type="date" placeholder="Date of Birth" oninput="this.className = ''" name="dob" value="{{$data['record']->dob}}"></p>
        <p class="error date-error"></p>

    </div>

    <div class="tab">
        <table class="table table-striped table-bordered" id="attribute_wrapper">
            <tr>
                <th>Level</th>
                <th>College</th>
                <th>University</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
            @foreach($data['record']->educations as $records)
            <tr>
                <td>
                    <input type="text" placeholder="level" name="level[]" value="{{$records->level}}">
                </td>
                <td>

                    <input type="text" placeholder="college" name="college[]" value="{{$records->college}}">
                </td>
                <td>
                    <input type="text" placeholder="university" name="university[]" value="{{$records->university}}">
                </td>
                <td>

                    <input type="date" placeholder="start date" name="start_date[]" value="{{$records->start_date}}">
                </td>
                <td>

                    <input type="date" placeholder="end date" name="end_date[]" value="{{$records->end_date}}">
                </td>
                <td>
                    <button class="btn btn-block btn-warning sa-warning remove_row "><i class="fa fa-trash"></i>Delete</button>
                </td>
            </tr>
            @endforeach

        </table>
        <button class="btn btn-info" type="button" id="addMore" style="margin-bottom: 20px">
            <i class="fa fa-plus"></i>
            Add
        </button>
    </div>
    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
    </div>
</form>


<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;

            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
    $(document).ready(function (){
        var attribute_wrapper = $("#attribute_wrapper"); //Fields wrapper
        var add_button_attribute = $("#addMore"); //Add button ID
        var y = 1;
        $(add_button_attribute).click(function (e) { //on add input button click
            e.preventDefault();
            var max_fields = 5; //maximum input boxes allowed
            if (y < max_fields) { //max input box allowed
                y++; //text box increment
                //add new row
                $("#attribute_wrapper tr:last").after(
                    '<tr>'+
                    '<td><input type="text" name="level[]" class="form-control" placeholder="Level"/></td>'+
                    '<td><input type="text" name="college[]" class="form-control" placeholder="College"/></td>'+
                    '<td><input type="text" name="university[]" class="form-control" placeholder="University"/></td>'+
                    '<td><input type="date" name="start_date[]" class="form-control" /></td>'+
                    '<td><input type="date" name="end_date[]" class="form-control" /></td>'+
                    '<td><button class="btn btn-block btn-warning sa-warning remove_row "><i class="fa fa-trash"></i>Delete</button></td>'+
                    '</tr>'
                );
            }else{
                alert('Maximum Attribute Limit is 5');
            }
        });
        //remove row
        $(attribute_wrapper).on("click", ".remove_row", function (e) {
            e.preventDefault();
            $(this).parents("tr").remove();
            y--;
        });
    });

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreviewContainer').show();
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#imagePreview').attr('src', '#');
            $('#imagePreviewContainer').hide();
        }
    }
</script>
@endsection

