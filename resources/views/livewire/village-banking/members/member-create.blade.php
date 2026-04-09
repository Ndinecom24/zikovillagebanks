<div>
    @push('custom-styles')
    <style>
        .reg-wizard { max-width: 900px; margin: 0 auto; }

        /* Step indicator */
        .step-indicator {
            display: flex;
            justify-content: center;
            gap: 0;
            margin-bottom: 2rem;
            position: relative;
        }
        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
            cursor: pointer;
        }
        .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 18px;
            left: 55%;
            width: 90%;
            height: 3px;
            background: #e2e8f0;
            z-index: 0;
        }
        .step-item.completed:not(:last-child)::after {
            background: #D97706;
        }
        .step-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.82rem;
            border: 3px solid #e2e8f0;
            background: #fff;
            color: #94a3b8;
            position: relative;
            z-index: 2;
            transition: all 0.3s;
        }
        .step-item.active .step-circle {
            border-color: #D97706;
            background: #D97706;
            color: #fff;
            box-shadow: 0 0 0 4px rgba(217,119,6,0.15);
        }
        .step-item.completed .step-circle {
            border-color: #16a34a;
            background: #16a34a;
            color: #fff;
        }
        .step-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: #94a3b8;
            margin-top: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .step-item.active .step-label { color: #D97706; }
        .step-item.completed .step-label { color: #16a34a; }

        /* Form card */
        .reg-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid rgba(30,58,95,0.06);
            overflow: hidden;
        }
        .reg-card-header {
            background: linear-gradient(135deg, #1E3A5F 0%, #2B6B96 100%);
            padding: 1.25rem 1.75rem;
            color: #fff;
        }
        .reg-card-header h3 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .reg-card-header p {
            margin: 0.25rem 0 0;
            font-size: 0.8rem;
            opacity: 0.75;
        }
        .reg-card-body {
            padding: 1.75rem;
        }

        /* Section dividers */
        .reg-section-title {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #1E3A5F;
            margin-bottom: 1rem;
            padding-bottom: 0.4rem;
            border-bottom: 2px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .reg-section-title i { color: #D97706; font-size: 0.85rem; }

        /* Form fields */
        .reg-field {
            margin-bottom: 1rem;
        }
        .reg-field label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #475569;
            margin-bottom: 0.3rem;
            display: block;
        }
        .reg-field label .required { color: #dc2626; }
        .reg-field input,
        .reg-field select,
        .reg-field textarea {
            width: 100%;
            padding: 0.55rem 0.85rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.88rem;
            color: #1e293b;
            transition: all 0.2s;
            background: #fff;
        }
        .reg-field input:focus,
        .reg-field select:focus,
        .reg-field textarea:focus {
            border-color: #D97706;
            outline: none;
            box-shadow: 0 0 0 3px rgba(217,119,6,0.1);
        }
        .reg-field textarea { resize: vertical; min-height: 70px; }
        .reg-field .field-error {
            color: #dc2626;
            font-size: 0.76rem;
            margin-top: 0.2rem;
        }

        /* Footer buttons */
        .reg-footer {
            padding: 1rem 1.75rem;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fafbfc;
        }
        .reg-btn {
            padding: 0.55rem 1.5rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }
        .reg-btn-primary {
            background: linear-gradient(135deg, #D97706, #F59E0B);
            color: #fff;
        }
        .reg-btn-primary:hover {
            background: linear-gradient(135deg, #b45309, #D97706);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(217,119,6,0.25);
        }
        .reg-btn-navy {
            background: linear-gradient(135deg, #1E3A5F, #2B6B96);
            color: #fff;
        }
        .reg-btn-navy:hover {
            background: linear-gradient(135deg, #162d4a, #1E3A5F);
            transform: translateY(-1px);
        }
        .reg-btn-outline {
            background: #fff;
            border: 2px solid #e2e8f0;
            color: #64748b;
        }
        .reg-btn-outline:hover {
            border-color: #cbd5e1;
            color: #475569;
        }

        /* Info sidebar card */
        .info-tip {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 12px;
            padding: 1rem;
            font-size: 0.82rem;
            color: #92400e;
            margin-top: 1rem;
        }
        .info-tip i { color: #D97706; }

        @media (max-width: 768px) {
            .step-label { display: none; }
            .reg-card-body { padding: 1.25rem; }
        }
    </style>
    @endpush

    @can('create-members')
    {{-- License limit alert --}}
    @if ($memberLimitReached)
        <div class="container-fluid mt-3">
            <div class="alert alert-danger" style="border-radius:10px;font-size:0.9rem;border-left:4px solid #dc3545;">
                <i class="fas fa-ban mr-2"></i><strong>Member Limit Reached:</strong> {{ $memberLimitMessage }}
            </div>
        </div>
    @endif
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;padding:0.5rem 0;">
                <div>
                    <h4 style="font-weight:800;color:#1e293b;margin:0;">
                        <i class="fas fa-user-plus mr-2" style="color:#D97706;"></i>Register New Member
                    </h4>
                    <p style="font-size:0.82rem;color:#64748b;margin:0.2rem 0 0;">Complete all steps to register a new village bank member</p>
                </div>
                <a href="{{ route('members.index') }}" class="reg-btn reg-btn-outline">
                    <i class="fas fa-arrow-left"></i> Back to Members
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <section class="content">
        <div class="container-fluid">

            {{-- Success --}}
            @if ($successMessage)
                <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:14px;padding:1rem 1.25rem;margin-bottom:1.5rem;display:flex;align-items:center;gap:0.75rem;">
                    <div style="width:40px;height:40px;border-radius:50%;background:#16a34a;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-check" style="color:#fff;"></i>
                    </div>
                    <div>
                        <strong style="color:#16a34a;">{{ $successMessage }}</strong>
                        <br><a href="{{ route('members.index') }}" style="color:#1E3A5F;font-weight:600;font-size:0.85rem;">View Members &rarr;</a>
                    </div>
                </div>
            @endif

            <div class="reg-wizard">

                {{-- Step Indicator --}}
                <div class="step-indicator">
                    @php
                        $steps = [
                            ['icon' => 'fa-user', 'label' => 'Personal'],
                            ['icon' => 'fa-briefcase', 'label' => 'Employment'],
                            ['icon' => 'fa-map-marker-alt', 'label' => 'Address & NOK'],
                            ['icon' => 'fa-handshake', 'label' => 'Guarantor'],
                        ];
                    @endphp
                    @foreach($steps as $i => $step)
                        <div class="step-item {{ ($i + 1) < $currentStep ? 'completed' : '' }} {{ ($i + 1) == $currentStep ? 'active' : '' }}"
                             wire:click="goToStep({{ $i + 1 }})">
                            <div class="step-circle">
                                @if(($i + 1) < $currentStep)
                                    <i class="fas fa-check"></i>
                                @else
                                    {{ $i + 1 }}
                                @endif
                            </div>
                            <div class="step-label">{{ $step['label'] }}</div>
                        </div>
                    @endforeach
                </div>

                <form wire:submit.prevent="register">
                    <div class="reg-card">

                        {{-- ════════════════════════════════════════
                             STEP 1: Personal Information
                             ════════════════════════════════════════ --}}
                        @if($currentStep === 1)
                            <div class="reg-card-header">
                                <h3><i class="fas fa-user"></i> Personal Information</h3>
                                <p>Basic details about the new member</p>
                            </div>
                            <div class="reg-card-body">
                                @if ($errors->any())
                                    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:0.6rem 0.85rem;margin-bottom:1rem;font-size:0.82rem;color:#dc2626;">
                                        <i class="fas fa-exclamation-circle mr-1"></i> Please fix the errors below.
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Full Name <span class="required">*</span></label>
                                            <input type="text" wire:model.defer="name" placeholder="e.g. John Banda">
                                            @error('name') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input type="email" wire:model.defer="email" placeholder="john@example.com">
                                            @error('email') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Phone Number <span class="required">*</span></label>
                                            <input type="text" wire:model.defer="phone" placeholder="0977 123 456">
                                            @error('phone') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Mobile Number</label>
                                            <input type="text" wire:model.defer="mobileNo" placeholder="0966 789 012">
                                            @error('mobileNo') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="reg-section-title" style="margin-top:0.5rem;">
                                    <i class="fas fa-id-card"></i> Identity Details
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="reg-field">
                                            <label>Date of Birth</label>
                                            <input type="date" wire:model.defer="dateOfBirth">
                                            @error('dateOfBirth') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="reg-field">
                                            <label>Gender</label>
                                            <select wire:model.defer="gender">
                                                <option value="">Select gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                            @error('gender') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="reg-field">
                                            <label>National ID / NRC</label>
                                            <input type="text" wire:model.defer="nationalId" placeholder="e.g. 123456/78/1">
                                            @error('nationalId') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="reg-section-title" style="margin-top:0.5rem;">
                                    <i class="fas fa-lock"></i> Account Security
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Password <span class="required">*</span></label>
                                            <input type="password" wire:model.defer="password" placeholder="Min 8 characters">
                                            @error('password') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Confirm Password <span class="required">*</span></label>
                                            <input type="password" wire:model.defer="passwordConfirmation" placeholder="Re-enter password">
                                            @error('passwordConfirmation') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- ════════════════════════════════════════
                             STEP 2: Employment Details
                             ════════════════════════════════════════ --}}
                        @if($currentStep === 2)
                            <div class="reg-card-header">
                                <h3><i class="fas fa-briefcase"></i> Employment Details</h3>
                                <p>Work and occupation information</p>
                            </div>
                            <div class="reg-card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Employment Status</label>
                                            <select wire:model.defer="employmentStatus">
                                                <option value="">Select status</option>
                                                <option value="employed">Employed</option>
                                                <option value="self_employed">Self Employed</option>
                                                <option value="unemployed">Unemployed</option>
                                                <option value="student">Student</option>
                                                <option value="retired">Retired</option>
                                            </select>
                                            @error('employmentStatus') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Job Title / Occupation</label>
                                            <input type="text" wire:model.defer="jobTitle" placeholder="e.g. Accountant, Teacher, Farmer">
                                            @error('jobTitle') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Company / Employer Name</label>
                                            <input type="text" wire:model.defer="companyName" placeholder="e.g. ABC Limited">
                                            @error('companyName') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Company Location</label>
                                            <input type="text" wire:model.defer="companyLocation" placeholder="e.g. Lusaka, Cairo Road">
                                            @error('companyLocation') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="info-tip">
                                    <i class="fas fa-lightbulb mr-1"></i>
                                    <strong>Tip:</strong> Employment details help us assess loan eligibility and set appropriate limits for the member.
                                </div>
                            </div>
                        @endif

                        {{-- ════════════════════════════════════════
                             STEP 3: Address & Next of Kin
                             ════════════════════════════════════════ --}}
                        @if($currentStep === 3)
                            <div class="reg-card-header">
                                <h3><i class="fas fa-map-marker-alt"></i> Address & Next of Kin</h3>
                                <p>Home address and emergency contact details</p>
                            </div>
                            <div class="reg-card-body">
                                <div class="reg-section-title">
                                    <i class="fas fa-home"></i> Home Address
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Country</label>
                                            <input type="text" wire:model.defer="country" placeholder="e.g. Zambia">
                                            @error('country') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Province / State</label>
                                            <input type="text" wire:model.defer="province" placeholder="e.g. Lusaka Province">
                                            @error('province') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>City / Town</label>
                                            <input type="text" wire:model.defer="city" placeholder="e.g. Lusaka">
                                            @error('city') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Home Address</label>
                                            <textarea wire:model.defer="homeAddress" placeholder="e.g. Plot 123, Kabulonga Road, Woodlands"></textarea>
                                            @error('homeAddress') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="reg-section-title" style="margin-top:1rem;">
                                    <i class="fas fa-user-friends"></i> Next of Kin (Emergency Contact)
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Full Name</label>
                                            <input type="text" wire:model.defer="nokName" placeholder="e.g. Mary Banda">
                                            @error('nokName') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Relationship</label>
                                            <select wire:model.defer="nokRelationship">
                                                <option value="">Select relationship</option>
                                                <option value="spouse">Spouse</option>
                                                <option value="parent">Parent</option>
                                                <option value="child">Child (Adult)</option>
                                                <option value="sibling">Sibling</option>
                                                <option value="relative">Other Relative</option>
                                                <option value="friend">Friend</option>
                                            </select>
                                            @error('nokRelationship') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Contact Phone</label>
                                            <input type="text" wire:model.defer="nokContact" placeholder="0977 999 888">
                                            @error('nokContact') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="reg-field">
                                            <label>Address / Location</label>
                                            <textarea wire:model.defer="nokAddress" placeholder="e.g. Chilenje South, Lusaka"></textarea>
                                            @error('nokAddress') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- ════════════════════════════════════════
                             STEP 4: Guarantor
                             ════════════════════════════════════════ --}}
                        @if($currentStep === 4)
                            <div class="reg-card-header">
                                <h3><i class="fas fa-handshake"></i> Guarantor Selection</h3>
                                <p>Select an existing member to guarantee this new member</p>
                            </div>
                            <div class="reg-card-body">
                                @if ($guarantorId)
                                    {{-- Selected guarantor --}}
                                    <div style="display:flex;align-items:center;gap:1rem;padding:1.25rem;background:#f0fdf4;border:2px solid #bbf7d0;border-radius:14px;margin-bottom:1rem;">
                                        @php
                                            $gparts = explode(' ', trim($guarantorName));
                                            $gi = strtoupper(substr($gparts[0], 0, 1) . (isset($gparts[1]) ? substr($gparts[1], 0, 1) : ''));
                                        @endphp
                                        <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#1E3A5F,#2B6B96);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:0.9rem;flex-shrink:0;">
                                            {{ $gi }}
                                        </div>
                                        <div style="flex:1;">
                                            <strong style="font-size:1rem;color:#1e293b;">{{ $guarantorName }}</strong>
                                            <div style="font-size:0.78rem;color:#16a34a;font-weight:600;margin-top:2px;">
                                                <i class="fas fa-check-circle"></i> Selected as Guarantor
                                            </div>
                                        </div>
                                        <button type="button" wire:click="clearGuarantor" class="reg-btn reg-btn-outline" style="padding:0.4rem 0.85rem;font-size:0.78rem;">
                                            <i class="fas fa-times"></i> Change
                                        </button>
                                    </div>
                                @else
                                    {{-- Guarantor search --}}
                                    <div class="position-relative" style="margin-bottom:1rem;">
                                        <div class="reg-field">
                                            <label>Search for a Guarantor <span class="required">*</span></label>
                                            <div style="position:relative;">
                                                <input type="text" wire:model.debounce.300ms="guarantorSearch"
                                                    placeholder="Type name, email or phone to search..."
                                                    style="padding-left:2.2rem;">
                                                <i class="fas fa-search" style="position:absolute;left:0.75rem;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:0.85rem;"></i>
                                            </div>
                                            @error('guarantorId') <div class="field-error">{{ $message }}</div> @enderror
                                        </div>

                                        @if ($showGuarantorResults && $guarantorResults->count() > 0)
                                            <div style="position:absolute;z-index:50;width:100%;max-height:280px;overflow-y:auto;background:#fff;border:1px solid #e2e8f0;border-radius:0 0 12px 12px;box-shadow:0 8px 24px rgba(0,0,0,0.1);">
                                                @foreach ($guarantorResults as $gr)
                                                    <button type="button" wire:click="selectGuarantor({{ $gr->id }})"
                                                        style="display:flex;align-items:center;gap:0.75rem;width:100%;padding:0.75rem 1rem;border:none;background:none;text-align:left;cursor:pointer;border-bottom:1px solid #f1f5f9;transition:background 0.15s;"
                                                        onmouseover="this.style.background='#fefce8'" onmouseout="this.style.background='none'">
                                                        @php
                                                            $rp = explode(' ', trim($gr->name));
                                                            $ri = strtoupper(substr($rp[0], 0, 1) . (isset($rp[1]) ? substr($rp[1], 0, 1) : ''));
                                                        @endphp
                                                        <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#1E3A5F,#2B6B96);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:0.72rem;flex-shrink:0;">
                                                            {{ $ri }}
                                                        </div>
                                                        <div>
                                                            <div style="font-weight:600;font-size:0.88rem;color:#1e293b;">{{ $gr->name }}</div>
                                                            <div style="font-size:0.75rem;color:#64748b;">{{ $gr->email }} &bull; {{ $gr->phone ?? 'No phone' }}</div>
                                                        </div>
                                                    </button>
                                                @endforeach
                                            </div>
                                        @elseif ($showGuarantorResults && $guarantorResults->count() === 0)
                                            <div style="position:absolute;z-index:50;width:100%;background:#fff;border:1px solid #e2e8f0;border-radius:0 0 12px 12px;box-shadow:0 4px 12px rgba(0,0,0,0.06);padding:1.25rem;text-align:center;color:#94a3b8;">
                                                <i class="fas fa-search" style="font-size:1.5rem;opacity:0.4;display:block;margin-bottom:0.5rem;"></i>
                                                No active members found for "{{ $guarantorSearch }}"
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <div class="info-tip">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    <strong>About Guarantors:</strong> Every new member needs an existing member to vouch for them. The guarantor accepts responsibility if the new member defaults on any obligations.
                                </div>
                            </div>
                        @endif

                        {{-- Footer Navigation --}}
                        <div class="reg-footer">
                            <div>
                                @if($currentStep > 1)
                                    <button type="button" wire:click="previousStep" class="reg-btn reg-btn-outline">
                                        <i class="fas fa-arrow-left"></i> Previous
                                    </button>
                                @else
                                    <a href="{{ route('members.index') }}" class="reg-btn reg-btn-outline">Cancel</a>
                                @endif
                            </div>
                            <div style="display:flex;gap:0.5rem;align-items:center;">
                                <span style="font-size:0.75rem;color:#94a3b8;font-weight:600;">Step {{ $currentStep }} of {{ $totalSteps }}</span>
                                @if($currentStep < $totalSteps)
                                    <button type="button" wire:click="nextStep" class="reg-btn reg-btn-navy">
                                        Next <i class="fas fa-arrow-right"></i>
                                    </button>
                                @else
                                    <button type="submit" class="reg-btn reg-btn-primary" wire:loading.attr="disabled" wire:target="register" @if($memberLimitReached) disabled title="Member limit reached" @endif>
                                        <span wire:loading.remove wire:target="register"><i class="fas fa-user-plus"></i> Register Member</span>
                                        <span wire:loading wire:target="register"><i class="fas fa-spinner fa-spin"></i> Registering...</span>
                                    </button>
                                @endif
                            </div>
                        </div>

                    </div> {{-- end reg-card --}}
                </form>

                {{-- Info Panel --}}
                <div style="margin-top:1.25rem;background:#f8fafc;border:1px solid #f1f5f9;border-radius:14px;padding:1rem 1.25rem;">
                    <h6 style="font-weight:700;color:#1e293b;font-size:0.85rem;margin-bottom:0.5rem;">
                        <i class="fas fa-info-circle mr-1" style="color:#D97706;"></i> Registration Notes
                    </h6>
                    <ul style="margin:0;padding-left:1.25rem;font-size:0.82rem;color:#64748b;line-height:1.8;">
                        <li>Fields marked <span style="color:#dc2626;font-weight:600;">*</span> are required</li>
                        <li>Every member must have a guarantor (Step 4)</li>
                        <li>New members are created with <strong>Pending</strong> status</li>
                        <li>Admin approval is required before a member can access the platform</li>
                        <li>Employment and address details help with loan assessments</li>
                    </ul>
                </div>

            </div> {{-- end reg-wizard --}}
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
