@component('Admin.layouts.content',['title'=>"Category:  $category->name "])
    @slot('css')
    @endslot
    @slot('script')
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.categories.index')}}">Categories</a></div>
            <div class="breadcrumb-item">Edit Category</div>
        </div>
    @endslot
    <div class="col-12 col-lg-6 col-md-6 p-0">
        <div class="card">
            <form action="{{route('admin.categories.update',[$category->id])}}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="parent" value="{{$category->parent}}">
                <div class="card-body">
                    <div class="form-group">
                        <label>Category Name  <span class="text-muted ">(Main Category)</span></label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name')is-invalid @enderror"
                               value="{{ $category->name }}" required autocomplete="name" autofocus>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary"><i class="fas fa-copyright mr-1"></i>Save Edit Category</button>
                    <a href="{{route('admin.categories.index')}}" class="btn btn-secondary"><i class="fas fa-undo mr-1"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endcomponent
