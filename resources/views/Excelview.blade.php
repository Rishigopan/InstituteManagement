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

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">View Import Data </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <span style="color:red">Total Records:{{ $count }}</span>
                                {{-- Duplicate:{{$Duplicate}} --}}
                                <table id="example2" class="table table-bordered table-hover">

                                    <thead>
                                        <tr>
                                            <th>NAME</th>
                                            <th>MOBILE NUMBER</th>
                                            <th>COURSE</th>
                                            <th>CREATED AT</th>
                                            <th hidden></th>
                                            <th hidden></th>
                                            <th>LEAD DATA/ENQUIRY DATA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($uniqueData as $row)
                                       
                                            <tr>
                                                <td>{{ $row['name'] ?? '' }} </td>
                                                <td>{{ $row['mob_no'] }}</td>
                                                <td>{{ $row['course'] ?? '' }}</td>
                                                <td>{{ $row['created_at'] ?? '' }}</td>
                                                <td hidden>{{ $branch_id ?? 0 }}</td>
                                                <td hidden>{{ $enquirytype_id ?? 0 }}</td>
                                                <td>{{ $leaddata }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                                <form method="POST" action="{{ url('SAVEDATA') }}">
                                    @csrf
                                    <input type="text" name="data" value="{{ json_encode($uniqueData) }}" hidden>
                                    <input type="text" name="branch_id" value="{{ $branch_id }}" hidden>
                                    <input type="text" name="enquirytype_id" value="{{ $enquirytype_id }}" hidden>
                                    <input type="text" name="leaddata" value="{{ $leaddata }}" hidden>
                                    <button type="submit" class="btn btn-dark" style="position: relative; left: 40%;">Save & Check Import Data</button>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </main>
    @include('layouts.footer')

</body>

</html>
