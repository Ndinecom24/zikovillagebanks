{{--<form id="form" action="{{route('penalties.store')}}"--}}
{{--      enctype="multipart/form-data"--}}
{{--      method="POST"--}}
{{--      data-parsley-validate="">--}}
{{--    @csrf--}}

<div class="modal fade show" id="modal-delete" style=" padding-right: 15px;" aria-modal="true"
     role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4>DEACTIVATE USER</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
{{--            <form wire:submit.prevent="updatePowerTradingConfigs">--}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ag_consent_received_date">Excess Charge Factor</label>
                                <input type="number"
                                       class="form-control"
                                       id="excess_factor"
                                       name="excess_factor"
                                       step="any">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ag_sent_to_ag_date">Set Power Factor Limit</label>
                                <input type="number"
                                       class="form-control"
                                       id="power_factor_limit"
                                       step="any"
                                >
                            </div>
                        </div>
                    </div>


{{--                    <div class="row">--}}
{{--                        <div class="col-md-4">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="ag_sent_to_ag_date">Set Power Factor Limit</label>--}}
{{--                                <input type="number" wire:model.defer="power_factor_limit"--}}
{{--                                       class="form-control"--}}
{{--                                       id="power_factor_limit"--}}
{{--                                       step="any"--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="ag_sent_to_ag_date">Declared (Actual Demand)</label>--}}
{{--                                <input type="number" wire:model.defer="actual_demand"--}}
{{--                                       class="form-control"--}}
{{--                                       name="actual_demand"--}}
{{--                                       step="any" >--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}



                    <hr>
                    <div class="row">
                        <div class="col-12">
                            @if(session()->has('message'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <p class="lead"> {!! session()->get('message') !!}</p>
                                </div>
                            @endif
                            @if(session()->has('error'))
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <p class="lead"> {!!  session()->get('error') !!}</p>
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


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <div wire:loading wire:target="updatePowerTradingConfigs">
                        <div class="spinner-border text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>

</div>


