<div>
    <div class="row p-4 pt-5">
        <div class="col-12">
        <div class="card">
            <div class="card-header bg-gradient-primary d-fex align-items-center">
                <h3 class="card-title"> <i class ="fas fa-users fa-2x"></i> Liste des types d'articles</h3>

                <div class="card-tools d-flex align-items-center">
                    <a class="btn btn-link text-white mr-4 d-block"  wire:click="showAddTypeArticleForm" href="#"><i class="fas fa-user-plus"></i> Nouveau type d'article</a>
                    <div class="input-group input-group-md" style="width: 250px;">
                        <input type="text" name="table_search" wire:model.debounce.250ms="search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
        <table class="table table-head-fixed text-nowrap">
            <thead>
                <tr>
                    <th style="width: 50%;">Type d'article</th>
                    <th style="width: 20%;" class="text-center">Date d'ajout</th>
                    <th style="width: 30%;" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($isAddTypeArticle)
                    <tr>
                        {{--wire:keydown.enter pour la touche entrer  --}}
                        <td colspan="2">
                            <input type="text"  class="form-control @error('newTypeArticleName')
                                is-invalid @enderror" 
                                wire:keydown.enter ="newTypeArticleName"
                                 wire:model="newTypeArticleName"/>   
                            @error("newTypeArticleName")
                                <span class="text-danger">
                                        {{$message}}
                                </span>
                            @enderror   
                        </td>
                        <td>
                            <button class="btn btn-link" wire:click="addNewTypearticle()"><i class ="fa fa-check"></i>Valider</button> 
                            <button class="btn btn-link" wire:click="showAddTypeArticleForm"><i class ="far fa-trash-alt"></i>Annuler</button> 
                        </td>
                    </tr>                        
                @endif
                    @foreach ($typearticles as $typearticle  )
                        <tr>
                            <td>
                                {{$typearticle->nom}}
                            </td>
                            <td>
                                {{optional($typearticle->created_at)->diffForHumans()}}
                            </td> 

                            <td class="text-center">
                                <button class="btn btn-link" wire:click='editTypeArticle({{$typearticle->id}})' ><i class ="far fa-edit"></i>Modifier</button> 
                                <button class="btn btn-link" data-toggle="modal" wire:click="showProp({{$typearticle->id}})" ><i class ="fa fa-list"></i>Propriété</button>
                               @if (count($typearticle->articles) ==0)
                               <button class="btn btn-link" wire:click="confirmDelete('{{$typearticle->nom}}',{{$typearticle->id}})" ><i class ="far fa-trash-alt"></i>Supprimer</button> 
                            </td> 
                               @endif
                               
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
        <div class = "card-footer">
        <div class="float-right">
            {{$typearticles->links()}}
                
        </div> 
        </div>
    </div>
</div>