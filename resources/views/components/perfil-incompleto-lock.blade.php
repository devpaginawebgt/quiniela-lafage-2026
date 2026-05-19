<div class="lg:px-8 bg-secondary-light rounded-t-4xl h-full flex-1">
    <div class="w-full max-w-md mx-auto flex flex-col items-center text-center px-4 py-16">
        <span class="icon-[material-symbols--lock-outline] w-20 h-20 text-dark mb-8"></span>

        <h2 class="text-xl lg:text-3xl font-bold text-dark mb-4 leading-tight">
            Completa tu perfil para acceder a esta sección
        </h2>

        <p class="text-sm lg:text-base text-zinc-600 mb-8">
            Necesitas completar tu información si deseas participar en el ranking, ver los premios o registrar tus pronósticos.
        </p>

        <a
            href="{{ route('web.users.perfil.completar') }}"
            class="w-full bg-secondary text-light font-bold rounded-full px-6 py-3 hover:brightness-110 focus:ring-3 focus:ring-dark flex items-center justify-center gap-3 transition-all duration-200"
        >
            <span class="icon-[material-symbols--arrow-forward] w-6 h-6"></span>
            Completar perfil
        </a>
    </div>
</div>
