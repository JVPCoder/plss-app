<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>PLSS | Atendimento de Chamado</title>
</head>
<body>
    <h1 class="mt-5 text-center">Atendimento de chamado</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>

        @endif
    </div>


    <div class="container">
        <form method="post" action="{{route('calling.update', ['calling' => $calling])}}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="title">Título:</label>
                <input class="form-control" type="text" name="title" readonly value="{{$calling->title}}">
            </div>

            <div class="form-group">
                <label for="category">Categoria:</label>
                <select class="form-control" id="category" name="category" readonly>
                    <option value="{{$calling->category->id}}">{{$calling->category->name}}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="desc">Descrição:</label>
                <textarea class="form-control" name="desc" readonly rows="4" cols="50" required>{{$calling->desc}}</textarea>
            </div>

            <div class="form-group">
                <label for="situation">Situação:</label>
                <select class="form-control" id="situation" name="situation">
                    @foreach($situations as $index => $situation)
                        @if($index >= 1)
                            <option value="{{$situation->id}}">{{$situation->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="creation">Data de Criação:</label>
                    <input class="form-control" id="creation" type="date" name="creation" value="{{$calling->creation}}" readonly>
                </div>

                <div class="form-group col-md-5">
                    <label for="limits">Prazo de Solução:</label>
                    <input class="form-control" type="date" name="limits" value="{{$calling->limits}}" readonly>
                </div>

                <div class="form-group col-md-5">
                    <label for="solution">Data da Solução:</label>
                    <input class="form-control" type="date" name="solution" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}">
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a class="btn btn-outline-secondary" role="button" href="{{route('calling.index')}}">Voltar</a>
                <input class="btn btn-outline-primary" type="submit" value="Editar chamado">
            </div>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
