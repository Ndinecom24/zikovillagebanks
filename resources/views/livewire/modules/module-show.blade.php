<div>
    {{-- Do your work, then step back. --}}

    <div class="container-fluid">
        <div class="card card-body ">

            <div class="row-cols-l6-12 row-cols-sm-12">
                DETAILS
                <a class="text-uppercase"
                   href="">

                </a>
                <a class="btn btn-outline-success float-right" href="{{route('module.index')}}">
                    <i class="fa fa-backward"></i> Back
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        @if(session()->has('message'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{session()->get('message')}}</p>
                    </div>
                </div>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{session()->get('error')}}</p>
                    </div>
                </div>
            </div>
        @endif
        @if(session()->has('info'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{ $info }}</p>
                    </div>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">
                        <strong></strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif


        <div class="row">
            <div class="col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <b> Module :</b> {{$module_details->module_name}}<br>
                                            <b> Staff No :</b> {{$module_details->created_by_staff_no}}<br>
                                            <b> Created by :</b> {{$module_details->created_by}}<br>
                                            <b> Created On : </b> {{$module_details->created_at}} <br>
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                            {{--                                    <div class="col-md-6 text-center">--}}
                            {{--                                      --}}
                            {{--                                    </div>--}}
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                {{--                                        @can(config('chilolezo.permissions.users-destroy'))--}}
                                {{--                                            @if( auth()->user()->id != $user->id)--}}
                                <a class="btn btn-outline-danger align-self-end"
                                   data-toggle="modal"
                                   data-sent_data=""
                                   data-target="#modal-delete">Delete</a>
                                {{--                                            @endif--}}
                                {{--                                        @endcan--}}
                                {{--                                        @can(config('chilolezo.permissions.users-edit'))--}}
                                <a class="btn btn-outline-warning align-self-end"
                                   wire:click="editModule({{$module_details->id}})"
                                   data-toggle="modal" data-target="#editModuleModal">Edit</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-8">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Attach Task</h4>
                        </div>

                        <div class="card-header-toolbar ms-auto">
                            <a class="btn btn-sm btn-outline-success"
                               data-toggle="modal"
                               data-target="#attach-task">
                                Add Task
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Task Description</th>
                                <th>Responsible Office</th>

                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($tasks as $task)
                                <tr>
                                    <td>{{$task->id}}</td>
                                    <td>{{$task->task_name ?? '-'}}</td>
                                    <td>{{$task->task_description ?? '-'}}</td>
                                    <td>{{$task->office->responsible_office ?? '-'}}</td>

                                    <td>{{$task->created_by ?? '-'}}</td>


                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-toggle="modal" data-target="#editTaskModal"
                                                wire:click="editTask({{ $task->id }})">Edit
                                        </button>

                                        <a title="remove this role user"
                                           class="btn btn-outline-danger m-1"
                                           data-toggle="modal">
                                            <i class="fa fa-trash"></i>
                                        </a>

                    </td>
                    </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">
                                No Tasks available.
                            </td>
                        </tr>
                        @endforelse
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div wire:ignore.self class="modal fade" id="editTaskModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <form wire:submit.prevent="updateTask">
                        <div class="form-group">
                            <label for="unit_from">Name</label>
                            <input required type="text" class="form-control" id="invoice_type"
                                   wire:model.lazy="task_name">
                        </div>

                        <div class="form-group">
                            <label for="unit_from">Responsible Office</label>
                            <select required type="text" class="form-control" id="invoice_type"
                                    wire:model.lazy="office_id">
                                <option value="">--select--</option>
                                @foreach ($offices as $item)
                                    <option value="{{ $item->id }}">{{ $item->responsible_office }} </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="unit_from">Task Description</label>
                            <textarea required type="text" class="form-control" col="4" id="invoice_type"
                                      wire:model.lazy="task_description"> </textarea>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div wire:ignore.self class="modal fade" id="attach-task" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <form wire:submit.prevent="createTask">
                        <div class="form-group">
                            <label for="unit_from">Name</label>
                            <input required type="text" class="form-control" id="invoice_type"
                                   wire:model.lazy="task_name">
                        </div>

                        <div class="form-group">
                            <label for="unit_from">Responsible Office</label>
                            <select required type="text" class="form-control" id="invoice_type"
                                    wire:model.lazy="office_id">
                                <option>--Select--</option>
                                @foreach ($offices as $item)
                                    <option value="{{ $item->id }}">{{ $item->responsible_office }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="unit_from">Task Description</label>
                            <textarea required type="text" class="form-control" col="4" id="invoice_type"
                                      wire:model.lazy="task_description"> </textarea>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div wire:ignore.self class="modal fade" id="editModuleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <form wire:submit.prevent="updateModule">
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
