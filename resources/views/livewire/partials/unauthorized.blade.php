{{-- Unauthorized fallback — included via @else inside @can --}}
<div class="content-wrapper" style="min-height: 100vh;">
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center" style="padding-top: 10vh;">
                <div class="col-md-6 text-center">
                    <div class="card card-outline card-danger">
                        <div class="card-body py-5">
                            <i class="fas fa-shield-alt fa-4x text-danger mb-3"></i>
                            <h3 class="text-danger font-weight-bold">Access Denied</h3>
                            <p class="text-muted mt-3">
                                You do not have the required permission to access this page.
                                Please contact your village bank administrator if you believe this is an error.
                            </p>
                            <a href="{{ route('home') }}" class="btn btn-outline-primary mt-3">
                                <i class="fas fa-arrow-left mr-1"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
