@extends('admin.layout.master')

@section('css')
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
    <script src="template-admin/admin/js/js-datatables/datatables/jquery.dataTables.min.js"></script>
    <script src="template-admin/admin/js/animation/tilt/tilt.jquery.js"></script>
    <script src="template-admin/admin/js/animation/tilt/tilt-custom.js"></script>

    @yield('script')
@endsection
