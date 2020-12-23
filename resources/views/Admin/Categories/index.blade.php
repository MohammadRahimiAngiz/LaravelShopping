@component('Admin.layouts.content',['title' => 'List Categories'])
    @slot('css')
    @endslot
    @slot('script')
        <script src="/js/admin/jquery-ui.min.js"></script>
        <script src="/js/admin/components-table.js"></script>
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item">Categories</div>
        </div>
    @endslot
    <p class="section-lead">This page is just list Categories.</p>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Categories
                        @if (request('search'))
                            <small class="section-lead ml-0 text-muted">: Search Result For: *{{request('search')}}* =
                                <strong>{{$categories->total()}}</strong></small>
                        @endif
                    </h4>
                    <div class="card-header-form">
                        <x-search></x-search>
                    </div>
                    @can('create-category')
                        <div class="card-header-form">
                            <a href="{{route('admin.categories.create')}}" class="btn btn-primary ml-2"><i
                                    class="fas fa-copyright mr-1"></i>New Category</a>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="list-unstyled list-unstyled-border mt-4">
                        @foreach ($categories as $category)
                            <div class="media">
                                <div class="media-icon"><i class="fas fa-copyright"></i></div>
                                <div class="media-body">
                                    <div class="media-right ">
                                        <div class="btn-group  btn-group-sm ">
                                            @can('delete-category')
                                                <form
                                                    action="{{route('admin.categories.destroy',['category'=>$category->id])}}"
                                                    method="POST"
                                                    class="d-inline"
                                                    id="category-{{$category->id}}-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-primary btn-sm pt-1"
                                                   onclick="event.preventDefault();document.getElementById('category-{{$category->id}}-delete').submit();">Delete</a>
                                            @endcan
                                            @can('edit-category')
                                                <a href="{{route('admin.categories.edit',['category'=>$category->id])}}"
                                                   class="btn btn-primary btn-sm pt-1">Edit</a>
                                            @endcan
                                            @can('create-category')
                                                <a href="{{route('admin.categories.create',['parent'=>$category->id])}}"
                                                   class="btn btn-primary btn-sm pt-1">Sub</a>
                                            @endcan

                                        </div>
                                    </div>
                                    <div class="media-title"><h6>{{$category->name}}</h6></div>
                                    <div class="text-small text-muted">
                                        <div class="bullet"></div>
                                        {{\Carbon\Carbon::parse($category->created_at)->diffForHumans(['options' => 0])}}
                                    </div>
                                </div>
                            </div>
                            @include('Admin.Categories.categoryPartial',['categories' => $category->child])
                            <hr/>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-center">
                    {{ $categories->appends(['search'=>request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endcomponent
