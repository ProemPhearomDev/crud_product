<x-layout>
    <main>
        
        <div class="container-fluid px-4">
          
            
            <h2 class="mt-4">Categories Table</h2>
            <button class="btn btn-success rounded-3 shadow m-3" type="button" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop" data-bs-whatever="@mdo">
                Add New Categ
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
                                <th>Name</th>
                                <th>code</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                  
                                    <td>{{ $row->name }}</td>
                                    <td>
      
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
                                                <form action="{{ route('categories.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Product
                                                            Name:</label>
                                                        <input type="text" class="form-control" id="recipient-name"
                                                            name="name" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Product
                                                            Code:</label>
                                                        <input type="text" class="form-control" id="recipient-name"
                                                            name="code" />
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
                                                <form action="{{ route('categories.update', $row->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Product
                                                            Category:</label>
                                                        <input type="text" class="form-control" id="recipient-name"
                                                            name="name" value="{{ $row->name }}" />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Product
                                                            Code:</label>
                                                        <input type="text" class="form-control" id="recipient-name"  value="{{ $row->code }}"
                                                            name="code" />
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
                                                    Categ Detail
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">
                                                        Name: {{ $row->name }}</label>
                                                    
                                                </div>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Product
                                                        Code: {{ $row->code }}</label>
                                                    
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
                                                <form action="{{ route('categories.destroy', $row->id) }}"
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
