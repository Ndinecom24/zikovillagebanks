<div>

@can('manage-training')
<div class="nd-page">
    {{-- â•â•â•â•â•â•â• HERO â•â•â•â•â•â•â• --}}
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li class="active">Training Programs</li>
            </ul>
            <div class="nd-hero-title">
                <h1><i class="fas fa-graduation-cap"></i>Training Programs</h1>
                <p class="nd-hero-sub">Create and manage training courses for village bank members</p>
            </div>
            <button wire:click="openCreate" class="nd-hero-btn">
                <i class="fas fa-plus"></i> New Program
            </button>
        </div>
    </div>

    {{-- â•â•â•â•â•â•â• CONTENT â•â•â•â•â•â•â• --}}
    <div class="nd-content">
        @if(session()->has('success'))
            <div class="tp-alert tp-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        {{-- â”€â”€ Programs Table Card â”€â”€ --}}
        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-chalkboard-teacher"></i> All Programs</h3>
                <div class="nd-toolbar">
                    <div class="nd-search">
                        <i class="fas fa-search"></i>
                        <input type="text" wire:model.debounce.300ms="search" placeholder="Search programs, trainers...">
                    </div>
                    <select wire:model="filterStatus" class="nd-select">
                        <option value="">All Status</option>
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="closed">Closed</option>
                        <option value="completed">Completed</option>
                    </select>
                    <select wire:model="perPage" class="nd-select" style="width:72px;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>

            <div style="overflow-x:auto;">
                <table class="nd-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Program</th>
                            <th>Category</th>
                            <th>Trainer</th>
                            <th>Date</th>
                            <th>Fee</th>
                            <th>Applicants</th>
                            <th>Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($programs as $program)
                            <tr>
                                <td style="color:var(--nd-faint);font-weight:600;">
                                    {{ $loop->iteration + ($programs->currentPage() - 1) * $programs->perPage() }}
                                </td>
                                <td>
                                    <strong>{{ $program->title }}</strong>
                                    @if($program->is_featured)
                                        <span class="nd-badge tp-badge-featured" style="margin-left:4px;"><i class="fas fa-star" style="font-size:.52rem;margin-right:2px;"></i>Featured</span>
                                    @endif
                                    @if($program->location)
                                        <br><span style="font-size:.76rem;color:var(--nd-faint);"><i class="fas fa-map-marker-alt" style="margin-right:3px;"></i>{{ $program->location }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="tp-badge-cat" style="background:{{ $program->categoryColor() }};">
                                        {{ $program->categoryLabel() }}
                                    </span>
                                </td>
                                <td>
                                    @if($program->trainer)
                                        <span style="font-size:.84rem;">{{ $program->trainer }}</span>
                                    @else
                                        <span style="color:var(--nd-faint);">â€”</span>
                                    @endif
                                </td>
                                <td>
                                    @if($program->start_date)
                                        <span style="font-size:.84rem;">{{ $program->start_date->format('d M Y') }}</span>
                                        @if($program->end_date)
                                            <br><span style="font-size:.72rem;color:var(--nd-faint);">to {{ $program->end_date->format('d M Y') }}</span>
                                        @endif
                                    @else
                                        <span style="color:var(--nd-faint);">TBD</span>
                                    @endif
                                </td>
                                <td><span class="tp-amount">{{ $program->formattedFee() }}</span></td>
                                <td>
                                    <span class="tp-applicant-count">
                                        <i class="fas fa-users" style="color:var(--tp-cyan);font-size:.72rem;"></i>
                                        {{ $program->applications_count }}
                                        @if($program->max_participants)
                                            <span style="color:var(--nd-faint);font-weight:400;">/ {{ $program->max_participants }}</span>
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    @if($program->status === 'draft')
                                        <span class="nd-badge tp-badge-draft">Draft</span>
                                    @elseif($program->status === 'published')
                                        <span class="nd-badge tp-badge-published">Published</span>
                                    @elseif($program->status === 'closed')
                                        <span class="nd-badge tp-badge-closed">Closed</span>
                                    @else
                                        <span class="nd-badge tp-badge-completed">Completed</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="tp-actions" style="justify-content:flex-end;">
                                        <button wire:click="openEdit({{ $program->id }})" class="tp-act tp-act-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @if($program->status === 'draft')
                                            <button wire:click="toggleStatus({{ $program->id }}, 'published')" class="tp-act tp-act-publish" title="Publish">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        @elseif($program->status === 'published')
                                            <button wire:click="toggleStatus({{ $program->id }}, 'closed')" class="tp-act tp-act-close" title="Close Registration">
                                                <i class="fas fa-lock"></i>
                                            </button>
                                        @endif
                                        <button wire:click="confirmDelete({{ $program->id }})" class="tp-act tp-act-delete" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    <div class="nd-empty">
                                        <i class="fas fa-graduation-cap"></i>
                                        No training programs yet. Click "New Program" to get started.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($programs->hasPages())
                <div class="nd-footer">
                    <span>Showing {{ $programs->firstItem() }}â€“{{ $programs->lastItem() }} of {{ $programs->total() }}</span>
                    {{ $programs->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- â•â•â•â•â•â•â• CREATE / EDIT MODAL â•â•â•â•â•â•â• --}}
@if($showModal)
    <div class="nd-overlay" wire:click.self="$set('showModal', false)">
        <div class="nd-modal tp-modal-lg">
            <div class="nd-modal-head">
                <h5>
                    <i class="fas fa-{{ $editId ? 'edit' : 'plus-circle' }}"></i>
                    {{ $editId ? 'Edit Training Program' : 'New Training Program' }}
                </h5>
                <button class="nd-modal-close" wire:click="$set('showModal', false)">&times;</button>
            </div>
            <div class="nd-modal-body">
                <form wire:submit.prevent="save">
                    {{-- Title (full width) --}}
                    <div style="margin-bottom:1rem;">
                        <label class="tp-label">Program Title <span class="req">*</span></label>
                        <input type="text" wire:model.defer="title" class="tp-input" placeholder="e.g. Village Bank Financial Management Training">
                        @error('title') <div class="tp-error">{{ $message }}</div> @enderror
                    </div>

                    {{-- Category + Trainer --}}
                    <div class="tp-form-grid" style="margin-bottom:1rem;">
                        <div>
                            <label class="tp-label">Category <span class="req">*</span></label>
                            <select wire:model.defer="category" class="tp-input">
                                <option value="general">General</option>
                                <option value="finance">Finance & Accounting</option>
                                <option value="governance">Governance & Compliance</option>
                                <option value="management">Bank Management</option>
                                <option value="leadership">Leadership</option>
                            </select>
                            @error('category') <div class="tp-error">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="tp-label">Trainer / Facilitator</label>
                            <input type="text" wire:model.defer="trainer" class="tp-input" placeholder="Name of trainer">
                        </div>
                    </div>

                    {{-- Description (full width) --}}
                    <div style="margin-bottom:1rem;">
                        <label class="tp-label">Description</label>
                        <textarea wire:model.defer="description" class="tp-input" rows="3" placeholder="What participants will learn, objectives, topics..."></textarea>
                        @error('description') <div class="tp-error">{{ $message }}</div> @enderror
                    </div>

                    {{-- Location + Duration --}}
                    <div class="tp-form-grid" style="margin-bottom:1rem;">
                        <div>
                            <label class="tp-label">Location / Venue</label>
                            <input type="text" wire:model.defer="location" class="tp-input" placeholder="e.g. Lusaka Conference Center">
                        </div>
                        <div>
                            <label class="tp-label">Duration</label>
                            <input type="text" wire:model.defer="duration" class="tp-input" placeholder="e.g. 3 days, 1 week">
                        </div>
                    </div>

                    {{-- Start Date + End Date + Fee --}}
                    <div class="tp-form-third" style="margin-bottom:1rem;">
                        <div>
                            <label class="tp-label">Start Date</label>
                            <input type="date" wire:model.defer="startDate" class="tp-input">
                            @error('startDate') <div class="tp-error">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="tp-label">End Date</label>
                            <input type="date" wire:model.defer="endDate" class="tp-input">
                            @error('endDate') <div class="tp-error">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="tp-label">Fee (ZMW)</label>
                            <input type="number" wire:model.defer="fee" class="tp-input" min="0" step="0.01" placeholder="0 = Free">
                        </div>
                    </div>

                    {{-- Max Participants + Cover Image --}}
                    <div class="tp-form-grid" style="margin-bottom:1rem;">
                        <div>
                            <label class="tp-label">Max Participants</label>
                            <input type="number" wire:model.defer="maxParticipants" class="tp-input" min="1" placeholder="Leave empty for unlimited">
                        </div>
                        <div>
                            <label class="tp-label">Cover Image</label>
                            <input type="file" wire:model="coverImage" class="tp-input" accept="image/*" style="padding:.35rem .65rem;">
                            @error('coverImage') <div class="tp-error">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- Status + Sort Order + Featured --}}
                    <div class="tp-form-third" style="margin-bottom:1rem;">
                        <div>
                            <label class="tp-label">Status</label>
                            <select wire:model.defer="status" class="tp-input">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="closed">Closed</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div>
                            <label class="tp-label">Sort Order</label>
                            <input type="number" wire:model.defer="sortOrder" class="tp-input" min="0">
                        </div>
                        <div>
                            <label class="tp-label" style="margin-bottom:.55rem;">Featured</label>
                            <div class="tp-switch">
                                <input type="checkbox" wire:model.defer="isFeatured" id="tpFeaturedSwitch">
                                <span>Mark as Featured</span>
                            </div>
                        </div>
                    </div>

                    <div class="nd-modal-foot" style="border-top:none;padding:0;margin-top:.5rem;">
                        <button type="button" class="nd-btn-cancel" wire:click="$set('showModal', false)">Cancel</button>
                        <button type="submit" class="tp-btn-save">
                            <i class="fas fa-save" style="margin-right:4px;"></i> {{ $editId ? 'Update Program' : 'Create Program' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

{{-- â•â•â•â•â•â•â• DELETE MODAL â•â•â•â•â•â•â• --}}
@if($confirmDeleteId)
    <div class="nd-overlay" wire:click.self="cancelDelete">
        <div class="nd-modal tp-modal-sm">
            <div class="nd-modal-head nd-modal-head-red">
                <h5><i class="fas fa-exclamation-triangle"></i> Delete Program</h5>
                <button class="nd-modal-close" wire:click="cancelDelete">&times;</button>
            </div>
            <div class="nd-modal-body" style="text-align:center;padding:1.5rem;">
                <i class="fas fa-trash-alt" style="font-size:2.5rem;color:var(--nd-red);margin-bottom:.75rem;display:block;"></i>
                <h6 style="font-weight:700;margin-bottom:.5rem;">Are you sure?</h6>
                <p style="font-size:.84rem;color:var(--nd-muted);margin-bottom:0;">This will permanently delete this program and all related applications.</p>
            </div>
            <div class="nd-modal-foot">
                <button class="nd-btn-cancel" wire:click="cancelDelete">Cancel</button>
                <button class="tp-btn-delete" wire:click="delete">
                    <i class="fas fa-trash" style="margin-right:4px;"></i> Delete
                </button>
            </div>
        </div>
    </div>
@endif
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
