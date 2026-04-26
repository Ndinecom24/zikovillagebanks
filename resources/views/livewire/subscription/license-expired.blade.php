<div class="auth-wrapper">
    <div class="auth-card" style="max-width:550px;">
        <div class="text-center mb-4">
            <div style="width:80px;height:80px;border-radius:50%;background:#fef2f2;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                <i class="fas fa-exclamation-triangle" style="font-size:2rem;color:#dc3545;"></i>
            </div>
            <h3 class="fw-bold">License Expired</h3>
            <p class="text-muted">Your village bank's license has expired or been revoked. To continue using the platform, please renew your subscription.</p>
        </div>

        @if($successMessage)
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-1"></i> {{ $successMessage }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
            </div>
        @endif

        <div class="d-grid gap-2">
            <button wire:click="openRenewal" class="btn btn-zesco-green btn-lg">
                <i class="fas fa-redo me-2"></i>Renew Subscription
            </button>
            <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Login
            </a>
        </div>

        {{-- Renewal Modal --}}
        @if($showRenewalModal)
            <div class="z-modal" style="display:flex;position:fixed;inset:0;z-index:200;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;">
                <div class="modal-dialog" style="max-width:480px;width:100%;">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header modal-header-zesco">
                            <h5 class="modal-title text-white">
                                <i class="fas fa-redo me-2"></i>Renew Subscription
                            </h5>
                            <button type="button" class="btn-close btn-close-white" wire:click="$set('showRenewalModal', false)"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="submitRenewal">
                                <div class="mb-3">
                                    <label class="z-label">Payment Reference <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="paymentReference" class="z-input form-control"
                                        placeholder="Transaction ID / Receipt No.">
                                    @error('paymentReference') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="z-label">Proof of Payment <span class="text-danger">*</span></label>
                                    <input type="file" wire:model="proofFile" class="form-control"
                                        accept=".jpg,.jpeg,.png,.pdf">
                                    @error('proofFile') <small class="text-danger">{{ $message }}</small> @enderror
                                    <small class="text-muted">JPG, PNG or PDF — max 10 MB</small>
                                </div>
                                <div wire:loading wire:target="proofFile" class="text-success mb-2">
                                    <i class="fas fa-spinner fa-spin"></i> Uploading...
                                </div>
                                <button type="submit" class="btn btn-zesco-green w-100" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="submitRenewal">
                                        <i class="fas fa-paper-plane me-1"></i>Submit Renewal Payment
                                    </span>
                                    <span wire:loading wire:target="submitRenewal">
                                        <i class="fas fa-spinner fa-spin me-1"></i>Submitting...
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
