<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.headder')

    @livewireStyles
</head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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

        @livewire('task')

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
        document.addEventListener('livewire:load', function() {
            Livewire.on('confirmDelete', taskId => {
                swal({
                        title: 'Are you sure?',
                        text: 'If deleted, you will not be able to recover this imaginary file!',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            Livewire.emit('deleteConfirmed', taskId);
                        }
                    });
            });

            Livewire.on('deleteSuccess', () => {
                swal({
                    title: 'Success',
                    text: 'Data deleted successfully.',
                    icon: 'success',
                    timer: 3000,
                });
            });
        });

        //Data Table


        $('#SearchBar').keyup(function() {
            MasterTable.search($(this).val()).draw();
        });





        window.addEventListener('close-modal', event => {

            $('#exampleModal').modal('hide');
            $('#openUpdateModal').modal('hide');
            $('#delModal').modal('hide');
        })
    </script>


    @livewireScripts
</body>

</html>
