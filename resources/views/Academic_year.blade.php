<!DOCTYPE html>
<html lang="en">

  <head>

     @include('layouts.headder')

    {{-- @livewireStyles --}}
    @livewireStyles
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

            @livewire('academic-year')
                    
               </div>
               <div class="loader">
                   <div class="">
                       <img class="img-fluid" src="{{url('assets/images/loading.gif')}}">
                       <h4 class="text-center">LOADING</h4>
                   </div>
               </div>
           </main><!-- End #main -->  
   
            @include('layouts.footer')

            @livewireScripts
            <script>
  
                window.addEventListener('swal:modal', event => { 
                    swal({
                      title: event.detail.message,
                      text: event.detail.text,
                      icon: event.detail.type,
                    });
                });
                  
                window.addEventListener('swal:confirm', event => { 
                    swal({
                      title: event.detail.message,
                      text: event.detail.text,
                      icon: event.detail.type,
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        window.livewire.emit('delete',event.detail.id);
                      }
                    });
                });
                 </script>
        </body>
      
    </html>