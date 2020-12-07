@component('Admin.layouts.content',['title' => 'Dashboard'])
    @slot('css')
    @endslot
    @slot('script')
{{--        <script src="/js/admin/jquery-ui.min.js"></script>--}}
{{--        <script src="/js/admin/components-table.js"></script>--}}
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Dashboard</div>
        </div>
    @endslot
@endcomponent
