<div class="flex justify-center items-center">
    <a href="{{route('setting.form', $row->setting_id)}}">
        <x-ui.button class="bg-blue-500 text-white hover:bg-blue-400"
                        variant="circle"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                        wire:click="$emit('edit',{{$row->setting_id}})">
            <span class="flex items-center fi-rr-pencil"></span>
        </x-ui.button>
    </a>
    @if($row->setting_removable)
        <x-ui.button variant="circle" class="bg-red-500 text-white hover:bg-red-400"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"
                        wire:click="$emit('confirmDestroy', {{$row->setting_id}})">
            <span class="flex items-center fi-rr-trash"></span>
        </x-ui.button>
    @endif
</div>
