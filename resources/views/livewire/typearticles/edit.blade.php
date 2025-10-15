<div class="modal fade" id="modalEditProp" tabindex="-1" role="dialog" wire:ignore.self style="z-index: 1900">
  <div class="modal-dialog modal-xl" style="top:100px">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Edition propriété des caracteristique </h5>

          </div>
          <div class="modal-body">
             <div class="d-flex my-4 bg-gray-light p-3">
                  <div class="d-flex flex-grow-1 mr-2">
                      <div class="flex-grow-1 mr-2">
                          <input type="text" placeholder="Nom"  wire:model="editProprieteModal.nom" class="form-control @error("editProprieteModal.nom") is-invalid @enderror">
                          @error("editProprieteModal.nom")
                              <span class="text-danger">{{$message}}</span>
                          @enderror
                      </div>
                      <div class="flex-grow-1">
                          <select class="form-control @error("editProprieteModal.estObligatoire") is-invalid @enderror" wire:model="editProprieteModal.estObligatoire">
                              <option value="">--Champ Obligatoire--</option>
                              <option value="1">OUI</option>
                              <option value="0">NON</option>
                          </select>
                          @error("editProprieteModal.estObligatoire")
                              <span class="text-danger">{{$message}}</span>
                          @enderror
                      </div>
                  </div>
                  <div>
                  <button class="btn btn-success" wire:click="updateProp()">Modifier</button>
                  </div>
             </div>

             <div class = "card-footer">
                  <div class="float-right">
                      {{--$proprieteTypeArticles->links()--}}    
                  </div> 
              </div>

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" wire:click="closeEditModal">Fermer</button>
          </div>
      </div>
  </div>
</div>

<script>
  
</script>