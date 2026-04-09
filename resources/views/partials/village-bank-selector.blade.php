{{-- Village Bank Scope Selector --}}
{{-- Include this partial in any view that uses HasVillageBankScope --}}
<select wire:model="villageBankId" class="z-per-page" title="Filter by Village Bank">
    <option value="">All Village Banks</option>
    @foreach ($this->villageBanks as $vb)
        <option value="{{ $vb->id }}">{{ $vb->name }} ({{ $vb->code }})</option>
    @endforeach
</select>
