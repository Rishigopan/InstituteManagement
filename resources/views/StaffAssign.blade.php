<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.headder')
    <style>
        .mainContents {
            display: none;
        }
    </style>

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
        <!-- Modal -->
        <div class="modal fade delModal" id="delModal" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title " id="exampleModalLabel">Delete Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">Do you want to delete this Staff Assign ?</h4>
                        <div class="text-center mt-3">
                            <button type="button" id="confirmYes" class="btn btn-primary me-5">Yes</button>
                            <button type="button" id="confirmNo" class="btn btn-secondary ms-5"
                                data-bs-dismiss="modal">No</button>
                        </div>
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

        <div class="container-fluid">
            <h4 class=" mt-1 d-flex justify-content-center py-1 contitle">Staff Assign</h4>
        </div>
        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body main_card mt-2  p-3 mb-2">
                    <div>
                        <div>
                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-md-4 col-6 mt-2">
                                    <select class="form-select leadDrop" id="leaddata" name="leaddata">
                                        <option value="LD">Lead Data</option>
                                        <option value="ED">Enquiry Data</option>
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-4 col-6 mt-2">
                                    <select class="form-select sourceDrop" id="source" name="source">
                                        <option value="0">Select Source</option>
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-4 col-6 mt-2">
                                    <select id="branch" class="form-select branchDrop" name="Branch">
                                        <option value="0">Select a branch</option>
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-4 col-6 mt-2">
                                    <select class="form-select assigndrop staffDrop" id="assign_to" name="AssignTo">
                                        <option value="0">Select Staff</option>
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-4 col-6 mt-2">
                                    <button id="refresh_button" type="button" class="btn w-100 serachBtn">
                                        <i class="bi bi-arrow-clockwise"></i> &nbsp;Reset
                                    </button>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-4 col-6 mt-2">
                                    <button id="search_button" type="button" class="btn w-100 serachBtn">
                                        <i class="bi bi-search"></i> &nbsp;Search
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 ms-1">
                            <div class="col-xl-3 col-lg-4 col-md-6 col-6 p-1">
                                <div class="assignenqry-card ">
                                    <div class="row p-2">
                                        <div class="col-8 ">
                                            <h6 class="mb-0 "><b>Total Enquiries</b></h6>
                                            <p class="ms-2 assigncard mb-1"><strong id="show_total_enquiries"></strong>
                                            </p>
                                        </div>
                                        <div class="col-4 px-2">
                                            <img class="assignimage" src="{{ url('assets/images/assignsenquiry.png') }}"
                                                style="width:70px; height:60px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-6 p-1">
                                <div class="assigned-card">
                                    <div class="row p-2">
                                        <div class="col-8 ">
                                            <h6 class=" mb-0"><b>Assigned</b></h6>
                                            <p class="ms-2 assigncard mb-1"><strong
                                                    id="show_assigned_enquiries"></strong></p>
                                        </div>
                                        <div class="col-4 px-2">
                                            <img class="assignimage" src="{{ url('assets/images/assignstaffs.png') }}"
                                                style="width:70px; height:60px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-6 p-1">
                                <div class="unassign-card">
                                    <div class="row p-2">
                                        <div class="col-8 ">
                                            <h6 class="mb-0 "><b>Un Assigned</b></h6>
                                            <p class="ms-2 assigncard mb-1"><strong
                                                    id="show_unassigned_enquiries"></strong></p>
                                        </div>
                                        <div class="col-4 px-2">
                                            <img class="assignimage"
                                                src="{{ url('assets/images/unassignstaffs.png') }}"
                                                style="width:70px; height:60px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div id="exportbtns" class="exportbtns col-lg-6 col-12 ">
                            <div class="dt-buttons btn-group flex-wrap">
                          <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0">Excel</button>
                          <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0">PDF</button>
                          <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0">Print</button>
                        </div>
                        </div> --}}
                        <div class="row justify-content-end">
                            <div class="col-1">
                                <div class="page-length">
                                    {{-- <label for="page-length-select">Page Length:</label> --}}
                                    <select id="page-length-select" class="form-select">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table MasterTable table-hover stafasgntble " id="MasterTable"
                                style="width: 100%;">
                                <thead class=" tablehead">
                                    <tr>
                                        <th class="text-start ps-4"><input type="checkbox"
                                                class="pe-3 form-check-input" id="select_all_checkbox"> Select All
                                        </th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center"> Mobile Number</th>
                                        <th class="text-center"> Course</th>
                                        <th class="text-center"> Branch</th>
                                        <th class="text-center"> Data Type</th>
                                        <th class="text-center"> Enquiry Source</th>
                                    </tr>
                                </thead>
                                <tbody id="ViewEnquiryResults">


                                </tbody>
                            </table>

                            <div class="my-3 text-center">

                                <button id="assign_btn" class="btn AddBtn px-4"> Assign Enquirie </button>

                            </div>
                            <div class="pagination-container d-flex justify-content-end">
                                <div class="pagination"></div>

                            </div>



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
    <script>
        var currentPage = 1;
        //var ItemsPerPage = 10;
        var totalItems = 0;
        var totalPages = 0;
        var pageLength = 10
        var isFetchingData = false; // Flag to track ongoing requests


        // Reset All
        $(document).on('click', '#refresh_button', function() {
            $('#ViewEnquiryResults').empty();
            currentPage = 1;
            $('.pagination').empty();
        })


        //Select all Togggle
        $('#select_all_checkbox').click(function() {
            if ($(this).prop('checked') == true) {
                $('.SelectEnquiries').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.SelectEnquiries').each(function() {
                    $(this).prop('checked', false);
                });
            }
        });


        //DependentDropdown of brachwise select the staff
        $('.branchDrop').change(function() {
            var branch = $(this).val();
            $('.staffDrop').empty();
            $('.staffDrop').append('<option value="0">Select Staff</option>');
            $.get('/getstaff/' + branch, function(staff) {
                console.log(staff);
                $.each(staff, function(index, staff) {
                    $('.staffDrop').append('<option value="' + staff.id + '">' + staff.name +
                        '</option>');
                });
            });
        });


        // Show Enquiry Source
        LoadDropdowns('enquiry-type', 'enquirytype', 'source', 'name', 'Source');


        // Show Branch
        LoadDropdowns('branches', 'branches', 'branch', 'branch_name', 'Branch');



        // Function to show data in dropdown 
        function LoadDropdowns(MasterLink, MasterName, SelectFieldId, NameColumn, DefaultName) {
            $('#' + SelectFieldId).empty();
            $('#' + SelectFieldId).append('<option value="0">Select ' + DefaultName + '</option>');
            var settings = {
                "url": "/api/" + MasterLink,
                "method": "GET",
                "timeout": 0,
                "headers": {
                    "Accept": "application/json"
                },
            };
            $.ajax(settings).done(function(response) {
                Response = response[MasterName];
                Response.forEach(function(result, index) {
                    var Options = '<option value="' + result.id + '">' + result[NameColumn] + '</option>';
                    $('#' + SelectFieldId).append(Options);
                    //console.log(Options);
                });
            });
        }


        // Search and filter 
        $(document).on('click', '#search_button', function() {
            fetchData(currentPage, pageLength);
            //calculateTotalPages();
            //generatePaginationButtons();
        })



        // Assign Staff
        $(document).on('click', '#assign_btn', function() {

            var SelectedEnquiriesArray = [],
                SelectedStaff = $('#assign_to').val();

            $('.SelectEnquiries:checked').each(function() {
                SelectedEnquiriesArray.push($(this).val());
            });


            if (SelectedEnquiriesArray.length <= 0) {
                toastr.warning("Please select atleast one enquiry");
                return false;
            }


            if (SelectedStaff == 0 || SelectedStaff == '') {
                toastr.warning("Please select staff");
                return false;
            }

            //console.log(SelectedEnquiriesArray.join());

            var settings = {
                "url": "/api/staffassign/assign-staff",
                "method": "PUT",
                "timeout": 0,
                "headers": {
                    "Accept": "application/json",
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                "data": {
                    "Enquiries": SelectedEnquiriesArray.join(),
                    "Staff": SelectedStaff
                }
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                if (response.success == true) {
                    if (response.code == "0") {
                        swal("Warning", response.message, "warning");
                    } else if (response.code == "1") {
                        $('#select_all_checkbox').prop('checked', false);
                        swal("Success", response.message, "success");
                        fetchData(currentPage, pageLength);
                        generatePaginationButtons(); // Update pagination buttons
                    } else if (response.code == "2") {
                        swal("Error", response.message, "error");
                    }
                } else {
                    swal("Error", response.message, "error");
                }
            });


        })




        //Function to append to table
        function SearchResults(Response) {
            // Clear the existing results

            $('#ViewEnquiryResults').empty();
            if (Response.length > 0) {
                Response.forEach(function(data) {
                    var row = '<tr>' +
                        '<td class="text-start ps-4"><input class="form-check-input SelectEnquiries" type="checkbox" value="' +
                        data.id +
                        '"></td>' +
                        '<td>' + (data.name !== null ? data.name : '') + '</td>' +
                        '<td>' + data.mob_no + '</td>' +
                        '<td>' + (data.Course !== null ? data.Course : '') + '</td>' +
                        '<td>' + data.Branch + '</td>' +
                        '<td>' + data.leaddata + '</td>' +
                        '<td>' + (data.Source !== null ? data.Source : '') + '</td>' +
                        '</tr>';

                    $('#ViewEnquiryResults').append(row);
                });
            }

        }




        function fetchData(Page, pageLength) {

            if (isFetchingData) {
                return; // Ignore the request if a request is already in progress
            }

            isFetchingData = true; // Set the flag to indicate a request is in progress



            var DataType = $('#leaddata').val();
            var DataSource = $('#source').val();
            var Branch = $('#branch').val();

            var settings = {
                "url": "/api/staffassign/show-enquiries",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Accept": "application/json",
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                "data": {
                    "DataType": DataType,
                    "DataSource": DataSource,
                    "Branch": Branch,
                    "Page": Page,
                    "PerPage": pageLength,
                    //"Staff": ""
                }
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                totalItems = response.totalCount;
                $('#show_unassigned_enquiries').text(response.unAssignedEnquiries);
                $('#show_assigned_enquiries').text(response.assignedEnquiries);
                $('#show_total_enquiries').text(response.totalEnquiries);
                SearchResults(response.results);
                // if (currentPage === 1 && totalPages === 0) {
                //     calculateTotalPages();
                //     generatePaginationButtons();
                // }

                isFetchingData = false; // Reset the flag after the request is completed
                calculateTotalPages();
                generatePaginationButtons();
            });

        }



        // Function to generate pagination buttons
        function generatePaginationButtons() {

            //console.log(totalItems);

            var paginationContainer = $('.pagination');
            paginationContainer.empty();


            var prevButton = $('<button>').addClass('btn btn-primary').text('Previous');
            if (currentPage === 1) {
                prevButton.addClass('disabled');
            }
            prevButton.on('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    fetchData(currentPage, pageLength);
                    generatePaginationButtons(); // Update pagination buttons
                }
            });
            paginationContainer.append(prevButton);

            var startPage = 1;
            var endPage = totalPages;

            if (totalPages > 3) {
                // Calculate the start and end page based on current page
                if (currentPage <= 2) {
                    endPage = Math.min(3, totalPages);
                } else if (currentPage >= totalPages - 1) {
                    startPage = Math.max(totalPages - 2, 1);
                } else {
                    startPage = currentPage - 1;
                    endPage = currentPage + 1;
                }
            }

            if (startPage > 1) {
                // Show the first page button if it's not part of the pagination range
                var firstPageButton = $('<button>').addClass('btn btn-secondary').text(1);
                if (currentPage === 1) {
                    firstPageButton.removeClass('btn-secondary').addClass('btn-primary');
                }
                firstPageButton.on('click', function() {
                    currentPage = 1;
                    fetchData(currentPage, pageLength);
                    generatePaginationButtons(); // Update pagination buttons
                });
                paginationContainer.append(firstPageButton);
            }

            // Show the range of pages between startPage and endPage
            for (var i = startPage; i <= endPage; i++) {
                var pageButton = $('<button>').addClass('btn btn-secondary').text(i);
                if (i === currentPage) {
                    pageButton.removeClass('btn-secondary').addClass('btn-primary');
                }
                pageButton.on('click', function() {
                    currentPage = parseInt($(this).text());
                    fetchData(currentPage, pageLength);
                    generatePaginationButtons(); // Update pagination buttons
                });
                paginationContainer.append(pageButton);
            }

            if (endPage < totalPages) {
                // Show the last page button if it's not part of the pagination range
                var lastPageButton = $('<button>').addClass('btn btn-secondary').text(totalPages);
                if (currentPage === totalPages) {
                    lastPageButton.removeClass('btn-secondary').addClass('btn-primary');
                }
                lastPageButton.on('click', function() {
                    currentPage = totalPages;
                    fetchData(currentPage, pageLength);
                    generatePaginationButtons(); // Update pagination buttons
                });
                paginationContainer.append(lastPageButton);
            }
            var nextButton = $('<button>').addClass('btn btn-primary').text('Next');
            if (currentPage === totalPages) {
                nextButton.addClass('disabled');
            }
            nextButton.on('click', function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    fetchData(currentPage, pageLength);
                    generatePaginationButtons(); // Update pagination buttons
                }
            });
            paginationContainer.append(nextButton);

            var pageLengthSelect = $('#page-length-select');
            pageLengthSelect.val(pageLength);
            pageLengthSelect.on('change', function() {
                pageLength = parseInt($(this).val());
                currentPage = 1; // Reset current page to 1
                fetchData(currentPage, pageLength);
                calculateTotalPages();
                generatePaginationButtons(); // Update pagination buttons
            });


        }



        // Function to calculate the total number of pages
        function calculateTotalPages() {
            totalPages = Math.ceil(totalItems / pageLength);
        }


        // calculateTotalPages();
        // generatePaginationButtons();

        // Call the API function and generate pagination buttons
        //fetchData(currentPage);

        // Simulate getting the total items count from the API response
        //totalItems = 416; // Replace with the actual total items count


        // // Function to generate pagination buttons
        // function generatePaginationButtons() {

        //     //console.log(totalItems);

        //     var paginationContainer = $('.pagination');
        //     paginationContainer.empty();


        //     var prevButton = $('<button>').addClass('btn btn-primary').text('Previous');
        //     if (currentPage === 1) {
        //         prevButton.addClass('disabled');
        //     }
        //     prevButton.on('click', function() {
        //         if (currentPage > 1) {
        //             currentPage--;
        //             fetchData(currentPage, pageLength);
        //             generatePaginationButtons(); // Update pagination buttons
        //         }
        //     });
        //     paginationContainer.append(prevButton);

        //     // Show first 3 pages
        //     for (var i = 1; i <= Math.min(3, totalPages); i++) {
        //         var pageButton = $('<button>').addClass('btn btn-secondary').text(i);
        //         if (i === currentPage) {
        //             pageButton.removeClass('btn-secondary').addClass('btn-primary');
        //         }
        //         pageButton.on('click', function() {
        //             currentPage = parseInt($(this).text());
        //             fetchData(currentPage, pageLength);
        //             generatePaginationButtons(); // Update pagination buttons
        //         });
        //         paginationContainer.append(pageButton);
        //     }

        //     // Show "..." if there are more pages before the current page
        //     if (currentPage > 3) {
        //         var ellipsisButton = $('<button>').addClass('btn btn-secondary disabled').text('...');
        //         paginationContainer.append(ellipsisButton);
        //     }

        //     // Calculate the range of pages to display dynamically
        //     var startPage = Math.max(currentPage - 1, 4);
        //     var endPage = Math.min(currentPage + 1, totalPages - 3);

        //     // Show the range of pages between startPage and endPage
        //     for (var i = startPage; i <= endPage; i++) {
        //         var pageButton = $('<button>').addClass('btn btn-secondary').text(i);
        //         if (i === currentPage) {
        //             pageButton.removeClass('btn-secondary').addClass('btn-primary');
        //         }
        //         pageButton.on('click', function() {
        //             currentPage = parseInt($(this).text());
        //             fetchData(currentPage, pageLength);
        //             generatePaginationButtons(); // Update pagination buttons
        //         });
        //         paginationContainer.append(pageButton);
        //     }

        //     // Show "..." if there are more pages after the current page
        //     if (currentPage < totalPages - 2) {
        //         var ellipsisButton = $('<button>').addClass('btn btn-secondary disabled').text('...');
        //         paginationContainer.append(ellipsisButton);
        //     }

        //     // Show last 3 pages or all pages if total pages <= 3
        //     for (var i = totalPages - 2; i <= totalPages; i++) {
        //         var pageButton = $('<button>').addClass('btn btn-secondary').text(i);
        //         if (i === currentPage) {
        //             pageButton.removeClass('btn-secondary').addClass('btn-primary');
        //         }
        //         pageButton.on('click', function() {
        //             currentPage = parseInt($(this).text());
        //             fetchData(currentPage, pageLength);
        //             generatePaginationButtons(); // Update pagination buttons
        //         });
        //         paginationContainer.append(pageButton);
        //     }

        //     var nextButton = $('<button>').addClass('btn btn-primary').text('Next');
        //     if (currentPage === totalPages) {
        //         nextButton.addClass('disabled');
        //     }
        //     nextButton.on('click', function() {
        //         if (currentPage < totalPages) {
        //             currentPage++;
        //             fetchData(currentPage, pageLength);
        //             generatePaginationButtons(); // Update pagination buttons
        //         }
        //     });
        //     paginationContainer.append(nextButton);

        //     var pageLengthSelect = $('#page-length-select');
        //     pageLengthSelect.val(pageLength);
        //     pageLengthSelect.on('change', function() {
        //         pageLength = parseInt($(this).val());
        //         currentPage = 1; // Reset current page to 1
        //         fetchData(currentPage, pageLength);
        //         calculateTotalPages();
        //         generatePaginationButtons(); // Update pagination buttons
        //     });


        // }
    </script>


</body>

</html>
