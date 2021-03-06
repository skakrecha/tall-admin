<main class="w-full flex-grow px-3">
    <section class="content overflow-x-scroll rounded-lg overflow-y-scroll h-full mx-auto py-5 px-5 min-h-screen">
        <div class="pb-3">
            <x-ui.breadcrumb :breadcrumbs="$breadcrumbs"></x-ui.breadcrumb>
        </div>
        <div class="mb-3">
            <div class="mb-5 flex flex-grow flex-col md:flex-row items-center justify-center md:justify-between">
                <h4 class="heading mb-3 md:mb-0">User Management</h4>

                <div>
                    <x-ui.button wire:click="$emit('create')"
                                 variant="normal" class="mb-3 bg-indigo-500 hover:bg-indigo-400">Create</x-ui.button>
                    <x-ui.button variant="normal" class="btn bg-indigo-500 hover:bg-indigo-400 text-white mb-3 mx-1"
                                    wire:click="$emit('refreshDt', true)">Refresh
                    </x-ui.button>
                </div>
            </div>

           <div>
               @if (session()->has('message'))
                   <x-ui.alert>
                       {{ session('message') }}
                   </x-ui.alert>
               @endif

               @livewire("user.user-table")

               @include('livewire.user._user-form')
           </div>

        </div>
    </section>
</main>

@push("scripts")
    @include("includes._toast-scripts")

    @include("includes._dt-scripts",['table' => 'user.user-table'])
@endpush

