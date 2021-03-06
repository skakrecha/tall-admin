@props(['placeholder' => 'Pilih salah satu', 'options', 'value', 'text'])
<select {!! $attributes->merge(['class' => 'mt-1 block w-full rounded-md dark:bg-gray-600 bg-gray-200 border-transparent
                                            focus:border-indigo-400 focus:bg-gray-200 dark:focus:bg-gray-800 focus:ring-0
                                            text-sm text-gray-700 dark:text-gray-300']) !!}>
    <option value="">{{$placeholder}}</option>
    @foreach($options as $option)
        <option
            value="{{ $option[$value] }}" {{ $option[$value] == $value ? 'selected' : '' }}>{{ $option[$text] }}</option>
    @endforeach
</select>

