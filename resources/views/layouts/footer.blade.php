
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{url('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/vendor/chart.js/chart.min.js')}}"></script>
<script src="{{url('assets/vendor/echarts/echarts.min.js')}}"></script>
<script src="{{url('assets/vendor/quill/quill.min.js')}}"></script>
<script src="{{url('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{url('assets/vendor/tinymce/tinymce.min.js')}}"></script>
<script src="{{url('assets/vendor/php-email-form/validate.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{url('assets/js/main.js')}}"></script>
<!-- TOASTR SCRIPT -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>



<!-- Select Multiple Tag -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
<script>
    //Model Close        

    $(document).keydown(function(e) {
        var code = e.keyCode || e.which;
        if (code == 27) {     
            $(".addUpdateModal").modal('hide');         
        } 
    });

    $('form').on('keydown', 'input, select, textarea', function(e) {
        if (e.key === "Enter") {
            var self = $(this),
                form = self.parents('form:eq(0)'),
                focusable, next;
            focusable = form.find('input,a,select,button,textarea').filter(':visible');
            next = focusable.eq(focusable.index(this) + 1);
            if (next.length) {
                next.focus();
            } else {
                form.submit();
            }
            return false;
        }
    });

    //Multiple Selectors
    $(".multiselect").selectize({
        plugins: ["remove_button"],
        delimiter: ",",
        persist: false,
    });
    //Response Close
    const ResponseModel = document.getElementById('ResponseModal')
    const MyLee = document.getElementById('btnClose')
    ResponseModel.addEventListener('shown.bs.modal', event => {
        btnClose.focus();
    })


    //Delete Yes Focus
    const Deletebutton = document.getElementById('delModal')
    const Delbtn = document.getElementById('confirmYes')
    Deletebutton.addEventListener('shown.bs.modal', event => {
        Delbtn.focus();
    })

    //modal close function
    $(".addUpdateModal").on("hidden.bs.modal", function() {
                $(".UpdateForm").hide();
                $(".AddForm").show();
                $(".UpdateForm")[0].reset();
                $(".AddForm")[0].reset();
                $(".addUpdateModal").removeClass("error");
                var errorMessage = $('label.error');
                errorMessage.hide();
                var errorMessage = $('.inputfield.error');
                errorMessage.removeClass('error');
            });
//modal close function
$(".addUpdateModal").on("hidden.bs.modal", function() {
        $(".UpdateForm").hide();
        $(".AddForm").show();
        $(".UpdateForm")[0].reset();
        $(".AddForm")[0].reset();
        $(".addUpdateModal").removeClass("error");
        var errorMessage = $('label.error');
        errorMessage.hide();
        var errorMessage = $('.inputfield.error');
        errorMessage.removeClass('error');
        var form = $('.AddForm');
        form.validate().resetForm();
        form.find('.error').removeClass('error');
        var Uform = $('.UpdateForm');
        Uform.validate().resetForm();
        Uform.find('.error').removeClass('error');
    });

    
</script>