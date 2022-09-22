<!-- Styles -->
<link href="{{ asset('css/admin_app.css') }}" rel="stylesheet">

<!-- Fonts -->
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Bootstrap -->
<link href="{{ asset('resources/bootstrap-5.0.0-beta3-dist/css/bootstrap.css') }}" rel="stylesheet" type="text/css">

<!-- Custom fonts for this template-->
<link href="{{ asset('resources/template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('resources/font/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

<!-- Custom styles for this template-->
<link href="{{ asset('resources/template/css/sb-admin-2.min.css') }}" rel="stylesheet">

<!-- Custom styles for this page -->
<link href="{{ asset('resources/template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<!-- loading -->
<link href="{{ asset('resources/loading/css/main.css') }}" rel="stylesheet">

<!-- date picker -->
<link href="{{ asset('resources/datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

<!-- summernote css -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<!-- common css -->
<link href="{{ asset('css/admin/common.css') }}" rel="stylesheet">

{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
@stack('styles')
