<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="container-fluid  ">
        <br>

        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Banks</li>
                </ol>
            </div>
        </div>

        <div class="card card-body ">
            <div class="row-cols-l6-12 row-cols-sm-12   ">
                BANKS
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
                        <a class="btn btn-sm btn-outline-primary"
                           data-toggle="modal" data-target="#createBankModal">Add</a>
                    </div>
                    <div class="card-body">

                        <div>
                            <table class="table table-bordered mt-5">
                                <tr>
                                    <th>No</th>
                                    <th>ACCOUNT NAME</th>
                                    <th>ACCOUNT NUMBER</th>
                                    <th>BRANCH</th>
                                    <th>CURRENCY</th>
                                    <th>BANK NAME</th>
                                    <th>SWIFT ADDRESS</th>
                                    <th></th>
                                </tr>
                                <tbody>
                                @forelse($banks as $item)
                                    <tr>
                                        <td>{{$item->id ?? ""}}</td>
                                        <td>{{$item->account_name ?? ""}}</td>
                                        <td>{{$item->account_no ?? ""}}</td>
                                        <td>{{$item->branch ?? ""}}</td>
                                        <td>{{$item->currency ?? ""}}</td>
                                        <td>{{$item->bank_name ?? ""}}</td>
                                        <td>{{$item->swift_address ?? ""}}</td>
                                        <td></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4" style="color: #94a3b8;">
                                            <i class="fas fa-clipboard-list fa-2x d-block mb-2" style="opacity: 0.3;"></i>

                                                No banks found.

                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            {{$banks->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="createBankModal" tabindex="-1" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="fas fa-plus mr-1"></i> Create Bank</h5>
                        <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <form wire:submit.prevent="createBank">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Account Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('account_name') is-invalid @enderror" wire:model.defer="account_name" placeholder="Account name..">
                                @error('account_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="description">Account Number</label>
                                <input class="form-control @error('account_no') is-invalid @enderror" wire:model.defer="account_no" placeholder="Account number..">
                                @error('account_no') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="description">Branch</label>
                                <input class="form-control @error('branch') is-invalid @enderror" wire:model.defer="branch" placeholder="Branch name..">
                                @error('branch') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-0">
                                <label for="description">Currency</label>
                                <input class="form-control @error('currency') is-invalid @enderror" wire:model.defer="currency" placeholder="Branch name..">
                                @error('currency') <span class="invalid-feedback">{{ $message }}</span> @enderror
{{--                                <select class="form-control @error('currency') is-invalid @enderror" wire:model.defer="currency" placeholder="Currency">--}}
{{--                                    <option value="">--choose--</option>--}}
{{--                                    <option value="">--choose--</option>--}}

{{--                                </select>--}}
{{--                                @error('currency') <span class="invalid-feedback">{{ $message }}</span> @enderror--}}
                            </div>

                            <div class="form-group mb-0">
                                <label for="description">Bank Name</label>
                                <input class="form-control @error('bank_name') is-invalid @enderror" wire:model.defer="bank_name" placeholder="Bank name..">
                                @error('bank_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-0">
                                <label for="description">Swift Address</label>
                                <input class="form-control @error('swift_address') is-invalid @enderror" wire:model.defer="swift_address" placeholder="Swift code..">
                                @error('swift_address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save mr-1"></i> Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
