<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/index.css">
    <title>PLSS | Chamados</title>
</head>
<body class="text-center">
    <h1 class="mt-5">Chamados</h1>
    <div>
        @if(session()->has('success'))
            <div class="container alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-end">
        <a class="m-2 mr-4 btn btn-outline-primary btn-lg" role="button" href="{{route('calling.create')}}">Criar chamado</a>
    </div>

    <hr>

    <div class="m-3">
        <table class="mx-auto w-100 table table-hover table-bordered">
            <thead>
                <tr>
                    <th class="align-middle" scope="col">#</th>
                    <th class="align-middle" scope="col">Título</th>
                    <th class="align-middle" scope="col">Categoria</th>
                    <th class="align-middle" scope="col">Descrição</th>
                    <th class="align-middle" scope="col">Situação</th>
                    <th class="align-middle" scope="col">Prazo</th>
                    <th class="align-middle" scope="col">Data da Criação</th>
                    <th class="align-middle" scope="col">Data da Solução</th>
                    <th class="align-middle" scope="col">Atendimento</th>
                    <th class="align-middle" scope="col">Deletar</th>
                </tr>
            </thead>
            @foreach($callings as $calling)
                <tr>
                    <th class="align-middle" scope="row">{{$calling->id}}</th>
                    <td class="align-middle">{{$calling->title}}</td>
                    <td class="align-middle">{{$calling->category->name}}</td>
                    <td class="align-middle">{{$calling->desc}}</td>
                    <td class="align-middle">{{$calling->situation->name}}</td>
                    <td class="align-middle">{{$calling->limits}}</td>
                    <td class="align-middle">{{$calling->creation}}</td>
                    <td class="align-middle">{{$calling->solution ? $calling->solution : '-'}}</td>
                    <td><a class="m-2 btn btn-outline-info" role="button" href="{{route('calling.edit', ['calling' => $calling])}}">Atender</a></td>
                    <td>
                        <form method="post" action="{{route('calling.destroy', ['calling' => $calling])}}">
                            @csrf
                            @method('delete')
                            <input type="submit" class="m-2 btn btn-outline-danger" role="button" value="Deletar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <hr>

    <div class="d-flex mr-3 ml-3 fixed-bottom justify-content-between">
        <p>Qtd de chamados no mês: {{ $totalChamados }}</p>
        <p>Percentual de chamados resolvidos no mês: {{ number_format($percentual, 2) }}%</p>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
