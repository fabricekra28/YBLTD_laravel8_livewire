<div class="row p-4 pt-5">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gradient-primary d-flex align-items-center">
          <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des locations</h3>

          <div class="card-tools d-flex align-items-center ">
          <a class="btn btn-link text-white mr-4 d-block" wire:click.prevent="goToAddClient()"><i class="fas fa-user-plus"></i> Nouvelle location</a>
            <div class="input-group input-group-md" style="width: 250px;">
              <input type="text" name="table_search" class="form-control float-right" wire:model.debounce.700ms="search" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0 table-striped" style="height: 400px;">
          <table class="table table-head-fixed">
            <thead>
              <tr>
                <th style="width:5%;"></th>
                <th style="width:25%;">Employé</th>
                <th style="width:20%;" >Client</th>
                <th style="width:25%;">Date de debut de location</th>
                <th style="width:20%;" >Date de fin de location</th>
                <th style="width:20%;" >Statu de la location</th>
                <th style="width:20%;" class="text-center">Ajouté</th>
                <th style="width:30%;" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($locations as $location)
              <tr>
                <td>
                  @if($location->sexe == "F")
                      <img src="{{asset('images/woman.png')}}" width="24"/>
                  @else
                      <img src="{{asset('images/man.png')}}" width="24"/>
                  @endif
                </td>
                <td>{{ $location->prenom }} {{ $location->nom }}</td>
                <td>-------------</td>
                <td class="text-center"><span class="tag tag-success">{{ $location->created_at->diffForHumans() }}</span></td>
                <td class="text-center">
                  <button class="btn btn-link" wire:click="goToEditlocation({{$location->id}})"> <i class="far fa-edit"></i> </button>
                {{--  <button class="btn btn-link" wire:click="confirmDelete('{{ $location->prenom }} {{ $location->nom }}', {{$location->id}})"> <i class="far fa-trash-alt"></i> </button> --}}
                </td>
              </tr>
              @endforeach
            </tbody>

          </table>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="float-right">
            {{ $locations->links() }}
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>


