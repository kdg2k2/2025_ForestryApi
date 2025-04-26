@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" href="asset/js/datatables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="asset/js/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="asset/js/datatables/use-datatable.css">

    <link rel="stylesheet" href="asset/js/sumoselect/sumoselect.css">

    @yield('style')
@endsection

@section('main')
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('admin.partials.header')
        <div class="page-body-wrapper">
            @include('admin.partials.sidebar')
            @yield('content')
            @include('admin.partials.footer')
        </div>
    </div>
@endsection

@section('modal')
    @include('admin.partials.modals')
@endsection

@section('js')
    <script src="template-admin/admin/js/sidebar.js"></script>
    <script src="template-admin/admin/js/height-equal.js"></script>
    <script src="template-admin/admin/js/config.js"></script>
    <script src="template-admin/admin/js/scrollbar/simplebar.js"></script>
    <script src="template-admin/admin/js/scrollbar/custom.js"></script>
    <script src="template-admin/admin/js/slick/slick.min.js"></script>
    <script src="template-admin/admin/js/slick/slick.js"></script>
    <script src="template-admin/admin/js/animation/tilt/tilt.jquery.js"></script>
    <script src="template-admin/admin/js/animation/tilt/tilt-custom.js"></script>

    <script src="asset/js/datatables/js/jquery.dataTables.min.js"></script>
    <script src="asset/js/datatables/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="asset/js/datatables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="asset/js/datatables/use-datatable.js"></script>

    <script src="asset/js/sumoselect/jquery.sumoselect.js"></script>
    <script src="asset/js/sumoselect/use-sumoselect.js"></script>

    <script src="asset/js/tool-tips.js"></script>
    <script src="asset/js/auto-add-required-mark.js"></script>
    <script src="asset/js/fill-select.js"></script>
    <script src="asset/js/format-number.js"></script>
    <script src="asset/js/format-datetime.js"></script>

    <script>
        refreshSumoSelect();
        showRequiredMark();
    </script>
    <script src="\template-admin\admin\js\cart.js"></script>
    @yield('script')
@endsection
