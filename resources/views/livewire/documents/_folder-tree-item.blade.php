{{-- Recursive folder tree item --}}
<div class="dm-tree-item {{ $currentFolderId == $folder->id ? 'dm-tree-active' : '' }}" style="padding-left: {{ 12 + ($level * 16) }}px;">
    <div wire:click="openFolder({{ $folder->id }})" class="dm-tree-label">
        <i class="fas {{ $folder->children->count() > 0 ? 'fa-folder' : 'fa-folder' }} mr-1"
           style="color: {{ $currentFolderId == $folder->id ? '#14984f' : '#FFB223' }}; font-size: 0.82rem;"></i>
        <span>{{ Str::limit($folder->name, 22) }}</span>
        @if($folder->documents()->count() > 0)
            <span class="dm-tree-count">{{ $folder->documents()->count() }}</span>
        @endif
    </div>
</div>

@if($folder->childrenRecursive && $folder->childrenRecursive->count() > 0)
    @foreach($folder->childrenRecursive as $child)
        @include('livewire.documents._folder-tree-item', ['folder' => $child, 'level' => $level + 1])
    @endforeach
@endif
