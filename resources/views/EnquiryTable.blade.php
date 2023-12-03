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

        <div class="modal fade delModal" id="delModal" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title " id="exampleModalLabel">Delete Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">Do you want to delete this Enquiry?</h4>
                        <div class="text-center mt-3">
                            <button type="button" id="confirmYes" class="btn btn-primary me-5">Yes</button>
                            <button type="button" id="confirmNo" class="btn btn-secondary ms-5"
                                data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <div class="container-fluid px-4 ">
            <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Enquiry </h4>
        </div>
        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">

                    <div class="main_heading d-flex justify-content-between mb-2 shadow p-2 subheading">
                        <div>
                            <input type="text" class="form-control text-center" id="SearchBar" placeholder="Search">
                        </div>


                        {{-- <button class="me-3 exporticons"><i class="material-icons">file_upload</i></button> --}}

                        <div class="">
                            <a href="{{ url('/ImportDatas') }}"><i> <img src="{{ url('assets/images/import.png') }}"
                                        style="width:40px; height:40px;"></i></a>
                            <a class="btn AddBtn px-4" href="{{ url('/enquiry') }}">+ Add</a>
                            {{-- <button class="me-3 exporticons"><i class="material-icons">file_upload</i></button> --}}
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table  table-hover MasterTable" id="MasterTable" style="width: 100%;">
                            <thead class=" tablehead">
                                <tr>
                                    <th class="text-center">Si No</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center"> Mobile</th>
                                    <th class="text-center">Branch</th>
                                    <th class="text-center">Data Type</th>
                                    <th class="text-center"> Remarks</th>

                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

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
    </main>

    @include('layouts.footer')


    <script type="text/javascript">
        $('.MasterTable thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('.MasterTable thead');
        var MasterTable = $('.MasterTable').DataTable({
            processing: true,
            orderCellsTop: true,
            fixedHeader: true,
            // serverSide: true,
            // scrollX: true,
            "dom": 'lrt<"bottom"ip>',
            "pagingType": 'simple_numbers',
            "language": {
                "paginate": {
                    "previous": "<i class='bi bi-caret-left-fill'></i>",
                    "next": "<i class='bi bi-caret-right-fill'></i>"
                }
            },

            initComplete: function() {
                $("#MasterTable").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
                var api = this.api();
                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function(colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        if (colIdx < api.columns().nodes().length - 1) {
                            $(cell).html(
                                '<input type="text" class="text-center searchcolumn" placeholder="Search" />'
                                );
                        } else {
                            $(cell).empty();
                        }
                        // On every keypress in this input
                        $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('change', function(e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                // var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '(((' + this.value + ')))') :
                                        '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function(e) {
                                e.stopPropagation();

                                $(this).trigger('change');
                                $(this)
                                    .focus()[0]
                                // .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },

            ajax: "{{ route('enquiryTable.EnquiryTable') }}",

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'mob_no',
                    name: 'mob_no'
                },

                {
                    data: 'branch_name',
                    name: 'branch_name'
                },
                {
                    data: 'leaddata',
                    name: 'leaddata',
                    render: function(data, type, row) {
                        if (data === 'LD') {
                            return 'Lead Data';
                        } else if (data === 'ED') {
                            return 'Enquiry Data';
                        }
                        return data;
                    }
                },
                {
                    data: 'remarks',
                    name: 'remarks'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        //Searchbar
        $('#SearchBar').keyup(function() {
            MasterTable.search($(this).val()).draw();
        });


        //Delete Course Type
        $('#MasterTable').on('click', '.btn_delete', function() {
            $('.delModal').modal('show');
            var DeleteEnType = $(this).val();
            $('#confirmYes').click(function() {

                console.log(DeleteEnType);
                var settings = {
                    "url": "/api/enquiry/" + DeleteEnType + "",
                    "method": "DELETE",
                    "timeout": 0,
                };
                $.ajax(settings).done(function(response) {
                    console.log(response);

                    var EnDeleteResult = JSON.stringify(response);
                    console.log(EnDeleteResult);
                    var EnDelObj = JSON.parse(EnDeleteResult);
                    if (EnDelObj.success == true) {
                        MasterTable.ajax.reload();
                        $('#delModal').modal('hide');
                        toastr.success("  Enquiry  Deleted successfully");

                    } else {
                        toastr.error("  Enquiry Not Deleted");
                    }
                });

            })


        });
    </script>
</body>

</html>
