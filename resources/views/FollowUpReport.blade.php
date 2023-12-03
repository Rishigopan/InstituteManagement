<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.headder')
    {{-- <style>
            .mainContents{
                display:none;
            }
        </style> --}}
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
    <main id="main" class="">

        <div class="container-fluid ">
            <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Follow Up Report </h4>
        </div>

        <div class="wrapper">



            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body main_card mt-2 p-3 mb-2">
                    <form class="FollowUpForm AddForm" id="followupform" novalidate>
                        <div class="main_heading mb-2">
                            <div class="container-fluid d-flex justify-content-between">
                                <div class="row">
                                    <div class="col-lg-2 col-12 col-sm-6 ps-0">
                                        <select class="form-select inputfield mt-1 "
                                            aria-label="Default select example name" id="branch" name="branch"
                                            autofocus required>
                                            <option class="inputlabel" value="">Select Branch</option>
                                            @foreach ($branches as $key)
                                                <option class="inputlabel" value="{{ $key->id }}">
                                                    {{ $key->branch_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-12 col-sm-6">
                                        <div class="row">
                                            <div class="col-5">
                                                <input type="date" class="form-control mt-1 inputfield"
                                                    id="from_date" name="FromDate" placeholder=""
                                                    value="<?php echo date('Y-m-d'); ?>" autofocus>
                                            </div>
                                            <div class="col-2 text-center mt-3">
                                                TO</div>
                                            <div class="col-5">
                                                <input type="date" class="form-control mt-1 inputfield"
                                                    id="to_date" name="ToDate" placeholder=""
                                                    value="<?php echo date('Y-m-d'); ?>" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-12 col-sm-6">
                                        <select class="form-select inputfield mt-1"
                                            aria-label="Default select example name" id="datatype" name="Datatype"
                                            autofocus required>
                                            <option value="0">Select Datatype</option>
                                            <option value="LD">Lead Data</option>
                                            <option value="ED">Enquiry Data</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-12 col-sm-6 pe-0">
                                        <select class="form-select inputfield mt-1"
                                            aria-label="Default select example name" id="enquiry_type"
                                            name="EnquiryType" autofocus required>
                                            <option class="inputlabel" value="">Select Enquiry Source</option>
                                            @foreach ($enquirySource as $key)
                                                <option class="inputlabel" value="{{ $key->id }}">
                                                    {{ $key->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class=" row col-12 justify-content-between mt-3">
                                        <div id="exportbtns"class="exportbtns col-lg-6 col-12 ps-0">
                                            <!-- export buttons -->
                                        </div>
                                        <div class="col-lg-6 col-12 d-flex justify-content-end pe-0">
                                            <button type="submit me-2" id="search"
                                                class="btn savebtn px-4 ">Search</button>

                                            <a class="ms-3 " href="{{ url('/FollowupPage') }}">
                                                <button type="button" id="reset"
                                                    class="btn savebtn px-4 ">Reset</button>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive mt-2" id="result">
                        <table class="table table-hover MasterTable" id="MasterTable" style="width: 100%;">
                            <thead class="tablehead">
                                <tr>
                                    <th class="text-center">Si No</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Course</th>
                                    <th class="text-center">Feedback Status</th>
                                    <th class="text-center">Branch</th>
                                    <th class="text-center">Data Type</th>
                                    <th class="text-center">Next Follow Up</th>
                                    <th class="text-center">Enquiry Source</th>
                                    <th class="text-center">Remarks</th>
                                    <th class="text-center">Call</th>
                                    <th class="text-center">SMS</th>
                                    <th class="text-center">Whatsapp</th>
                                </tr>
                            </thead>
                            <tbody id="tb">
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                            </tbody>
                        </table>
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


    <script type="text/javascript">
     

        $.fn.dataTable.ext.errMode = 'none';

        var dataTableInstance = null;

        $(document).on('submit', '#followupform', (function(e) {
            e.preventDefault();
            var Branch = $('#branch').val();
            var Datatype = $('#datatype').val();
            var FromDate = $('#from_date').val();
            var ToDate = $('#to_date').val();
            var EnquirySource = $('#enquiry_type').val();

            var settings = {
                "url": "/api/followupreportdata?branch=" + Branch + "&FromDate=" + FromDate + "&ToDate=" +
                    ToDate + "&Datatype=" + Datatype + "&EnquirySource=" + EnquirySource,
                "method": "GET",
                "timeout": 0,
                "headers": {
                    "Accept": "application/json"
                },
            };

            $.ajax(settings).done(function(response) {
                // Destroy the previous DataTable instance
                if (dataTableInstance !== null) {
                    dataTableInstance.destroy();
                }
                var FollowupResult = JSON.stringify(response);
                var FollowupView = JSON.parse(FollowupResult);
                if (FollowupView.success == true) {
                    var FollowupDataArray = FollowupView.enquiries;
                    FollowupDataArray = FollowupDataArray.enquiries;

                    const tb = $('#tb');
                    let tr = [];
                    FollowupDataArray.forEach((item, index) => {
                        tr.push('<tr>');
                        tr.push('<td class="text-center">' + (index + 1) + '</td>');

                        // Check and replace null values with empty spaces
                        const name = item.name !== null ? item.name : "";
                        const printableName = item.printable_name !== null ? item
                            .printable_name : "";
                        const feedback = item.feedback !== null ? item.feedback : "";
                        const branchName = item.branch_name !== null ? item.branch_name : "";
                        const leadData = item.leaddata !== null ? item.leaddata : "";
                        const nextFollowUp = item.next_folow_up !== null ? item.next_folow_up :
                            "";
                        const remarks = item.remarks !== null ? item.remarks : "";
                        const EnqSource = item.EnqSource !== null ? item.EnqSource : "";
                        tr.push('<td class="text-center">' + name + '</td>');
                        tr.push('<td class="text-center">' + printableName + '</td>');
                        tr.push('<td class="text-center">' + feedback + '</td>');
                        tr.push('<td class="text-center">' + branchName + '</td>');
                        if (leadData === "ED") {
                            tr.push('<td class="text-center">Enquiry Data</td>');
                        } else if (leadData === "LD") {
                            tr.push('<td class="text-center">Lead Data</td>');
                        } else {
                            tr.push('<td class="text-center"></td>');
                        }
                        tr.push('<td class="text-center">' + nextFollowUp + '</td>');
                        tr.push('<td class="text-center">' + EnqSource + '</td>');
                        tr.push('<td class="text-center">' + remarks + '</td>');
                        // Add icons for phone, SMS, and WhatsApp
                        tr.push(
                            '<td class="text-center"> <a href=tel:"'+item.mob_no +'"> <i class="bi bi-telephone-plus-fill"></i> </a> </td>');
                        tr.push(
                            '<td class="text-center"><i class="bi bi-chat-quote-fill"></i></td>');
                        tr.push('<td class="text-center"><a href=https://wa.me/91"'+item.mob_no+'"><i class="bi bi-whatsapp"></i></a></td>');

                        tr.push('</tr>');
                    });

                    tb.html(tr.join(""));


                    // Initialize DataTable with pagination and buttons
                    dataTableInstance = $('#MasterTable').DataTable({
                        processing: true,
                        orderCellsTop: true,
                        fixedHeader: true,
                        "dom": 'Blrt<"bottom"ip>',
                        "pagingType": 'simple_numbers',
                        "language": {
                            "paginate": {
                                "previous": "<i class='bi bi-caret-left-fill'></i>",
                                "next": "<i class='bi bi-caret-right-fill'></i>"
                            }
                        },
                        buttons: [{
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                },
                                customize: function(win) {
                                    $(win.document.body).find('table').addClass(
                                        'display').css('font-size', '12px');
                                    $(win.document.body).find('tr:nth-child(even) td')
                                        .each(function(index) {
                                            $(this).css('background-color',
                                                '#ebebeb');
                                        });
                                    $(win.document.body).find('h1').css('text-align',
                                        'center');
                                }
                            },
                        ],
                        initComplete: function() {
                            $('.dt-buttons').appendTo('#exportbtns');
                        }
                    });
                }
            });
        }));
    </script>

</body>

</html>
