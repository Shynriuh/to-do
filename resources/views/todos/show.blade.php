@extends('app') <!-- Se importa la plantilla -->

<!-- Se edita desde donde esta este codigo en app (body) -->
@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('todos-update', ['id'=>$todo->id]) }}" method="POST"> <!-- Al hacer un post se va a esa direccion -->
        @method('PATCH')
        @csrf <!-- Seguridad de  laravel -->

            <!-- Si se valida el request -->
            @if (session('success'))
                <h6 class="alert alert-success">{{session('success')}}</h6>
            @endif

            <!-- Si falla el request -->
            @error('title')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror

            <div class="mb-3">
                <label for="title" class="form-label">Titulo de la tarea</label>
                <input type="text" class="form-control" name="title" value="{{ $todo->title }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar nueva tarea</button>
        </form>

    </div>
@endsection