@props([
    'label',
    'id',
    'name',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'icon' => null,
    'required' => false,
    'autofocus' => false,
    'maxlength' => null,
    'minlength' => null,
    'pattern' => null,
    'title' => null,
])

<div class="flex flex-col gap-2 mb-6">
    <label for="{{ $id }}" class="font-medium">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>

    <div class="flex items-center justify-center gap-4">
        @if($icon)
            <div class="flex items-center pointer-events-none">
                <span class="{{ $icon }} w-6 h-6 lg:w-7 lg:h-7 text-base"></span>
            </div>
        @endif
        <input
            id="{{ $id }}"
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            @if($required) required @endif
            @if($autofocus) autofocus @endif
            @if($maxlength) maxlength="{{ $maxlength }}" @endif
            @if($minlength) minlength="{{ $minlength }}" @endif
            @if($pattern) pattern="{{ $pattern }}" @endif
            @if($title) title="{{ $title }}" @endif
            {{ $attributes->merge(['class' => 'w-full px-2 py-2 bg-transparent border-0 border-complementary-dark border-b-2 placeholder-complementary-dark focus:border-dark text-base transition-all ease-in-out duration-300']) }}
        >
    </div>
</div>
