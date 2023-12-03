<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
      @media screen and (max-width: 600px) {
      .main_heading d-flex justify-content-between mb-2 shadow p-6 subheading {
         width: 100%;
         height:550px;

      }
   }
   /* .main_heading d-flex justify-content-between mb-2 shadow p-6 subheading{
    height:250px;
    width:100%;
   
   } */
</style>
     @include('layouts.headder')

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

            @livewire('student-card')
                    
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

               
    
    
    
    
      
                
            </script>
            @livewireScripts
           
        </body>
      
    </html>