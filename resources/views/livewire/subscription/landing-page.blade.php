<div>
    {{-- ===== Navbar ===== --}}
    <nav class="landing-nav">
        <div class="container">
            <a href="/" class="logo">Ziko Village<span>Bank</span></a>
            <div class="nav-links">
                <a href="#features">Features</a>
                <a href="#pricing">Pricing</a>
                <a href="#how-it-works">How It Works</a>
                <a href="#training">Training</a>
                @auth
                    <a href="{{ route('home') }}" class="btn-nav-login">Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="btn-nav-register">Register</a>
                    <a href="{{ route('login') }}" class="btn-nav-login">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ===== Success Alert ===== --}}
    @if($successMessage)
        <div style="position:fixed;top:70px;left:50%;transform:translateX(-50%);z-index:300;max-width:600px;width:90%;">
            <div style="background:#dcfce7;border:1px solid #86efac;border-radius:12px;padding:1rem 1.5rem;display:flex;align-items:flex-start;gap:0.75rem;">
                <i class="fas fa-check-circle" style="color:#16a34a;font-size:1.2rem;margin-top:2px;"></i>
                <div>
                    <strong style="color:#166534;">Application Submitted!</strong>
                    <p style="color:#15803d;font-size:0.9rem;margin:0.25rem 0 0;">{{ $successMessage }}</p>
                </div>
                <button wire:click="$set('successMessage', '')" style="background:none;border:none;color:#16a34a;font-size:1.2rem;cursor:pointer;margin-left:auto;">&times;</button>
            </div>
        </div>
    @endif

    {{-- ===== Hero Section ===== --}}
    <section class="hero">
        <div class="container">
            {{-- Left: Text --}}
            <div class="hero-text">
                <div class="hero-badge">
                    <i class="fas fa-shield-alt"></i> Trusted by 50+ Village Banks in Zambia
                </div>
                <h1>Manage Your<br><span>Village Bank</span><br>With Confidence</h1>
                <p>The all-in-one platform for community savings groups. Track shares, manage loans, automate shareouts, and grow your village bank — transparently and digitally.</p>
                <div class="cta-row">
                    <a href="#pricing" class="btn-hero-primary"><i class="fas fa-rocket"></i> Get Started Free</a>
                    <a href="#how-it-works" class="btn-hero-secondary"><i class="fas fa-play-circle"></i> See How It Works</a>
                </div>
                {{-- Trust row --}}
                <div class="hero-trust">
                    <div class="hero-trust-avatars">
                        <span style="background:#1E3A5F;">GM</span>
                        <span style="background:#D97706;">JB</span>
                        <span style="background:#2B6B96;">MP</span>
                        <span style="background:#16a34a;">CZ</span>
                        <span style="background:#7c3aed;">+46</span>
                    </div>
                    <div class="hero-trust-text">
                        <strong>500+ members</strong> already managing<br>their finances on our platform
                    </div>
                </div>
            </div>

            {{-- Right: Image composition --}}
            <div class="hero-visual">
                <div class="hero-img-grid">
                    <div class="hero-img-card tall">
                        <img src="{{ asset('img/image2.jpg') }}" alt="Community Savings">
                    </div>
                    <div class="hero-img-card">
                        <img src="{{ asset('img/image1.jpg') }}" alt="Village Banking" style="height:180px;">
                    </div>
                    <div class="hero-img-card">
                        <img src="{{ asset('img/image4.jpg') }}" alt="Financial Growth" style="height:180px;">
                    </div>
                </div>

                {{-- Floating stat: top-left --}}
                <div class="hero-stat-float" style="top:-10px;left:-30px;animation-delay:0s;">
                    <div class="stat-icon" style="background:#dcfce7;color:#16a34a;"><i class="fas fa-chart-line"></i></div>
                    <div>
                        <div class="stat-value">K2.4M</div>
                        <div class="stat-label">Managed Monthly</div>
                    </div>
                </div>

                {{-- Floating stat: bottom-right --}}
                <div class="hero-stat-float" style="bottom:20px;right:-20px;animation-delay:2s;">
                    <div class="stat-icon" style="background:#fef3c7;color:#D97706;"><i class="fas fa-users"></i></div>
                    <div>
                        <div class="stat-value">50+</div>
                        <div class="stat-label">Active Banks</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Features Section ===== --}}
    <section class="features" id="features">
        <div class="container">
            <h2>Everything You Need</h2>
            <p class="subtitle">Powerful features designed for village banking groups of all sizes</p>
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#dcfce7;color:#16a34a;">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Member Management</h3>
                    <p>Register members, track contributions, and maintain a complete membership directory with ease.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fef3c7;color:#d97706;">
                        <i class="fas fa-coins"></i>
                    </div>
                    <h3>Shares & Insurance</h3>
                    <p>Record share purchases, track insurance contributions, and calculate dividends automatically.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="background:#dbeafe;color:#2563eb;">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h3>Loan Management</h3>
                    <p>Process loan applications, track disbursements, repayments, and calculate interest effortlessly.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="background:#f3e8ff;color:#7c3aed;">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3>Shareout Calculations</h3>
                    <p>Automate the end-of-cycle shareout process with fair, transparent dividend distribution.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fce7f3;color:#db2777;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3>Reports & Analytics</h3>
                    <p>Generate comprehensive reports on shares, loans, attendance, and financial performance.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="background:#ccfbf1;color:#0d9488;">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Rules & Governance</h3>
                    <p>Define bylaws, require member acknowledgement, and maintain group discipline digitally.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Trust / Social Proof Banner ===== --}}
    <section style="padding:3rem 1.5rem;background:linear-gradient(135deg, #1E3A5F 0%, #2B6B96 100%);color:#fff;">
        <div style="max-width:1100px;margin:0 auto;display:flex;align-items:center;gap:3rem;flex-wrap:wrap;">
            <div style="flex:1;min-width:280px;">
                <img src="{{ asset('img/image5.jpg') }}" alt="Trusted by communities"
                     style="width:100%;max-height:280px;object-fit:cover;border-radius:16px;box-shadow:0 8px 30px rgba(0,0,0,0.25);">
            </div>
            <div style="flex:1;min-width:280px;">
                <h2 style="font-size:1.8rem;font-weight:800;margin-bottom:0.75rem;">Trusted by Village Banks Across Zambia</h2>
                <p style="font-size:1rem;color:rgba(255,255,255,0.8);line-height:1.7;margin-bottom:1.5rem;">Join hundreds of community savings groups already using our platform to manage their finances transparently and grow together.</p>
                <div style="display:flex;gap:2rem;flex-wrap:wrap;">
                    <div>
                        <div style="font-size:2rem;font-weight:800;color:#F59E0B;">500+</div>
                        <div style="font-size:0.85rem;color:rgba(255,255,255,0.7);">Active Members</div>
                    </div>
                    <div>
                        <div style="font-size:2rem;font-weight:800;color:#F59E0B;">50+</div>
                        <div style="font-size:0.85rem;color:rgba(255,255,255,0.7);">Village Banks</div>
                    </div>
                    <div>
                        <div style="font-size:2rem;font-weight:800;color:#F59E0B;">K2M+</div>
                        <div style="font-size:0.85rem;color:rgba(255,255,255,0.7);">Managed Monthly</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Pricing Section ===== --}}
    <section class="pricing" id="pricing">
        <div class="container">
            <h2>Choose Your Plan</h2>
            <p class="subtitle">Affordable pricing for village banks of every size</p>

            @if($plans->count())
                <div class="pricing-grid">
                    @foreach($plans as $plan)
                        <div class="plan-card {{ $plan->is_featured ? 'featured' : '' }}">
                            <div class="plan-name">{{ $plan->name }}</div>
                            @if($plan->description)
                                <p style="color:#64748b;font-size:0.88rem;margin-bottom:0.5rem;">{{ $plan->description }}</p>
                            @endif
                            <div class="plan-price">
                                {{ $plan->formattedPrice() }}<span>{{ $plan->cycleName() }}</span>
                            </div>
                            <ul class="plan-features">
                                @if($plan->max_members)
                                    <li><i class="fas fa-check"></i> Up to {{ $plan->max_members }} members</li>
                                @else
                                    <li><i class="fas fa-check"></i> Unlimited members</li>
                                @endif
                                @if($plan->max_circles)
                                    <li><i class="fas fa-check"></i> Up to {{ $plan->max_circles }} circles</li>
                                @else
                                    <li><i class="fas fa-check"></i> Unlimited circles</li>
                                @endif
                                <li><i class="fas fa-check"></i> {{ $plan->duration_days }}-day license</li>
                                @if(is_array($plan->features))
                                    @foreach($plan->features as $feature)
                                        <li><i class="fas fa-check"></i> {{ $feature }}</li>
                                    @endforeach
                                @endif
                            </ul>
                            <button wire:click="selectPlan({{ $plan->id }})"
                                class="btn-plan {{ $plan->is_featured ? 'btn-plan-primary' : 'btn-plan-outline' }}">
                                Apply Now
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align:center;padding:3rem;color:#64748b;">
                    <i class="fas fa-info-circle" style="font-size:2rem;margin-bottom:1rem;display:block;"></i>
                    <p>Subscription plans will be available soon. Please check back later.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ===== How It Works ===== --}}
    <section class="how-it-works" id="how-it-works">
        <div class="container">
            <h2>How It Works</h2>
            <div style="display:flex;gap:2.5rem;align-items:center;flex-wrap:wrap;margin-bottom:2.5rem;">
                <div style="flex:1;min-width:280px;">
                    <img src="{{ asset('img/image6.jpg') }}" alt="Getting started"
                         style="width:100%;max-height:300px;object-fit:cover;border-radius:16px;box-shadow:0 6px 25px rgba(0,0,0,0.08);">
                </div>
                <div style="flex:1;min-width:280px;">
                    <p style="font-size:1.05rem;color:#475569;line-height:1.7;">Getting started is simple. Choose a plan, submit your application with proof of payment, and our team will have you up and running within 24 hours. No technical skills required.</p>
                    <a href="#pricing" style="display:inline-flex;align-items:center;gap:0.5rem;margin-top:1rem;color:#D97706;font-weight:600;text-decoration:none;font-size:0.95rem;">
                        <i class="fas fa-arrow-right"></i> View Plans & Get Started
                    </a>
                </div>
            </div>
            <div class="steps">
                <div class="step">
                    <div class="step-num">1</div>
                    <div>
                        <h3>Choose a Plan</h3>
                        <p>Select the subscription plan that fits your village bank's needs and group size.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-num">2</div>
                    <div>
                        <h3>Submit Application</h3>
                        <p>Fill in your bank details, upload proof of payment, and submit your application for review.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-num">3</div>
                    <div>
                        <h3>Get Approved</h3>
                        <p>Our admin team reviews your payment and application within 24 hours. You'll receive an email confirmation.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-num">4</div>
                    <div>
                        <h3>Start Managing</h3>
                        <p>Log in with your credentials, set up your circles, and begin managing your village bank digitally.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Training Programs Section ===== --}}
    <section class="training" id="training">
        <div class="container">
            <h2>Training & Capacity Building</h2>
            <p class="subtitle">Strengthen your village bank with professional training in finance, governance, and management</p>

            @if($trainingPrograms->count())
                <div class="training-grid">
                    @foreach($trainingPrograms as $tp)
                        <div class="training-card">
                            <div class="training-card-img">
                                @if($tp->cover_image)
                                    <img src="{{ asset('storage/' . $tp->cover_image) }}" alt="{{ $tp->title }}">
                                @else
                                    <i class="fas fa-graduation-cap tc-icon"></i>
                                @endif
                                <span class="training-card-badge" style="background:{{ $tp->categoryColor() }};">
                                    {{ $tp->categoryLabel() }}
                                </span>
                                @if($tp->is_featured)
                                    <span class="training-card-featured"><i class="fas fa-star"></i> Featured</span>
                                @endif
                            </div>
                            <div class="training-card-body">
                                <h3>{{ $tp->title }}</h3>
                                @if($tp->description)
                                    <p class="tc-desc">{{ Str::limit($tp->description, 120) }}</p>
                                @endif
                                <div class="training-card-meta">
                                    @if($tp->start_date)
                                        <span><i class="fas fa-calendar-alt"></i> {{ $tp->start_date->format('d M Y') }}</span>
                                    @endif
                                    @if($tp->duration)
                                        <span><i class="fas fa-clock"></i> {{ $tp->duration }}</span>
                                    @endif
                                    @if($tp->location)
                                        <span><i class="fas fa-map-marker-alt"></i> {{ $tp->location }}</span>
                                    @endif
                                    @if($tp->trainer)
                                        <span><i class="fas fa-chalkboard-teacher"></i> {{ $tp->trainer }}</span>
                                    @endif
                                </div>
                                <div class="training-card-footer">
                                    <div class="tc-price {{ $tp->isFree() ? 'free' : '' }}">
                                        {{ $tp->formattedFee() }}
                                    </div>
                                    @if($tp->isFull())
                                        <button class="btn-training-apply" disabled>
                                            <i class="fas fa-ban"></i> Full
                                        </button>
                                    @else
                                        <button wire:click="openTrainingModal({{ $tp->id }})" class="btn-training-apply">
                                            <i class="fas fa-paper-plane"></i> Apply Now
                                        </button>
                                    @endif
                                </div>
                                @if($tp->max_participants)
                                    @php $spots = $tp->spotsLeft(); @endphp
                                    <div style="margin-top:0.75rem;">
                                        <div style="background:#e2e8f0;border-radius:10px;height:6px;overflow:hidden;">
                                            @php $pct = $tp->max_participants > 0 ? (($tp->max_participants - $spots) / $tp->max_participants) * 100 : 0; @endphp
                                            <div style="height:100%;width:{{ $pct }}%;background:{{ $pct >= 90 ? '#dc3545' : ($pct >= 70 ? '#D97706' : '#16a34a') }};border-radius:10px;transition:width 0.3s;"></div>
                                        </div>
                                        <small style="color:#64748b;font-size:0.78rem;">{{ $spots }} spot{{ $spots !== 1 ? 's' : '' }} left</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align:center;padding:3rem;color:#64748b;">
                    <i class="fas fa-graduation-cap" style="font-size:2.5rem;margin-bottom:1rem;display:block;opacity:0.4;"></i>
                    <p>Training programs coming soon. Check back for upcoming courses!</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ===== Footer ===== --}}
    <footer class="landing-footer">
        <p>&copy; {{ date('Y') }} Village Banking Platform. All rights reserved. | <a href="{{ route('login') }}">Admin Login</a></p>
    </footer>

    {{-- ===== Application Modal ===== --}}
    @if($showApplyModal)
        <div class="landing-modal-overlay" wire:click.self="closeModal">
            <div class="landing-modal">
                <div class="landing-modal-header">
                    <h3><i class="fas fa-file-signature"></i> &nbsp;Apply for a Village Bank Account</h3>
                    <button wire:click="closeModal">&times;</button>
                </div>
                <div class="landing-modal-body">
                    <form wire:submit.prevent="submitApplication">
                        {{-- Selected Plan --}}
                        @if($selectedPlanId)
                            @php $selectedPlan = $plans->firstWhere('id', $selectedPlanId); @endphp
                            @if($selectedPlan)
                                <div style="background:#f0f9f4;border:1px solid #86efac;border-radius:10px;padding:0.75rem 1rem;margin-bottom:1.25rem;display:flex;align-items:center;gap:0.75rem;">
                                    <i class="fas fa-tag" style="color:var(--nd-primary);"></i>
                                    <div>
                                        <strong style="color:var(--nd-primary);">{{ $selectedPlan->name }}</strong>
                                        <span style="color:#475569;font-size:0.88rem;"> &mdash; {{ $selectedPlan->formattedPrice() }}{{ $selectedPlan->cycleName() }}</span>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <h6 style="font-weight:700;color:var(--nd-primary);margin-bottom:0.75rem;font-size:0.9rem;">
                            <i class="fas fa-building"></i> Village Bank Details
                        </h6>

                        <div class="lf-row">
                            <div>
                                <label class="lf-label">Village Bank Name <span style="color:#dc3545;">*</span></label>
                                <input type="text" wire:model.defer="bankName" class="lf-input" placeholder="e.g. Sunrise Village Bank">
                                @error('bankName') <div class="lf-error">{{ $message }}</div> @enderror
                            </div>
                            <div>
                                <label class="lf-label">Village Bank Code</label>
                                <div class="lf-input" style="background:#f1f5f9;color:#64748b;cursor:default;">
                                    <i class="fas fa-lock" style="font-size:0.75rem;"></i> Auto-generated on approval
                                </div>
                            </div>
                        </div>

                        <div class="lf-col">
                            <label class="lf-label">Village Bank Description</label>
                            <textarea wire:model.defer="bankDescription" class="lf-input" rows="2" placeholder="Brief description of your village bank"></textarea>
                        </div>

                        <div class="lf-row">
                            <div>
                                <label class="lf-label">Address</label>
                                <input type="text" wire:model.defer="bankAddress" class="lf-input" placeholder="Physical address">
                            </div>
                            <div>
                                <label class="lf-label">Phone <span style="color:#dc3545;">*</span></label>
                                <input type="text" wire:model.defer="bankPhone" class="lf-input" placeholder="+260 9XX XXX XXX">
                                @error('bankPhone') <div class="lf-error">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="lf-col">
                            <label class="lf-label">Bank Email <span style="color:#dc3545;">*</span></label>
                            <input type="email" wire:model.defer="bankEmail" class="lf-input" placeholder="bank@example.com">
                            @error('bankEmail') <div class="lf-error">{{ $message }}</div> @enderror
                        </div>

                        <hr style="border:none;border-top:1px solid #e2e8f0;margin:1.25rem 0;">

                        <h6 style="font-weight:700;color:var(--nd-primary);margin-bottom:0.75rem;font-size:0.9rem;">
                            <i class="fas fa-user-tie"></i> Contact Person
                        </h6>

                        <div class="lf-row">
                            <div>
                                <label class="lf-label">Full Name <span style="color:#dc3545;">*</span></label>
                                <input type="text" wire:model.defer="contactName" class="lf-input" placeholder="John Doe">
                                @error('contactName') <div class="lf-error">{{ $message }}</div> @enderror
                            </div>
                            <div>
                                <label class="lf-label">Member Number</label>
                                <div class="lf-input" style="background:#f1f5f9;color:#64748b;cursor:default;">
                                    <i class="fas fa-lock" style="font-size:0.75rem;"></i> Auto-generated on approval
                                </div>
                            </div>
                        </div>

                        <div class="lf-row">
                            <div>
                                <label class="lf-label">Email <span style="color:#dc3545;">*</span></label>
                                <input type="email" wire:model.defer="contactEmail" class="lf-input" placeholder="john@example.com">
                                @error('contactEmail') <div class="lf-error">{{ $message }}</div> @enderror
                            </div>
                            <div>
                                <label class="lf-label">Phone <span style="color:#dc3545;">*</span></label>
                                <input type="text" wire:model.defer="contactPhone" class="lf-input" placeholder="+260 9XX XXX XXX">
                                @error('contactPhone') <div class="lf-error">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <hr style="border:none;border-top:1px solid #e2e8f0;margin:1.25rem 0;">

                        <h6 style="font-weight:700;color:var(--nd-primary);margin-bottom:0.75rem;font-size:0.9rem;">
                            <i class="fas fa-credit-card"></i> Payment Details
                        </h6>

                        {{-- Payment Methods Info --}}
                        @if($paymentMethods->count())
                            <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:1rem 1.25rem;margin-bottom:1.25rem;">
                                <div style="font-weight:700;font-size:0.88rem;color:#92400e;margin-bottom:0.75rem;">
                                    <i class="fas fa-info-circle"></i> Make payment to any of these accounts:
                                </div>
                                @foreach($paymentMethods as $pm)
                                    <div style="background:#fff;border:1px solid #fde68a;border-radius:8px;padding:0.75rem 1rem;margin-bottom:{{ $loop->last ? '0' : '0.5rem' }};display:flex;align-items:flex-start;gap:0.75rem;">
                                        <i class="fas fa-{{ Str::contains(strtolower($pm->method_name), 'mobile') ? 'mobile-alt' : 'university' }}"
                                           style="color:#D97706;font-size:1.1rem;margin-top:2px;"></i>
                                        <div style="flex:1;">
                                            <div style="font-weight:700;font-size:0.88rem;color:#1e293b;">{{ $pm->method_name }}
                                                @if($pm->provider)
                                                    <span style="font-weight:500;color:#64748b;"> — {{ $pm->provider }}</span>
                                                @endif
                                            </div>
                                            @if($pm->account_name)
                                                <div style="font-size:0.84rem;color:#475569;">Name: <strong>{{ $pm->account_name }}</strong></div>
                                            @endif
                                            @if($pm->account_number)
                                                <div style="font-size:0.84rem;color:#475569;">Account: <strong style="letter-spacing:0.5px;">{{ $pm->account_number }}</strong></div>
                                            @endif
                                            @if($pm->branch)
                                                <div style="font-size:0.84rem;color:#475569;">Branch: {{ $pm->branch }}</div>
                                            @endif
                                            @if($pm->instructions)
                                                <div style="font-size:0.82rem;color:#92400e;margin-top:4px;font-style:italic;">
                                                    <i class="fas fa-lightbulb" style="font-size:0.75rem;"></i> {{ $pm->instructions }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="lf-row">
                            <div>
                                <label class="lf-label">Payment Reference <span style="color:#dc3545;">*</span></label>
                                <input type="text" wire:model.defer="paymentReference" class="lf-input" placeholder="Transaction ID / Receipt No.">
                                @error('paymentReference') <div class="lf-error">{{ $message }}</div> @enderror
                            </div>
                            <div>
                                <label class="lf-label">Proof of Payment <span style="color:#dc3545;">*</span></label>
                                <input type="file" wire:model="proofFile" class="lf-input" accept=".jpg,.jpeg,.png,.pdf" style="padding:0.45rem 0.75rem;">
                                @error('proofFile') <div class="lf-error">{{ $message }}</div> @enderror
                                <small style="color:#94a3b8;font-size:0.78rem;">JPG, PNG or PDF — max 10 MB</small>
                            </div>
                        </div>

                        <div wire:loading wire:target="proofFile" style="color:var(--nd-primary);font-size:0.85rem;margin-bottom:0.75rem;">
                            <i class="fas fa-spinner fa-spin"></i> Uploading file...
                        </div>

                        <button type="submit" class="btn-submit-app" wire:loading.attr="disabled" wire:target="submitApplication">
                            <span wire:loading.remove wire:target="submitApplication">
                                <i class="fas fa-paper-plane"></i> &nbsp;Submit Application
                            </span>
                            <span wire:loading wire:target="submitApplication">
                                <i class="fas fa-spinner fa-spin"></i> &nbsp;Submitting...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== Training Application Modal ===== --}}
    @if($showTrainingModal)
        <div class="landing-modal-overlay" wire:click.self="closeTrainingModal">
            <div class="landing-modal">
                <div class="landing-modal-header">
                    <h3><i class="fas fa-graduation-cap"></i> &nbsp;Apply for Training Program</h3>
                    <button wire:click="closeTrainingModal">&times;</button>
                </div>
                <div class="landing-modal-body">
                    <form wire:submit.prevent="submitTrainingApplication">
                        {{-- Selected Program --}}
                        @if($selectedTrainingId)
                            @php $selProg = $trainingPrograms->firstWhere('id', $selectedTrainingId); @endphp
                            @if($selProg)
                                <div style="background:#eff6ff;border:1px solid #93c5fd;border-radius:10px;padding:0.75rem 1rem;margin-bottom:1.25rem;display:flex;align-items:center;gap:0.75rem;">
                                    <i class="fas fa-graduation-cap" style="color:var(--nd-primary);font-size:1.1rem;"></i>
                                    <div>
                                        <strong style="color:var(--nd-primary);">{{ $selProg->title }}</strong>
                                        @if($selProg->start_date)
                                            <span style="color:#475569;font-size:0.85rem;"> &mdash; {{ $selProg->start_date->format('d M Y') }}</span>
                                        @endif
                                        <div style="font-size:0.84rem;color:#64748b;">{{ $selProg->formattedFee() }}{{ $selProg->duration ? ' &bull; ' . $selProg->duration : '' }}</div>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <h6 style="font-weight:700;color:var(--nd-primary);margin-bottom:0.75rem;font-size:0.9rem;">
                            <i class="fas fa-user"></i> Your Details
                        </h6>

                        <div class="lf-row">
                            <div>
                                <label class="lf-label">Full Name <span style="color:#dc3545;">*</span></label>
                                <input type="text" wire:model.defer="trainingFullName" class="lf-input" placeholder="John Doe">
                                @error('trainingFullName') <div class="lf-error">{{ $message }}</div> @enderror
                            </div>
                            <div>
                                <label class="lf-label">Email <span style="color:#dc3545;">*</span></label>
                                <input type="email" wire:model.defer="trainingEmail" class="lf-input" placeholder="john@example.com">
                                @error('trainingEmail') <div class="lf-error">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="lf-row">
                            <div>
                                <label class="lf-label">Phone <span style="color:#dc3545;">*</span></label>
                                <input type="text" wire:model.defer="trainingPhone" class="lf-input" placeholder="+260 9XX XXX XXX">
                                @error('trainingPhone') <div class="lf-error">{{ $message }}</div> @enderror
                            </div>
                            <div>
                                <label class="lf-label">Village Bank Name</label>
                                <input type="text" wire:model.defer="trainingVillageBank" class="lf-input" placeholder="Your village bank (if any)">
                            </div>
                        </div>

                        <div class="lf-col">
                            <label class="lf-label">Your Role in the Bank</label>
                            <input type="text" wire:model.defer="trainingRoleInBank" class="lf-input" placeholder="e.g. Chairperson, Treasurer, Member">
                        </div>

                        <div class="lf-col">
                            <label class="lf-label">Why do you want to attend?</label>
                            <textarea wire:model.defer="trainingMotivation" class="lf-input" rows="3" placeholder="Brief motivation for attending this training"></textarea>
                        </div>

                        <button type="submit" class="btn-submit-app" wire:loading.attr="disabled" wire:target="submitTrainingApplication">
                            <span wire:loading.remove wire:target="submitTrainingApplication">
                                <i class="fas fa-paper-plane"></i> &nbsp;Submit Application
                            </span>
                            <span wire:loading wire:target="submitTrainingApplication">
                                <i class="fas fa-spinner fa-spin"></i> &nbsp;Submitting...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
