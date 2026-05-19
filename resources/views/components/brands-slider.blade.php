@props([
    'brands' => collect([]),
    // 'title' => 'Nuestros Patrocinadores',
])

@if($brands->isNotEmpty())
    @php 
        $sliderId = 'brands-swiper-' . uniqid();
        $duplicate = $brands->count() < 5;
    @endphp

    {{-- <h6 class="text-xl text-center font-semibold mb-4">{{ $title }}</h6> --}}

    <div class="swiper {{ $sliderId }} w-full max-w-xl">
        <div class="swiper-wrapper py-2">

            @if ($duplicate)    
                @for($i = 0; $i < 3; $i++)
                    @foreach($brands as $brand)
                        <div class="swiper-slide">
                            <div class="bg-light rounded-xl p-4 flex items-center justify-center h-full shadow-md shadow-zinc-400">
                                <img
                                    src="{{ asset($brand->image) }}"
                                    alt="{{ $brand->name }}"
                                    class="w-full max-w-35 aspect-6/3 object-contain"
                                >
                            </div>
                        </div>
                    @endforeach
                @endfor
            @else
                @foreach($brands as $brand)
                    <div class="swiper-slide">
                        <div class="bg-light rounded-xl p-4 flex items-center justify-center h-full shadow-md shadow-zinc-400">
                            <img
                                src="{{ asset($brand->image) }}"
                                alt="{{ $brand->name }}"
                                class="w-full max-w-35 aspect-6/3 object-contain"
                            >
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="{{ $sliderId }}-pagination mt-3 flex justify-center"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.{{ $sliderId }}', {
                slidesPerView: 2,
                spaceBetween: 16,
                loop: true,
                centeredSlides: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.{{ $sliderId }}-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: { slidesPerView: 3 },
                    // 1520: { slidesPerView: 4 },
                },
            });
        });
    </script>
@endif
