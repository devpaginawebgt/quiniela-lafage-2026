@props([
    'id'    => 'select',
    'name'  => 'select',
    'label' => null,
])

<div class="w-full flex items-center gap-2 pb-1">
    @if($label)
        <label for="{{ $id }}" class="text-dark font-medium whitespace-nowrap">{{ $label }}</label>
    @endif
    <div class="w-full relative flex items-center border-b border-complementary-dark text-zinc-600 hover:text-dark">
        <select
            id="{{ $id }}"
            name="{{ $name }}"
            style="-webkit-appearance: none; -moz-appearance: none; appearance: none; background-image: none;"
            {{ $attributes->merge(['class' => 'form-select-custom bg-transparent font-bold cursor-pointer focus:outline-none border-none w-full pr-6']) }}
        >
            {{ $slot }}
        </select>
        <span class="icon-[material-symbols--arrow-downward-rounded] w-6 h-6"></span>
    </div>
</div>
