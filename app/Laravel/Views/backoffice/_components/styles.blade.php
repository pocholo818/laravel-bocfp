<!-- Font Awesome-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/fontawesome.css')}}">
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/vendors/icofont.css')}}">
<!-- Themify icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/vendors/themify.css')}}">
<!-- Flag icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/vendors/flag-icon.css')}}">
<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/vendors/feather-icon.css')}}">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/vendors/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/vendors/slick-theme.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/vendors/scrollbar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/vendors/jquery.dataTables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/vendors/select.bootstrap5.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/vendors/flatpickr/flatpickr.min.css')}}">
<!-- Plugins css Ends-->
<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/vendors/bootstrap.css')}}">
<!-- App css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/style.css')}}">
<link id="color" rel="stylesheet" href="{{asset('assets/backoffice/css/color-1.css')}}" media="screen">
<!-- Responsive css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backoffice/css/responsive.css')}}">
<!-- sweet alert Css-->
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Put JQUERY and Bootstrap js file here-->
<style>

    input[type=password]::-ms-reveal,
    input[type=password]::-ms-clear
    {
        display: none;
    }
    .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .logo-wrapper, .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .logo-icon-wrapper {
        box-shadow: none;
    }
    @media (min-width: 768px) {
        .profile-list{
            width: 170% !important;
            margin-left: -50% !important;
        }
    }
    .lead-source-2 .ss{
        width: 500%;
        height: 500%;
    }
    .main-lead-source .lead-source-2 {
        width: 110px !important;
        height: 110px !important;
        border-radius: 50%;
        background-color: rgba(255, 184, 41, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 0;
        right: -35%;
        transform: translateY(8%);
        z-index: 1;
    }

    .profile-img{
        background-size: cover;
        background-position: center;
        height: 70px;
        width: 70px;
    }
    .text-right{ text-align: right;}
    .dropdown-menu .dropdown-item {
        opacity: 1;
        color: #6c757d;
    }

    .table-primary, th {
        --bs-table-bg: #5e3f00 !important;
        color: #fff !important;
    }

    .btn-primary {
        background-color: #0032A0 !important;
        border-color: #0032A0 !important;
    }
    .btn-outline-primary {
        border-color: #0032A0 !important;
        color: #0032A0;
    }
    .btn-outline-primary:hover {
        background-color: #0032A0 !important;
        border-color: #0032A0 !important;
    }
    .report-logo {
        height: 100px !important;
        width: auto !important;
    }
    .card-image {
        display: inline-block;
        margin: 10px;
        text-align: center;
    }
    .card-image img {
        display: block;
        width: 195px;
        height: auto;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    /* swal/sweetalert */
    .swal2-container .swal2-actions .swal2-confirm {
        background-color: #0032A0 !important;
    }

    /* BUSINESS PROFILE */
    .social-icon {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    .social-icon img {
        width: 24px;
        height: 24px;
        margin-right: 8px;
    }
    .payment-icon {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    .payment-icon img {
        width: 35px;
        height: 35px;
        margin-right: 8px;
    }

    .valign-bottom{ vertical-align: text-bottom}
    .valign-middle{ vertical-align: middle;}

    /* select2 */
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 10px !important;
        position: absolute !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 12px !important;
    }

    .select2-container--default .select2-selection--single {
        width: 100% !important;
        height: auto !important;
        display: flex !important;
        align-items: center;
        white-space: normal !important;
        word-break: break-word !important;
    }

    .select2-container .select2-selection--single .select2-selection__clear {
        font-size: 1rem;
        margin-left: 5px !important;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        white-space: normal !important;
        overflow: visible !important;
        text-overflow: unset !important;
        word-break: break-all !important;
    }
    .select2-container .select2-selection--single {
        padding: 12px 0 !important;
    }

    .bg-primary {
        background-color: #0032A0 !important;
        border-color: #0032A0 !important;
    }

    .show-bullets{
        margin-left: 25px;
        list-style-type: disc;
    }

    .wrap-text {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        text-overflow: ellipsis;
        border: none;
    }

    .dropdown-click{
        cursor: pointer;
    }

    .dropdown-click.show-dropdown .profile-dropdown {
        display: block !important;
        opacity: 1;
        visibility: visible;
        transform: translateY(0px);
    }

    .btn-secondary{
        background-color: #5e3f00!important;
        border-color: #5e3f00!important;
        color: white!important;
    }

    .btn-secondary:hover{
        background-color: #2EB62C!important;
        border-color: #2EB62C!important;
        color: white!important;
    }

    .badge, .bg-secondary{
        background-color: #5e3f00!important;
        border-color: #5e3f00!important;
        color: white!important;
    }

    .flatpickr-day.selected{
        background-color: #5e3f00!important;
        border-color: #5e3f00!important;
        color: white!important;
    }

    .flatpickr-day.selected:hover{
        background-color: #2EB62C!important;
        border-color: #2EB62C!important;
        color: white!important;
    }
</style>
