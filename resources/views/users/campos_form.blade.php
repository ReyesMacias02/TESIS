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

    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
    <div class="mb-4">
        {!! Form::Text('email', null, [
            'class' =>
                'focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow',
            'placeholder' => 'Ingrese el email',
            'required' => true,
        ]) !!}

    </div>

    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Contraseña</label>
    <div class="mb-4">
        {!! Form::Text('passwords', null, [
            'class' =>
                'focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow',
            'placeholder' => 'Ingrese la nueva contraseña si desea editarla',
            'required' => false,
        ]) !!}
    </div>

    <div class="text-center">

    </div>
</div>
