<!-- /.POP UP MODEL TO FORCE USER TO CHANGE PASSWORD -->
<div class="modal fade" id="modal-change-password">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Change Password</h4>
            </div>
            <!-- form start -->
            <form method="POST" action="{{ route('user.change.password') }}">
                @csrf
                <div class="p-4">
                    <div class="row justify-content-center ">
                        <img src="{{asset('dashboard/dist/img/img.png')}}" width="50%">
                    </div>

                    <div class="form-group row">
                        <label for="old_password"
                               class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>
                        <div class="col-md-6">
                            <input id="old_password" type="password"
                                   class="form-control @error('old_password') is-invalid @enderror" name="old_password"
                                   value="{{ old('old_password') }}" required autocomplete="current-password" autofocus>
                            @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password"
                               class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   value="{{ old('password') }}" required autocomplete="current-password" autofocus>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm"
                               class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password"
                                   class="form-control @error('confirm_password') is-invalid @enderror" name="password_confirmation"
                                   required autocomplete="new-password">
                            @error('confirm_password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Change Password') }}
                            </button>


                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.end modal -->
