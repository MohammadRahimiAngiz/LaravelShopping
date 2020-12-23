@foreach ( $categories as $category)
    <div class="media" style="margin-left:{{$loop->depth*15}}px; ">
        <div class="media-icon"><i class="fas fa-angle-double-right"></i></div>
        <div class="media-body">
            <div class="media-right">
                <div class="btn-group  btn-group-sm">
                    @can('delete-category')
                        <form action="{{route('admin.categories.destroy',['category'=>$category->id])}}"
                              method="POST" class="d-inline"
                              id="category-{{$category->id}}-delete">
                            @csrf
                            @method('DELETE')
                            {{--                            <button type="submit" class="btn btn-primary btn-sm ">Delete</button>--}}
                        </form>
                    @endcan
                    <a href="#" class="btn btn-primary btn-sm pt-1"
                       onclick="event.preventDefault();document.getElementById('category-{{$category->id}}-delete').submit();">Delete</a>
                    <a href="{{route('admin.categories.edit',['category'=>$category->id])}}"
                       class="btn btn-primary btn-sm pt-1">Edit</a>
                    <a href="{{route('admin.categories.create',['parent'=>$category->id])}}"
                       class="btn btn-primary  btn-sm pt-1">Sub</a>
                </div>
            </div>
            <div class="media-title"><h6>{{$category->name}}</h6></div>
            <div class="text-small text-muted">
                <div
                    class="bullet"></div> {{\Carbon\Carbon::parse($category->created_at)->diffForHumans(['options' => 0])}}
            </div>
        </div>
    </div>
    @include('Admin.Categories.categoryPartial',['categories' => $category->child])
@endforeach
