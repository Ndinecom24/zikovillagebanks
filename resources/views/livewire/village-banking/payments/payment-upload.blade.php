<div>
    @can('upload-payments')
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h1><i class="fas fa-upload mr-2" style="color: var(--z-gold)"></i>Upload Payment</h1>
                        <p>Record a payment transaction with proof of payment</p>
                    </div>
                    <a href="{{ route('payments.confirm') }}" class="btn btn-light" style="border-radius:8px;">
                        <i class="fas fa-clipboard-check mr-1"></i> View Confirmations
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @if ($successMessage)
                <div class="alert alert-success" style="border-radius:10px;font-size:0.9rem;">
                    <i class="fas fa-check-circle mr-1"></i> {{ $successMessage }}
                </div>
            @endif

            <div class="row">
                <div class="col-lg-7">
                    <div class="card z-card">
                        <div class="card-header">
                            <h3><i class="fas fa-credit-card mr-2" style="color:var(--z-green)"></i>Payment Details</h3>
                        </div>
                        <form wire:submit.prevent="submitPayment">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger" style="border-radius:8px;font-size:0.85rem;padding:0.5rem 0.75rem;">
                                        <i class="fas fa-exclamation-circle mr-1"></i> Please fix the errors below.
                                    </div>
                                @endif

                                {{-- Village Bank & Circle & Month --}}
                                <div class="row mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label class="z-label">Village Bank</label>
                                        <select wire:model="villageBankId" class="form-control z-input">
                                            <option value="">All Village Banks</option>
                                            @foreach ($this->villageBanks as $vb)
                                                <option value="{{ $vb->id }}">{{ $vb->name }} ({{ $vb->code }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="z-label">Circle <span class="text-danger">*</span></label>
                                        <select wire:model="circleId" class="form-control z-input">
                                            <option value="">-- Select Circle --</option>
                                            @foreach ($circles as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->members_count }})</option>
                                            @endforeach
                                        </select>
                                        @error('circleId') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="z-label">Active Month <span class="text-danger">*</span></label>
                                        <select wire:model="monthId" class="form-control z-input" {{ empty($circleId) ? 'disabled' : '' }}>
                                            <option value="">-- Select Month --</option>
                                            @foreach ($months as $mo)
                                                <option value="{{ $mo->id }}">Month {{ $mo->month_number }} ({{ $mo->start_date->format('d M') }} - {{ $mo->end_date->format('d M') }})</option>
                                            @endforeach
                                        </select>
                                        @error('monthId') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Receiver --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="z-label">Receiver (Lender) <span class="text-danger">*</span></label>
                                        <select wire:model="receiverId" class="form-control z-input" {{ empty($circleId) ? 'disabled' : '' }}>
                                            <option value="">-- Select Member --</option>
                                            @foreach ($membersList as $m)
                                                <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->email }})</option>
                                            @endforeach
                                        </select>
                                        @error('receiverId') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Amount & Payment Method --}}
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="z-label">Amount (K) <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" min="0.01" wire:model.defer="amount" class="form-control z-input" placeholder="0.00">
                                        @error('amount') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="z-label">Payment Method <span class="text-danger">*</span></label>
                                        <select wire:model.defer="paymentMethodId" class="form-control z-input">
                                            <option value="">-- Select Method --</option>
                                            @foreach ($paymentMethods as $pm)
                                                <option value="{{ $pm->id }}">{{ $pm->name }} ({{ str_replace('_', ' ', $pm->type) }})</option>
                                            @endforeach
                                        </select>
                                        @error('paymentMethodId') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Proof upload --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="z-label">Proof of Payment <small class="text-muted">(optional, JPG/PNG/PDF, max 5 MB)</small></label>
                                        <input type="file" wire:model="proofFile" class="form-control z-input">
                                        @error('proofFile') <small class="text-danger">{{ $message }}</small> @enderror
                                        <div wire:loading wire:target="proofFile" class="mt-1">
                                            <small class="text-muted"><i class="fas fa-spinner fa-spin mr-1"></i> Uploading...</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white border-top d-flex justify-content-end" style="gap:0.75rem;">
                                <button type="submit" class="btn-zesco-green" wire:loading.attr="disabled" wire:target="submitPayment">
                                    <span wire:loading.remove wire:target="submitPayment"><i class="fas fa-paper-plane mr-1"></i> Submit Payment</span>
                                    <span wire:loading wire:target="submitPayment"><i class="fas fa-spinner fa-spin mr-1"></i> Submitting...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card z-card">
                        <div class="card-header">
                            <h3><i class="fas fa-info-circle mr-2" style="color:var(--z-gold)"></i>Payment Info</h3>
                        </div>
                        <div class="card-body" style="font-size:0.88rem;color:#4b5563;">
                            <ul class="list-unstyled mb-0" style="line-height:2;">
                                <li><i class="fas fa-check text-success mr-2"></i> Payments are recorded as <strong>Pending</strong></li>
                                <li><i class="fas fa-check text-success mr-2"></i> An admin must confirm the payment</li>
                                <li><i class="fas fa-check text-success mr-2"></i> Upload a proof of payment for faster confirmation</li>
                                <li><i class="fas fa-check text-success mr-2"></i> Supported formats: JPG, PNG, PDF (max 5 MB)</li>
                                <li><i class="fas fa-check text-success mr-2"></i> Confirmed payments update balances automatically</li>
                            </ul>
                        </div>
                    </div>

                    @if ($paymentMethods->count() === 0)
                        <div class="alert alert-warning" style="border-radius:10px;font-size:0.88rem;">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            <strong>No payment methods configured.</strong> Please contact an administrator to set up payment methods.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
