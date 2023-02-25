<!-- Essential javascripts for application to work-->
<script src="{{asset('assets/vali/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/vali/js/popper.min.js')}}"></script>
<script src="{{asset('assets/vali/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/vali/js/main.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{asset('assets/vali/js/plugins/pace.min.js')}}"></script>
<script src="{{asset('assets/vali/js/plugins/select2.min.js')}}"></script>
<!-- Page specific javascripts-->
<script>
    $(document).ready(function(){
             $('.select2bs4').select2();
            // image preview
            $(".image").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.image-preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            $(".image1").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.image-preview1').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            setInterval(function() {
               // $("#notifications_count").load(window.location.href + " #notifications_count");
                $("#unreadNotifications").load(window.location.href + " #unreadNotifications");
                $("#Notifications").load(window.location.href + " #Notifications");
            }, 5000);
               setTimeout(function() {
                $(".alert").alert('close');
            }, 300000);

       $("#phone").keypress(function (e) {
            if ($(this).val().length >= 10) {               
           e.preventDefault();                
            }
         //if the letter is not digit then display error and don't type anything
         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
          /*  $("#cust_issnError").html("Digits Only").show().fadeOut("slow");*/
                   return false;
        }
       });
        })
</script>
@yield('scripts')