@props(['placeholder' => 'Pilih salah satu', 'options', 'value', 'text'])

<!-- custom-select2 -->
<div class="relative w-full"
     wire:key="{!! $attributes->get('id') !!}"
     x-on:click.outside="show = false"
     x-on:click.away="show = false"
     x-init="console.log('init select2');
        $watch('search', (value)=>{
            {{--jika pencarian '' maka wire:model ''--}}
         if (value == ''){
             selected = '';
         }
        });
        $watch('selected', (value)=>{
           let x = options.filter(item=>{
                 return item.{!! $value !!} == value;
           });

           if (x.length){
               search = x[0].{!! $text !!};
           }else{
               search = '';
           }
        });
        if (options.length > 0){
            let x = options.filter((item)=>{
                 return item.{!! $value !!} == selected;
             });
             if (x.length){
                 search = x[0].{!! $text !!};
             }else{
                 search = '';
             }
        }"
     x-data="{
        options: @js($options),
        show:false,
        search:'',
        selected: @entangle($attributes->wire('model')),
        disabled:false,
        get filteredOptions() {
            if(this.search == '' || this.search == null){
                return this.options;
            }
            if (this.options.length > 0){
               return this.options.filter((item) => {
                  if (this.search === '') {
                    return this.options;
                  }else{
                    return item.{{$text}}.toString().toLowerCase().includes(this.search.toString().toLowerCase());
                  }
               });
            }
        }
     }">
    <input type="text"
           x-model="search"
           autocomplete="off"
           x-on:click="show = true; search = '';"
           id="{!! $attributes->get('id') !!}"
           class="mt-1 block w-full rounded-md dark:bg-gray-600 bg-gray-200 border-transparent
                      focus:border-indigo-400 focus:bg-gray-200 dark:focus:bg-gray-800 focus:ring-0
                      text-sm text-gray-700 dark:text-gray-200">

    <input type="hidden"
           x-model="selected"
           x-on:click="show = true; search = '';">

    <button x-show="!show"
            x-on:click="show = true"
            x-on:focus="show = true"
            type="button"
            class="absolute right-2 top-2">
        <span class="fi-rr-caret-down text-gray-700 dark:text-gray-300"></span>
    </button>

    <ul x-show="show"
        x-transition
        :class="filteredOptions.length > 3 ? 'h-40' : 'h-'+filteredOptions.length * 10"
        class="absolute inset-0 top-10 bg-gray-100 dark:bg-black z-50
                cursor-pointer rounded-md
                overflow-visible overflow-y-scroll overflow-x-hidden">
        <template x-for="item in filteredOptions">
            <li class="text-xs text-gray-700 dark:text-gray-300 border-b border-gray-300 dark:border-gray-700
                       hover:bg-gray-100 dark:hover:bg-gray-900 shadow-sm z-20 p-3"
                x-on:click="search = item.{!! $text !!};selected = item.{!! $value !!};show = false;"
                x-text="item.{{$text}}">
            </li>
        </template>
    </ul>
</div>
