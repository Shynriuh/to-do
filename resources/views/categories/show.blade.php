@extends('app')

@section('content')

    <div class="container w-25 border p-4 my-4">
        <div class="row mx-auto">
            <form action="{{ route('categories.update', ['category'=>$category->id]) }}" method="POST"> <!-- Al hacer un post se va a esa direccion -->
                @method('PATCH')
                @csrf <!-- Seguridad de  laravel -->

                <!-- Si se valida el request -->
                @if (session('success'))
                    <h6 class="alert alert-success">{{session('success')}}</h6>
                @endif

                <!-- Si falla el request -->
                @error('name')
                    <h6 class="alert alert-danger">{{ $message }}</h6>
                @enderror

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la categoria</label>
                    <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label">Color de la categoria</label>
                    <input type="color" class="form-control" name="color">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar categoria</button>
            </form>

            <div>
                <!-- Si hay todos -->
                @if ($category->todos->count() > 0)
                    @foreach ($category->todos as $todo)
                        <div class="row py-1">
                            <div class="col-md-9 d-flex align-items-center">
                                <a href="{{ route('todos-edit', ['id'=>$todo->id]) }}">{{ $todo->title }}</a>
                            </div>
                        </div>

                        <!-- Boton para eliminar un todo desde aqui -->
                        <div class="col-md-3 d-flex justify-content-end">
                            <form action="{{ route('todos-destroy', [$todo->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button>Eliminar</button>
                            </form>
                        </div>
                    @endforeach
                @else
                    No hay tareas para esta categoria.
                @endif
            </div>

        </div>
    </div>

@endsection()