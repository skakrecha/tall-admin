<div>
    <x-ui.modal id="modal_form" wire:model="showModalForm" size="md" :title="$updateMode ? 'Edit' : 'Create'">
        <form action="#" wire:submit.prevent="save" class="p-3">
            <x-input.validation-error/>

            <x-input.form-group label="Title" key="slider_title" model="slider.slider_title">
                <x-input.text id="Title" wire:model.defer="slider.slider_title"></x-input.text>
            </x-input.form-group>
            <x-input.form-group label="Desc" key="slider_desc" model="slider.slider_desc">
                <x-input.text id="Desc" wire:model.defer="slider.slider_desc"></x-input.text>
            </x-input.form-group>
            <x-input.form-group label="Image" key="slider_image" model="slider.slider_image">
                <x-input.filepond data-event-name="resetFilePond" wire:model="image"></x-input.filepond>
            </x-input.form-group>
            <x-input.form-group label="Status" key="slider_active" model="slider.slider_active">
                <x-input.radio method="select_slider_active" wire:model.defer="slider.slider_active"
                               :select2="false"></x-input.radio>
            </x-input.form-group>


            <div class="md:flex place-content-end py-4">
                <x-ui.button
                    x-on:click="$wire.showModalForm = false"
                    class="bg-red-500 hover:bg-red-400 text-white hover:bg-blue-400">
                    Tutup
                </x-ui.button>
                <x-ui.button type="submit" class="bg-indigo-500 hover:bg-indigo-400 text-white hover:bg-blue-400"
                             wire:click="save">
                    {{$updateMode ? "Simpan Perubahan" : "Simpan"}}
                </x-ui.button>
            </div>
        </form>
    </x-ui.modal>
</div>

