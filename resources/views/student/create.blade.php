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
        font-family: Chalkboard;
        padding: 40px;
        width: 90%;
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

    div.flex-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    div.gender-group {
        display: flex;
        flex-direction: row;
    }

    div.gender-group > div {
        margin-right: 10px;
    }
    tr.error-edu {
        background-color: white !important;
        border: none !important;
    }
    tr.error-edu td {
        border: none;
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
<form name="register-form" id="regForm" action="{{route('student.store')}}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    @csrf
    <h1>Register:</h1>
    <!-- One "tab" for each step in the form: -->
    <div class="tab">
        <label for="name">Name:</label><br><p>
            <input type="text" placeholder="Full name" oninput="this.className = ''" name="name"></p>
        <span class="error text-danger" id="name"></span>

    @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
           @endif
        <br>
        <label for="email">Email:</label><br> <p>
            <input type="email" placeholder="Email" oninput="this.className = ''" name="email"></p>
            <span class="error email-error text-danger" id="email"></span>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
           @endif
        <br>
        <label for="phone">Phone Number:</label><br><p>
            <input type="text" placeholder="Phone" oninput="this.className = ''" name="phone"></p>
            <span class="error text-danger" id="phone"></span>
            @if ($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
           @endif
        <br>
        <label for="address">Address:</label><br><p>
            <input type="text" placeholder="Address" oninput="this.className = ''" name="address"></p>
            <span class="error text-danger" id="address"></span>
            @if ($errors->has('address'))
                <span class="text-danger">{{ $errors->first('address') }}</span>
           @endif
        <br>
        <label for="image">Profile Picture:</label><br><p>
        <div>
            <input type="file" name="image" placeholder="Choose image" id="image" accept=".png,.gif,.jpg,.jpeg">
        </div>

    <div class="col-md-12 mb-2">
        <img id="preview-image-before-upload" src=""
             alt="" style="max-height: 100px;">
    </div>
        </p>
        <br>
        <div class="flex-container">
        <label for="gender">Gender:</label><br>
            <div class="gender-group">
        <div class="male">
            <input type="radio" placeholder="Gender" value="1" oninput="this.className = ''" name="gender" checked>
            <label for="male">Male</label>
        </div>
        <div class="female">
            <input type="radio" placeholder="Gender" value="2" oninput="this.className = ''" name="gender">
            <label for="female">Female</label>
        </div>
            </div>
        </div>
        <br>
        <label for="dob">Date of Birth:</label><br>
        <p><input type="date" placeholder="Date of Birth" oninput="this.className = ''" name="dob"></p>
        <span class="error date-error text-danger" id="dob"></span>
        @if ($errors->has('dob'))
            <span class="text-danger">{{ $errors->first('dob') }}</span>
        @endif
        <br>

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
            <tr>
                <td>
                    <input type="text" placeholder="level" name="level[]" value="">

                    @if ($errors->has('level'))
                        <span class="text-danger">{{ $errors->first('level') }}</span>
                    @endif
                </td>
                <td>
                    <input type="text" placeholder="college" name="college[]" value="">
                    <span class="error" id="college"></span>
                    @if ($errors->has('college'))
                        <span class="text-danger">{{ $errors->first('college') }}</span>
                    @endif
                </td>
                <td>

                    <input type="text" placeholder="university" name="university[]" value="">
                    <span class="error" id="university"></span>
                    @if ($errors->has('university'))
                        <span class="text-danger">{{ $errors->first('university') }}</span>
                    @endif
                </td>
                <td>
                    <input type="date" placeholder="start date" name="start_date[]" value="">
                    <span class="error" id="start_date"></span>
                    @if ($errors->has('start_date'))
                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                    @endif
                </td>
                <td>
                    <input type="date" placeholder="end date" name="end_date[]" value="">
                    <span class="error" id="end_date"></span>
                    @if ($errors->has('end_date'))
                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-block btn-warning sa-warning remove_row "><i class="fa fa-trash"></i>Delete</button>
                </td>
            </tr>
        </table>
        <table>
            <tr class="error-edu">
                <td>
                    <p class="error errors text-danger" id="level[]"></p>
                </td>
                <td>
                    <p class="error errors text-danger" id="college[]"></p>
                </td>
                <td>
                    <p class="error errors text-danger" id="university[]"></p>
                </td>
                <td>
                    <p class="error errors text-danger" id="start_date[]"></p>
                </td>
                <td>
                    <p class="error errors text-danger" id="end_date[]"></p>
                </td>
            </tr>
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
    function displayErrorMessage(elementId, message) {
        var errorElement = document.getElementById(elementId + "-error");
        if (errorElement) {
            errorElement.innerHTML = message;
        }
    }


    function validateForm() {
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");

        // Clear all error messages
        var errorElements = document.getElementsByClassName("error");
        for (i = 0; i < errorElements.length; i++) {
            errorElements[i].innerHTML = "";
        }

        // Validate each field
        for (i = 0; i < y.length; i++) {
            var value = y[i].value.trim();
            var fieldName = y[i].name;

            if (value === "" && fieldName !== "image") {
                y[i].className += " invalid";
                valid = false;
                document.getElementById(fieldName).innerHTML = "This field is required.";
            } else {
                // Additional checks for specific fields
                if (fieldName === "name" && !/^[a-zA-Z\s]+$/.test(value)) {
                    y[i].className += " invalid";
                    valid = false;
                    document.getElementById("name").innerHTML = "Please enter a valid name (only text characters are allowed).";
                } else if (fieldName === "email" && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    y[i].className += " invalid";
                    valid = false;
                    document.getElementById("email").innerHTML = "Please enter a valid email address.";
                } else if (fieldName === "phone" && !/^[0-9]{10}$/.test(value)) {
                    y[i].className += " invalid";
                    valid = false;
                    document.getElementById("phone").innerHTML = "Please enter a valid phone number.";
                }
            }
        }

        // If the valid status is true, mark the step as finished and valid
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }

        return valid;
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

        $(document).ready(function (e) {


        $('#image').change(function(){

            let reader = new FileReader();

            reader.onload = (e) => {

                $('#preview-image-before-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

    });

</script>
</script>
@endsection

