<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.headder')


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

        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">
                    <div class="main_heading d-flex justify-content-between mb-2 shadow p-2 subheading">
                        <div>
                            <h5 class="pt-3 ">Import Data</h5>
                        </div>
                        <div class="text-end">
                            <a href="{{ asset('assets/download/file.xlsx') }}"   class="btn btn-secondary" download>Sample Excel</a> 
                        </div>
                    </div>
                   
                    <div class="admintoolbar">
                        <div class="card card-body">

                            <div class="row justify-content-between">



                                <form id="myForm" method="POST" action="{{ route('ImportData.import') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="text-end">
                                        <div class="row">
                                            <div class="col-lg-4 col-6 mt-3">
                                                <select class="form-select inputfield" id="leaddata" name="leaddata">
                                                    <option hidden class="inputlabel" value="0"> Choose Enquiry DataType
                                                    </option>
                                                    <option class="inputlabel" value="LD">LEAD DATA</option>
                                                    <option class="inputlabel" value="ED">ENQUIRY DATA</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-6 mt-3">
                                                <select class="form-select inputfield" id="enquirytype"
                                                    name="enquirytype">
                                                    <option hidden class="inputlabel" value=""> Choose Enquiry
                                                        Source</option>
                                                    @foreach ($EnquiryType as $key)
                                                        <option class="inputlabel" value="{{ $key->id }}">
                                                            {{ $key->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-6 mt-3">
                                                <select class="form-select inputfield" id="branch" name="branch">
                                                    <option hidden class="inputlabel" value=""> Choose Branch
                                                    </option>
                                                    @foreach ($branch as $key)
                                                        <option class="inputlabel" value="{{ $key->id }}">
                                                            {{ $key->branch_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="file">File:</label>
                                        <input id="file" type="file" name="file" class="form-control">
                                        <button class="btn btn-primary m-3" style="position: relative; left: 40%;"
                                            type="submit">Import</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


    </main><!-- End #main -->

    @include('layouts.footer')

    <script>
        var leadDataSelect = document.getElementById("leaddata");
        var branchSelect = document.getElementById("branch");

        leadDataSelect.addEventListener("change", function() {
            if (leadDataSelect.value === "LD") {
                branchSelect.disabled = true;
            } else {
                branchSelect.disabled = false;
            }
        });
    </script>



</body>


</html>
