<!-- latest jquery-->
<script src="{{asset('assets/backoffice/js/jquery.min.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/backoffice/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('assets/backoffice/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/backoffice/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- scrollbar js-->
<script src="{{asset('assets/backoffice/js/scrollbar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/backoffice/js/scrollbar/custom.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset('assets/backoffice/js/config.js')}}"></script>
<!-- Plugins JS start-->
<script src="{{asset('assets/backoffice/js/sidebar-menu.js')}}"></script>
<script src="{{asset('assets/backoffice/js/sidebar-pin.js')}}"></script>
{{-- <script src="{{asset('assets/backoffice/js/clock.js')}}"></script> --}}
<script src="{{asset('assets/backoffice/js/slick/slick.min.js')}}"></script>
<script src="{{asset('assets/backoffice/js/slick/slick.js')}}"></script>
<script src="{{asset('assets/backoffice/js/header-slick.js')}}"></script>

<script src="{{asset('assets/backoffice/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('assets/backoffice/js/notify/bootstrap-notify.min.js')}}"></script>
{{-- <script src="{{asset('assets/backoffice/js/notify/index.js')}}"></script> --}}

<!-- Date Picker-->
<script src="{{asset('assets/backoffice/js/flat-pickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/backoffice/js/flat-pickr/custom-flatpickr.js')}}"></script>

 <!-- Sweet Alerts js -->
 <script src="{{asset('assets/backoffice/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Theme js-->
<script src="{{asset('assets/backoffice/js/script.js')}}"></script>
<script src="{{asset('assets/backoffice/js/script1.js')}}"></script>
<script>
    const asset_url = "{{ asset('assets/backoffice') }}";
</script>

<script type="text/javascript">
    $.fn.money_format = function(amount){
        const amountFormat = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(amount);

        return amountFormat;
    };
</script>

 <script type="text/javascript">

    $(".toggle-password").click(function() {
    $(this).toggleClass("fa-solid fa-eye fa-solid fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
    });

    // my profile clickble dropdown
    $(document).on('click', '.dropdown-click', function (e) {
        e.stopPropagation();
        $(this).toggleClass('show-dropdown');
    });

    $(document).on('click', function () {
        $('.dropdown-click').removeClass('show-dropdown');
    });

</script>
