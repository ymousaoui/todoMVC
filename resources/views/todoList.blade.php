<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/app.css')}}">
    <link rel="stylesheet" href="{{ mix('/css/theme.css')}}">
    
    <title>todo MVC</title>
</head>
<body>
    <div class="container col-3">
        <h1>Todo MVC</h1>
    </div>
   
    <h3 class="col-6">Ajouter une tâche</h3>
    <div class="container" id="app">
       
        <form method="POST" class="px-4 py-3" action="{{ url('/todoList') }}">
                @csrf
                <div class="form-group">
                    <label for="titre">Titre    </label>
                    <input type="text" name="titre" class="form-control"  value="{{old('titre')}}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" class="form-control" value="{{old('description')}}">
                </div>
        
                <div class="form-group">
                    <label for="titre">Responsable_ID</label>
                    <select class="custom-select" name="user" id="user" class="form-control">
                        @foreach ($data as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
                @endif
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
        </form>
    </div>
   
    
   
        <hr>
        <div>
            @if(count($list) == 0)
                        <div>
                            <h3 class="col-6">La liste des tâches est vide !</h3>
                        </div>
            @else
            <h3 class="col-6">La liste des taches</h3>
            <div></div>
        <div class="container">
            
            <table class="table table-hover">
                <thead>
                    <th scope="col">Id</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Utilisateur</th>
                    <th>Date de création</th>
                </thead>

                <tbody>
                    
                    @foreach ($list as $item)
                    <tr>
                        <td>{{ $item->id}}</td>
                        <td>{{ $item->titre}}</td>
                        <td>{{ $item->description}}</td>
                        <td>{{ $item->user_id}}</td>
                        <td>{{ $item->created_at}}</td>
                        <td>
                            <form method="GET"  action="">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                    Modifier
                                </button>
                            </form>
                        </td>
                        <td>
                        <form method="POST" action="{{ route('todoList.destroy',$item->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>

                    </tr>
                        
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modifier tâche</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="">
                    <div class="form-group">
                    <input type="text" class="form-control" placeholder="le titre" name="titre">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="la description" name="description">
                    </div>
                    <div class="form-group">
                        
                        <select class="custom-select" name="user" id="user" class="form-control">
                            @foreach ($data as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
            </form>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
   
            
</body>
<script src="{{ mix('/js/app.js') }}"></script>
</html>