<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-gray-50 border-b border-gray-200">
            <div class="mx-16 shrink-0 flex items-center">
                <x-application-logo class="block h-10 w-auto fill-current text-gray-100" />
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="shadow" >
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ __('México | Estados Unidos | Canadá 2026') }}
                </h2>
            </div>
        </header>

        <div class="max-w-screen-2xl my-6 mx-auto sm:px-6 lg:px-8" id="selecciones-container">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg xl:px-10 px-2 pb-11">
                <div class="px-6 pb-6 bg-white border-b border-gray-200 flex items-center justify-center">
                    <h5 class="text-3xl text-center font-bold my-8">Participantes Registrados</h5>
                </div>

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg mx-auto p-2">
                    <table class="w-full text-sm text-left text-gray-500" id="participantes-table">
                        <thead class="text-xs text-gray-100 uppercase " style="background-color: #000">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    No. Participante
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Nombres
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Apellidos
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Pais
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participantes as $participante)
                                <tr class="bg-white border-b">
                                    <th scope="row"
                                        class="py-4 px-6 font-bold text-lg text-gray-800 whitespace-nowrap">
                                        {{ $participante->id }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $participante->nombres }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $participante->apellidos }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $participante->pais }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <img src="{{ asset('images/panda_argentina.png') }}" alt="PORTADA-2022"
                style="width: 10%; position: fixed; z-index: 10000; right: 0px; bottom: 0;" class="">
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#participantes-table').DataTable({
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
                },
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5'
                ]
            });
        });
    </script>
</body>

</html>
