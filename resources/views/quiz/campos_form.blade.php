<div>
    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Nombre</label>
    <div class="mb-4">
        {!! Form::Text('name', null, [
            'class' =>
                'focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow',
            'placeholder' => 'Ingrese el nombre',
            'required' => true,
        ]) !!}

    </div>

    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Url</label>
    <div class="mb-4">
        {!! Form::Text('descripcion', null, [
            'class' =>
                'focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow',
            'placeholder' => 'Ingrese la url de la encuesta',
            'required' => true,
        ]) !!}

    </div>

    @php
        use Carbon\Carbon;
        $desde = isset($user->desde) ? Carbon::parse($user->desde)->format('Y-m-d') : null;
        $hasta = isset($user->hasta) ? Carbon::parse($user->hasta)->format('Y-m-d') : null;
    @endphp
    <!-- Campo de Fecha Desde -->
    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Desde</label>
    <div class="mb-4">
        {!! Form::date('desde', $desde ?? null, [
            'class' =>
                'focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow',
            'required' => true,
        ]) !!}
    </div>

    <!-- Campo de Fecha Hasta -->
    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Hasta</label>
    <div class="mb-4">
        {!! Form::date('hasta', $hasta ?? null, [
            'class' =>
                'focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow',
            'required' => true,
        ]) !!}
    </div>

    <!-- Campo de Selección Estado -->
    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Estado</label>
    <div class="mb-4">
        {!! Form::select('estado', [1 => 'Activa', 0 => 'Desactivada'], null, [
            'class' =>
                'focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow',
            'placeholder' => 'Seleccione el estado',
            'required' => true,
        ]) !!}
    </div>


    <div class="text-center">

    </div>
</div>
