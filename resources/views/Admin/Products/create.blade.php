@component('Admin.layouts.content',['title'=>'New Product'])
    @slot('css')
                <link rel="stylesheet" href="/css/admin/css/select2.min.css">
    @endslot
    @slot('script')
                <script src="/js/admin/select2.full.min.js"></script>
                <script>
                    $('#categories').select2({
                        'placeholder' : 'دسترسی مورد نظر را انتخاب کنید'
                    })


                    let changeAttributeValues = (event , id) => {
                        let valueBox = $(`select[name='attributes[${id}][value]']`);

                        $.ajaxSetup({
                            headers : {
                                'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
                                'Content-Type' : 'application/json'
                            }
                        })

                        $.ajax({
                            type : 'POST',
                            url : '/admin/attribute/values',
                            data : JSON.stringify({
                                name : event.target.value
                            }),
                            success : function(data) {
                                valueBox.html(`
                            <option selected>Select</option>
                            ${
                                    data.data.map(function (item) {
                                        return `<option value="${item}">${item}</option>`
                                    })
                                }
                        `);

                                $('.attribute-select').select2({ tags : true });
                            }
                        });
                    }

                    let createNewAttr = ({ attributes , id }) => {
                        return `
                    <div class="row" id="attribute-${id}">
                        <div class="col-5">
                            <div class="form-group">
                                 <label> Name Attribute</label>
                                 <select name="attributes[${id}][name]" onchange="changeAttributeValues(event, ${id});" class="attribute-select form-control">
                                    <option value="">Select</option>
                                    ${
                            attributes.map(function(item) {
                                return `<option value="${item}">${item}</option>`
                            })
                        }
                                 </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                 <label>Value Attribute</label>
                                 <select name="attributes[${id}][value]" class="attribute-select form-control">
                                        <option value=""> Select</option>
                                 </select>
                            </div>
                        </div>
                         <div class="col-2">
                            <label >Actions</label>
                            <div>
                                <button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('attribute-${id}').remove()">Delete</button>
                            </div>
                        </div>
                    </div>
                `
                    }

                    $('#add_product_attribute').click(function() {
                        let attributesSection = $('#attribute_section');
                        let id = attributesSection.children().length;

                        attributesSection.append(
                            createNewAttr({
                                attributes : [],
                                id
                            })
                        );

                        $('.attribute-select').select2({ tags : true });
                    });
                </script>
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.products.index')}}">Products</a></div>
            <div class="breadcrumb-item">New Product</div>
        </div>
    @endslot
    <div class="col-12 col-lg-6 col-md-6 p-0">
        <div class="card">
            <form action="{{route('admin.products.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="title" id="title"
                               class="form-control @error('title')is-invalid @enderror"
                               value="{{ old('title') }}" required autocomplete="title" autofocus>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label>Description</label>
                        <textarea
                            class="form-control @error('description')is-invalid @enderror"
                            rows="3"
                            name="description"
                            id="description"
                            required autocomplete="description" >{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-dollar-sign" ></i>
                                </div>
                            </div>
                            <input name="price" id="price" type="number" value="{{old('price')}}"
                                   class="form-control currency @error('price')is-invalid @enderror">
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-hand-spock" ></i>
                                </div>
                            </div>
                            <input name="stock" id="stock" type="number" value="{{old('stock')}}"
                                   class="form-control @error('stock')is-invalid @enderror">
                            @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Select Categories</label>
                        <select class="form-control select2" multiple="" required name="categories[]">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <h6>Attributes Product</h6>
                    <hr>
                    <div id="attribute_section"></div>
                    <button class="btn btn-sm btn-danger" type="button" id="add_product_attribute">New Attribute</button>
                </div>

                <div class="card-footer text-right">
                    <button class="btn btn-primary">
                        <i class="fas fa-tractor mr-1"></i>
                        Save New product
                    </button>
                    <a href="{{route('admin.products.index')}}" class="btn btn-secondary">
                        <i class="fas fa-undo mr-1"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endcomponent
