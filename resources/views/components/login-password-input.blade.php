@props([
    'label',
    'id',
    'name',
    'placeholder' => '',
    'icon' => null,
    'required' => false,
    'autofocus' => false,
    'autocomplete' => 'off',
    'pattern' => null,
    'title' => null,
    'minlength' => null,
    'maxlength' => null,
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
        <div class="relative flex-1">
            <input
                type="password"
                id="{{ $id }}"
                name="{{ $name }}"
                placeholder="{{ $placeholder }}"
                autocomplete="{{ $autocomplete }}"
                @if($required) required @endif
                @if($autofocus) autofocus @endif
                @if($pattern) pattern="{{ $pattern }}" @endif
                @if($title) title="{{ $title }}" @endif
                @if($minlength) minlength="{{ $minlength }}" @endif
                @if($maxlength) maxlength="{{ $maxlength }}" @endif
                {{ $attributes->merge(['class' => 'w-full px-2 pe-12 py-2 bg-transparent border-0 border-b-2 border-complementary-dark placeholder-complementary-dark focus:ring-0 focus:border-dark text-base']) }}
            >
            <button
                type="button"
                data-toggle-password="{{ $id }}"
                class="absolute inset-y-0 inset-e-0 flex items-center cursor-pointer text-dark hover:text-dark px-2"
            >
                <span class="icon-[material-symbols--visibility] w-5 h-5 hidden" data-icon-show></span>
                <span class="icon-[material-symbols--visibility-off] w-5 h-5 block" data-icon-hide></span>
            </button>
        </div>
    </div>
</div>
