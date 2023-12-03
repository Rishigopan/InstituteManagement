<!DOCTYPE html>
<html lang="en">

  <head>

     @include('layouts.headder')
     <style>
        .mainContents{
            display:none;
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

            
                <div class="container-fluid px-4 ">
                    <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Direct Admission</h4>             
                </div>
                
                <div class="wrapper">
                    <!--CONTENTS-->
                    <div class="container-fluid mainContents">
                        <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">                           
                            <div class="main_heading d-flex justify-content-between mb-2 shadow p-2 subheading">
                                <div id="exportbtns"class="exportbtns">
                                    <!-- export buttons -->
                                </div>
                                <div>
                                    <input type="text" class="form-control text-center" id="SearchBar" placeholder="Search">
                                </div>
                               
                            </div>
                            <div class="admintoolbar">
                               
                            </div>
                            <div class="table-responsive">
                                <table class="table  table-hover MasterTable" id="MasterTable" style="width: 100%;">
                                    <thead class=" tablehead">
                                        <tr>
                                            <th class="text-center">Sl No</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Mobile Number</th>
                                        </tr>                                           
                                    </thead>
                                    <tbody>
                                    
                                    </tbody>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="loader">
                <div class="">
                    <img class="img-fluid" src="{{url('assets/images/loading.gif')}}">
                    <h4 class="text-center">LOADING</h4>
                </div>
            </div>
        </main><!-- End #main -->  

         @include('layouts.footer')

<script>
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
                
                initComplete: function () {
                    $("#MasterTable").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
                    var api = this.api();
                        // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            if (colIdx < api.columns().nodes().length - 1) {
                                $(cell).html('<input type="text" class="text-center searchcolumn" placeholder="Search" />');
                            } else {
                                $(cell).empty();
                            }         
                            // On every keypress in this input
                            $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                                .off('keyup change')
                                .on('change', function (e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})'; //$(this).parents('th').find('select').val();
        
                                    // var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != ''
                                                ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                : '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function (e) {
                                    e.stopPropagation();
        
                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        // .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
                
                ajax: "{{ route('DirectAdmission.EnquiryTable') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'}, 
                    {data: 'mob_no', name: 'mob_no'},
                    
                ]
            });
            //Searchbar
            $('#SearchBar').keyup(function() {
                    MasterTable.search($(this).val()).draw();
                });

</script>

         </body>

</html>