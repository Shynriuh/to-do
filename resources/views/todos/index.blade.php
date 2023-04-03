@extends('app') <!-- Se importa la plantilla -->

<!-- Se edita desde donde esta este codigo en app (body) -->
@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('todos') }}" method="POST"> <!-- Al hacer un post se va a esa direccion -->
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
                <input type="text" class="form-control" name="title">
            </div>

            <!-- Categorias -->
            <label for="category_id" class="form-label">Categoria de la tarea</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">Crear nueva tarea</button>
        </form>

        <div>
            @foreach ($todos as $todo)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-item-center">
                        <a href="{{route('todos-edit', ['id'=>$todo->id] )}}">{{ $todo->title }}</a>
                    </div>

                    <div class="col-md-3 d-flex justify-content-end">
                        <!-- Se usa metodo POST porque no hay Delete xd -->
                        <form action="{{ route('todos-destroy', [$todo->id]) }}" method="POST">
                            @method('DELETE') <!-- Se indica a laravel que es DELETE -->
                            @csrf
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection