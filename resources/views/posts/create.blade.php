@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Crear artículo</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Título*</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>

                        <div class="form-group">
                            <label>Imagen</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                        <div class="form-group">
                            <label>Contenido*</label>
                            <textarea class="form-control" name="body" rows="6" required> </textarea>
                        </div>
                        <div class="form-group">
                            <label>Contenido embebido</label>
                            <textarea class="form-control" name="iframe"> </textarea>
                        </div>
                        <div class="form-group">
                            @csrf
                            <input type="submit" value="Enviar" class="btn btn-primary">
                        </div>
                        
                    </form>
                    <br>
                    <a href="{{ route('posts.index') }}">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection