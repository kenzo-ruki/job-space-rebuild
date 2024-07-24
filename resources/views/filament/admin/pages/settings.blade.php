<x-filament::page>
    
    <form wire:submit="update">
        {{ $this->form }}
        
        <button type="submit">
            Submit
        </button>
    </form>

</x-filament::page>