<div>
    <div class="container-fluid">
        <br>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="text-green font-weight-bold mb-0">
                    <i class="fas fa-users-cog mr-2"></i>User Role Assignment
                </h2>
                <small class="text-muted">Assign and manage roles for users</small>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">User Roles</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        {{-- Alerts --}}
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-1"></i> {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        {{-- Main Card --}}
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center">
                    <div class="input-group input-group-sm" style="width: 300px;">
                        <input type="text" class="form-control" placeholder="Search by name, staff no or email..." wire:model.debounce.300ms="search">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Name</th>
                            <th>Staff No</th>
                            <th>Email</th>
                            <th>Current Roles</th>
                            <th class="text-center" style="width: 120px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $key => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $key }}</td>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->staff_no ?? '-' }}</td>
                                <td>{{ $user->email ?? '-' }}</td>
                                <td>
                                    @forelse($user->roles as $role)
                                        <span class="badge badge-success mr-1 mb-1" style="font-size: 0.8rem;">
                                            {{ $role->name }}
                                            <a href="#" wire:click.prevent="removeRoleFromUser({{ $user->id }}, {{ $role->id }})"
                                               class="text-white ml-1" title="Remove role"
                                               onclick="return confirm('Remove {{ $role->name }} from {{ $user->name }}?')">
                                                <i class="fas fa-times" style="font-size: 0.65rem;"></i>
                                            </a>
                                        </span>
                                    @empty
                                        <span class="text-muted"><i>No roles assigned</i></span>
                                    @endforelse
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-xs btn-outline-primary" wire:click="openRoles({{ $user->id }})" data-toggle="modal" data-target="#userRolesModal" title="Manage Roles">
                                        <i class="fas fa-user-tag mr-1"></i> Roles
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($users->hasPages())
                <div class="card-footer bg-white">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- ==================== USER ROLES MODAL ==================== --}}
    <div class="modal fade" id="userRolesModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-user-tag mr-1"></i> Assign Roles — {{ $editUserName }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    @if(count($availableRoles) > 0)
                        <p class="text-muted mb-3">Select the roles to assign to this user:</p>
                        @foreach($availableRoles as $role)
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input"
                                       id="role_{{ $role['id'] }}"
                                       value="{{ $role['id'] }}"
                                       wire:model="selectedRoles">
                                <label class="custom-control-label" for="role_{{ $role['id'] }}">
                                    <strong>{{ $role['name'] }}</strong>
                                    @if($role['description'])
                                        <br><small class="text-muted">{{ $role['description'] }}</small>
                                    @endif
                                </label>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-info-circle fa-2x mb-2 d-block"></i>
                            No roles available. Create some roles first.
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click="syncRoles">
                        <i class="fas fa-save mr-1"></i> Save Roles
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Close modals on Livewire event --}}
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('closeModal', function (modalId) {
                $('#' + modalId).modal('hide');
            });
        });
    </script>
</div>
