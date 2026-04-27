@props([
    'label',
    'id',
    'name',
    'placeholder' => '',
    'required' => false,
    'autofocus' => false,
    'autocomplete' => 'off',
    'pattern' => null,
    'title' => null,
    'minlength' => null,
])

<div>
    <label for="{{ $id }}" class="block text-sm font-bold text-dark mb-1.5">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>
    <div class="relative">
        @if(isset($prefix))
            <div class="absolute inset-y-0 inset-s-0 flex items-center ps-3 pointer-events-none text-dark">
                {{ $prefix }}
            </div>
        @endif
        <input
            id="{{ $id }}"
            type="password"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            @if($required) required @endif
            @if($autofocus) autofocus @endif
            @if($pattern) pattern="{{ $pattern }}" @endif
            @if($title) title="{{ $title }}" @endif
            @if($minlength) minlength="{{ $minlength }}" @endif
            autocomplete="{{ $autocomplete }}"
            {{ $attributes->merge(['class' => 'w-full py-3 pe-11 border border-dark bg-light text-dark rounded-xl focus:ring focus:ring-dark placeholder-complementary-dark text-sm ' . (isset($prefix) ? 'ps-10' : 'ps-4')]) }}
        >
        <button
            type="button"
            data-toggle-password="{{ $id }}"
            class="absolute inset-y-0 inset-e-0 flex items-center pe-3.5 cursor-pointer text-dark"
        >
            <span class="icon-[material-symbols--visibility] w-5 h-5 hidden" data-icon-show></span>
            <span class="icon-[material-symbols--visibility-off] w-5 h-5 block" data-icon-hide></span>
        </button>
    </div>
</div>
