<!DOCTYPE html>
<html lang="en">
   
<head>

    @include('layouts.headder')
    <style>
        .mainContents {
            display: none;
        }
    </style>
        @livewireStyles
</head>

<body>

    <!-- ======= Header ======= -->

    <header id="header" class="header fixed-top d-flex align-items-center">
        @include('layouts.navbar')
    </header>

    <!-- End Header -->

    <!-- ======= Sidebar ======= -->

    <aside id="sidebar" class="sidebar ps-0">
        @include('layouts.sidebar')
    </aside>

    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="container-fluid px-4 ">
            <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Batch</h4>
        </div>
        
        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">
                    <div class="text-end">
                        <a href="{{ url('/BatchTable') }}">
                            <button class="btn AddBtn px-4">View</button>
                        </a>
                    </div>
                    <form class="BatchForm AddForm" id="Batch_form" novalidate>
                        <div class="row">

                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Branch</label><br>

                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="branch" name="Branch" autofocus required>
                                    <option hidden class="inputlabel" value=""> Choose Branch</option>
                                    @foreach ($branch as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->branch_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Acadamic Year</label><br>
                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="academic_year" name="AcademicYear" autofocus required>
                                    <option hidden class="inputlabel" value=""> Choose Academic Year</option>

                                    <option class="inputlabel" value="2023-2024">2023-2024
                                    </option>

                                </select>
                            </div>

                            <div class="main_heading d-flex justify-content-center my-2  p-1 formheading">
                                <div>
                                    <h5 class="pt- "> Course Details</h5>
                                </div>
                            </div>

                           @livewire('batch-dropdown')

                            <div class="main_heading d-flex justify-content-center my-2  p-1 formheading">
                                <div>
                                    <h5 class="pt- "> Batch Details</h5>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Name</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="name" name="Name"
                                    placeholder="please Enter BatchName" autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Batch No </label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="batch_no" name="BatchNo"
                                    placeholder="" autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Batch Type</label><br>
                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="batch_type" name="BatchType" autofocus required>
                                    <option hidden class="inputlabel" value=""> Choose BatchType</option>
                                    @foreach ($batchtype as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel">Seat</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="seat" name="Seat"
                                    placeholder="" autofocus required>
                            </div>
                            <div class="main_heading d-flex justify-content-center my-2  p-1 formheading">
                                <div>
                                    <h5 class="pt- "> Session Details</h5>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Session</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="session" name="Session"
                                    placeholder="" autofocus required>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Duration </label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="duration"
                                    name="Duration" placeholder="" autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel">Start Date</label><br>
                                <input type="date" class="form-control StartDate mt-1 inputfield" id="start_date"
                                    name="StartDate" placeholder="" autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Period </label><br>
                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="period" name="Period" autofocus required>
                                    <option hidden class="inputlabel" value=""> Choose Period</option>

                                    <option class="inputlabel" value="month">Month</option>
                                    <option class="inputlabel" value="module">Module</option>
                                    <option class="inputlabel" value="year">Year</option>


                                </select>
                            </div>
                            <div class="row mt-4">
                                <div class="table-responsive" id="result">
                                    <table class="table  table-hover MasterTable" id="MasterTable"
                                        style="width: 100%;">
                                        <thead class="table  tablehead">
                                            <tr>
                                                <th  class="text-center"></th>
                                                <th class="text-center">Session From</th>
                                                <th class="text-center">Session To</th>

                                            </tr>
                                        </thead>
                                        <tbody id="tb">
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class=" text-end mt-3">
                                <button type="submit" class="btn savebtn  px-5 ">Save</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <!-- Response Modal -->
        <div class="modal fade ResponseModal" id="ResponseModal" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-3 py-5">
                        <div class="text-center mb-4" id="ResponseImage">

                        </div>
                        <h4 id="ResponseText" class="text-center mb-3"></h4>
                        <div class="text-center">
                            <button type="button" id="btnConfirm" style="display: none;"
                                class="btn btn_save mt-4 px-5 py-2" data-bs-dismiss="modal">Proceed</button>
                            <button type="button" id="btnClose" class="btn btn_save responsebtn mt-4 px-5 py-2"
                                data-bs-dismiss="modal">Okay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="loader">
            <div class="">
                <img class="img-fluid" src="{{ url('assets/images/loading.gif') }}">
                <h4 class="text-center">LOADING</h4>
            </div>
        </div>
    </main><!-- End #main -->

    @include('layouts.footer')
    @livewireStyles
</body>
<script type="text/javascript">
    //calculating the sessions
    $(document).on('change', '#start_date', function() {
        var Duration = $("#duration").val();
        var Session = $("#session").val();
        if (!Duration || !Session) return false; // Wait till both values are set
        var value = Duration / Session;
        console.log(value)
        var startdate = $("#start_date").val();

        console.log(startdate);
        const tb = document.getElementById("tb");
        let tr = [];
        for (let i = 1; i <= Session; i++) {
            var StartingDate = moment(startdate).format('DD/MMM/YYYY');
            console.log(StartingDate);
            var newDate = moment(StartingDate, "DD/MMM/YYYY").add(value, 'years').format('DD/MMM/YYYY');


            tr.push('<tr><td>' + '<input class="session_date form-check-input" type="checkbox" value="' +
                StartingDate + '-' + newDate + '">' + '</td>')
            tr.push('<td>' + StartingDate + '</td>')
            tr.push('<td>' + newDate + '</tr></td>')

            startdate = newDate;
            console.log(newDate);




        }

        tb.innerHTML = tr.join("");




    });
    //Date storing

    $("#Batch_form").validate({
        submitHandler: function(form, e) {
            e.preventDefault();

            var Branch = $('#branch').val();
            var AcadamicYear = $('#academic_year').val();
            var CourseProvider = $('#course_provider').val();
            var CourseName = $('#course_name').val();
            var BatchType = $('#batch_type').val();
            var BatchName = $('#name').val();
            var BatchNo = $('#batch_no').val();
            var Seat = $('#seat').val();
            var Session = $('#session').val();
            var Duration = $('#duration').val();
            var StartDates = $('.StartDate').val();
            var Period = $('#period').val();

            var SessionDateArray = [] //array declaration
            $('.session_date').each(function() {
                if ($(this).is(":checked")) {
                    SessionDateArray.push($(this).val());
                }
            });
            console.log(SessionDateArray);
            sessionDates = SessionDateArray.toString();
            console.log(sessionDates);

            $.ajax({
                url: "/api/batches",
                method: "POST",
                timeout: 0,
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                data: {
                    "branch_id": Branch,
                    "academic_year": AcadamicYear,
                    "course_provider_id": CourseProvider,
                    "course_name": CourseName,
                    "batch_name": BatchName,
                    "batch_no": BatchNo,
                    "batch_type_id": BatchType,
                    "seat": Seat,
                    "session": Session,
                    "duration": Duration,
                    "period": Period,
                    "startdate": StartDates,
                    "sessionDetails": sessionDates,
                },

                beforeSend: function() {
                    $('.loader').show();
                },
            }).done(function(response) {
                $('.loader').hide();
                $(".AddForm")[0].reset();
                console.log(response);
                var CoTypeUpdate = JSON.stringify(response);
                console.log(CoTypeUpdate);

                var CoTypeUpdateed = JSON.parse(CoTypeUpdate);
                if (CoTypeUpdateed.success == true) {
                    if (CoTypeUpdateed.code == "0") {
                        $('#ResponseImage').html(
                            '<img src="{{ url('assets/images/warning.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                        );
                        $('#ResponseText').text("Course is Already Present");
                        $('#ResponseModal').modal('show');
                    } else if (CoTypeUpdateed.code == "1") {
                        $('#ResponseImage').html(
                            '<img src="{{ url('assets/images/success.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                        );
                        $('#ResponseText').text("Successfully Updated Course");
                        $('#ResponseModal').modal('show');
                    } else if (CoTypeUpdateed.code == "2") {
                        $('#ResponseImage').html(
                            '<img src="{{ url('assets/images/error.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                        );
                        $('#ResponseText').text("Failed Update Course");
                        $('#ResponseModal').modal('show');
                    }
                } else {
                    $('#ResponseImage').html(
                        '<img src="{{ url('assets/images/error.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                    );
                    $('#ResponseText').text(
                        "Some Error Occured, Please refresh the page (ERROR : 12ENJ)");
                    $('#ResponseModal').modal('show');
                }

            });

        }

    });
    //Focus First Field
    $(document).ready(function() {
                $('#Batch_form').on('shown', function() {
                    $('#branch').focus();
                });
            });
</script>

</html>
