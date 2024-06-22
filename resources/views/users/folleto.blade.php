@extends('layouts.demo')
@section('title', 'Crear Usuarios')
@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')

    <div class="max-lg p-6 h-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $folleto->name }}
                ARTechComputer</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Aqui ingrese el folleto que se va a poder Descargar
            desde la aplicacion movil.</p>
        {!! Form::open(['route' => 'users.store_folleto', 'method' => 'POST', 'files' => 'true']) !!}
        <div class="flex items-center justify-center w-full">
            <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                            upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">pdf o word (MAX. 3Mb)</p>
                </div>
                <input id="dropzone-file" type="file" name="folleto" accept=".pdf, .doc, .docx" class="hidden" />
            </label>
        </div>

        {!! Form::submit('Actualizar', [
            'class' =>
                'inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85',
        ]) !!}
        {!! Form::close() !!}
        @if ($folleto->descripcion)
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/4 sm:flex-none xl:mb-0 xl:w-1/2 mt-6">
                <a class="inline-block w-full xl:w-1/2 px-6 py-3 my-4 text-xs font-bold text-center text-white uppercase align-middle transition-all ease-in border-0 rounded-lg select-none shadow-soft-md bg-150 bg-x-25 leading-pro bg-gradient-to-tl from-purple-700 to-pink-500 hover:shadow-soft-2xl hover:scale-102"
                    target="_blank" href="{{ $folleto->descripcion }}"">Ver Folleto</a>
            </div>
        @endif


    </div>

@endsection
