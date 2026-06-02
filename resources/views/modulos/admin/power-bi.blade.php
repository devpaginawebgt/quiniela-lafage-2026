<x-admin-layout>
    <div class="w-full">
        @can('admin.ver-reportes')
        <section class="py-4 sm:py-6 mb-6">

            <div class="flex flex-col gap-4 mb-4 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-center gap-3">
                    <span class="icon-[material-symbols--analytics-outline-rounded] w-6 h-6 lg:w-12 lg:h-12 text-dark"></span>
                    <h2 class="font-semibold text-gray-900 text-lg lg:text-4xl">
                        Dashboard
                    </h2>
                </div>

            </div>

            <div class="relative w-full overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm" style="aspect-ratio: 1140 / 541.25;">
                <iframe
                    title="Quiniela Lafage 2026"
                    src="https://app.powerbi.com/view?r=eyJrIjoiZTBjMDJlMmItOTI5ZC00Njk0LTlkMWItMzkxMDNmMTQxMDI3IiwidCI6ImM4YzRhNTQxLWM2YzAtNDI2YS1hNzhiLWZlZDIwYmY3MDRlZiIsImMiOjR9"
                    class="absolute inset-0 w-full h-full"
                    frameborder="0"
                    allowFullScreen="true"
                ></iframe>
            </div>

        </section>
        @endcan
    </div>
</x-admin-layout>
