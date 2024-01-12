@foreach($users as $item)
<!-- DELETE MODAL-->
    <div class="modal fade" id="modal-delete{{$item->id}}">
        <div class="modal-dialog modal-small">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Delete User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="post" action="{{route('user.delete',$item->id)}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h5>Are you sure you want to remove this user from this the system ?</h5>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">User Name</label>
                                    <input readonly type="text" class="form-control" id="delete_name" name="name"
                                           placeholder="Enter Status name" value="{{$item->name}}" required>
                                    <input hidden class="form-control" id="delete_id" name="id"
                                           placeholder="Enter Status name" required>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
{{--                        @can(config('chilolezo.permissions.users-destroy'))--}}
                            <button type="submit" class="btn btn-danger">Delete</button>
{{--                        @endcan--}}
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!-- /.DELETE modal -->
@endforeach
