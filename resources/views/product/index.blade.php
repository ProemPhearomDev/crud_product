<x-layout>
    <main>
        
        <div class="container-fluid px-4">
          
            
            <h2 class="mt-4">Product Table</h2>
            <button class="btn btn-success rounded-3 shadow m-3" type="button" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop" data-bs-whatever="@mdo">
                Add New Product
            </button>

            <div class="card mb-4">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($products as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($row->photo)
                                            <img src="{{ url('uploads/product/' . $row->photo) }}" alt=""
                                                style="height: 50px" class="rounded-3" />
                                        @else
                                            <img src="{{ url('img/no_image.png') }}" alt="" style="height: 50px;"
                                                class="rounded-3">
                                        @endif
                                    </td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->cate_id }}</td>
                                    <td>$ {{ $row->price }}</td>
                                    <td>{{ $row->qty }} pcs</td>
                                    <td>
                                        <!-- Add -->
                                        {{-- <a href="{{ route('pro.add', $row->id) }}"
                                            class="btn btn-primary rounded-3 shadow"><i class="fa fa-plus"></i> Add</a> --}}
                                        <!-- Edit -->
                                        <a href="#" class="btn btn-success rounded-3 shadow text-white"
                                            data-bs-toggle="modal" data-bs-target="#modal_show_product{{  $row->id }}"
                                            data-bs-whatever="@mdo">
                                            <i class="fa fa-eye"></i> Show</a>
                                        <a href="#" class="btn btn-warning rounded-3 shadow text-white"
                                            data-bs-toggle="modal" data-bs-target="#modal_edit_product{{  $row->id }}"
                                            data-bs-whatever="@mdo">
                                            <i class="fa fa-pen"></i> Edit</a>
                                        <!-- Delete -->
                                        <button class="btn btn-danger rounded-3 shadow" type="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#staticBackdropDel{{ $row->id }}"
                                            data-bs-whatever="@mdo">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>

                                    </td>
                                </tr>


                                <!-- Add Product modal -->
                                <div class="modal fade" id="staticBackdrop" tabindex="-1"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true"
                                    data-bs-target="#staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Add New Product
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('products.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Product
                                                            Name:</label>
                                                        <input type="text" class="form-control" id="recipient-name"
                                                            name="name" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name"
                                                            class="col-form-label">Price:</label>
                                                        <input type="text" class="form-control" id="recipient-name"
                                                            name="price" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name"
                                                            class="col-form-label">Category:</label>
                                                        <select name="cate_id" id="" class="form-select">
                                                            @foreach ($cate as $c)
                                                                <option value="{{ $c->id }}">
                                                                    {{ $c->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name"
                                                            class="col-form-label">Photo:</label>
                                                        <input type="file" class="form-control" id="recipient-name"
                                                            name="photo" />
                                                    </div>
                                                    <input type="submit" name="submit" id=""
                                                        class="btn btn-success" />
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End add Product modal-->
                                <!-- edit Product modal -->
                                <div class="modal fade" id="modal_edit_product{{  $row->id }}" tabindex="-1"
                                    aria-labelledby="modal_show_productLabel" aria-hidden="true"
                                    data-bs-target="#staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                  Edit  Product 
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('products.update', $row->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Product
                                                            Name:</label>
                                                        <input type="text" class="form-control"
                                                            id="recipient-name" name="name"
                                                            value="{{ $row->name }}" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name"
                                                            class="col-form-label">Price:</label>
                                                        <input type="text" class="form-control"
                                                            id="recipient-name" name="price"
                                                            value="{{ $row->price }}" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name"
                                                            class="col-form-label">Category:</label>
                                                        <select name="cate_id" id="" class="form-select">
                                                            @foreach ($cate as $c)
                                                                <option value="{{ $c->id }}"  
                                                                    {{-- @if ($row->cate_id == $c->id)
                                                                    {{'selected="selected"'}}
                                                                    @endif  --}}
                                                                    > 
                                                                     {{ $row->cate_id }}
                                                                     {{-- {{ $c->name }} --}}
                                                                     
                                                                </option>
                                                            @endforeach
                            
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name"
                                                            class="col-form-label">Photo:</label>
                                                        <input type="file" class="form-control"
                                                            id="recipient-name" name="photo" />
                                                    </div>
                                                    <div class="mb-3 mx-auto">
                                                        @if ($row->photo)
                                                        <img src="{{ url('uploads/product/' . $row->photo) }}" alt=""
                                                            style="height: 50px" class="rounded-3" />
                                                        @else
                                                        <img src="{{ url('img/no_image.png') }}" alt="" style="height: 50px;"
                                                            class="rounded-3">
                                                        @endif
                                                    </div>
                                                    <input type="submit" name="submit" id=""
                                                        class="btn btn-success" />
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End add Product modal-->
                                <!-- show Product modal -->
                                <div class="modal fade" id="modal_show_product{{  $row->id }}" tabindex="-1"
                                    aria-labelledby="modal_edit_productLabel" aria-hidden="true"
                                    data-bs-target="#staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Product Detail
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Product
                                                            ID : <b>{{ $row->code }}</b></label>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Product
                                                            Name: <b>{{ $row->name }}</b></label>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">
                                                            Category: <b>{{ $row->cate_id }}</b></label>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name"
                                                            class="col-form-label">Price: <b>{{ $row->price }}</b></label>
                                                    </div>
                                                    <div class="mb-3 mx-auto">
                                                        @if ($row->photo)
                                                        <img src="{{ url('uploads/product/' . $row->photo) }}" alt=""
                                                            style="height: 50px" class="rounded-3" />
                                                        @else
                                                        <img src="{{ url('img/no_image.png') }}" alt="" style="height: 80px;"
                                                            class="rounded-3">
                                                        @endif
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End add Product modal-->

                                <!-- Soft Delete -->
                                <div class="modal fade" id="staticBackdropDel{{ $row->id }}" tabindex="-1"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true"
                                    data-bs-target="#staticBackdropDel" data-bs-backdrop="static"
                                    data-bs-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title fs-5" id="exampleModalLabel">
                                                    Are you sure you want to
                                                    delete this <strong>{{ $row->name }}</strong> from record?
                                                </p>
                                                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button> --}}
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('products.destroy', $row->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')

                                                    <div class="justify-content-center text-center">
                                                        <button type="submit" class="btn btn-success"
                                                            data-bs-dismiss="modal">
                                                            Yes
                                                        </button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
</x-layout>
