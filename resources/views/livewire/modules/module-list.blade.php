<div>
    {{-- Be like water. --}}
    <div class="container-fluid  ">
        <br>

        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="text-green font-weight-bold mb-2">
                    Module
                </h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Index</li>
                </ol>
            </div>
        </div>


    </div>

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p class="lead"> {!! session()->get('message') !!}</p>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p class="lead"> {!! session()->get('error') !!}</p>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="row mb-2 ">

            <div class="col-md-12 col-sm-12">

                <div class="card mt-lg-4">
                    <div class="card-header">
                        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                data-target="#createTeamModal">Create Module</button>

                    </div>
                    <div class="card-body">

                        <table class="table table-bordered mt-5">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>




                            </tr>
                            @foreach ($modules as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{$item->module_name}}</td>

                                    <td>
                                        <a type="button" class="btn btn-sm btn-outline-primary"

                                                href="{{route('module.show', $item->id)}}">View</a>

{{--                                        <button type="button" class="btn btn-sm btn-outline-danger"--}}
{{--                                                wire:click="delete({{ $item->id }})">Delete</button>--}}
                                    </td>


                                </tr>
                            @endforeach

                        </table>

                        <!-- Pagination -->
                        {{--                            {{ $taxes->links() }}--}}


                    </div>
                </div>
            </div>
        </div>


    </div>

    <div wire:ignore.self class="modal fade" id="createTeamModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Module</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form wire:submit.prevent="create">
                            <div class="form-group">
                                <label for="unit_from">Module</label>
                                <input required type="text" class="form-control" id="invoice_type"
                                       wire:model.lazy="module_name">

                            </div>



                            <button type="submit" class="btn btn-sm btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="editTeamModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Invoice Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form wire:submit.prevent="update">
                            <div class="form-group">
                                <label for="unit_from">Module</label>
                                <input required type="text" class="form-control" id="invoice_type"
                                       wire:model.lazy="module_name">
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
