<div>
    @include("livewire.typearticles.edit")
    @include("livewire.typearticles.add")
    @include("livewire.typearticles.liste")

    
</div>

<script>
    window.addEventListener("showEditForm",function(e){
        Swal.fire({
            title: "Edition d'un type d'article",
            input: 'text',
            inputValue: e.detail.typearticle.nom ,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText:'Modifier <i class="fa fa-check"></i>',
            cancelButtonText:'Annuler <i class="fa fa-times"></i>',
            inputValidator: (value) => {
                if (!value) {
                    
                return 'Champ obligatoire'
                }
                @this.updateTypeArticle(e.detail.typearticle.id, value)
            }
        })
    })
</script>

<script>
    window.addEventListener("showSuccessMessage", event=>{
        Swal.fire({
                position: 'top-end',
                icon: 'success',
                toast:true,
                title: event.detail.message || "Opération effectuée avec succès!",
                showConfirmButton: false,
                timer: 5000
                }
            )
    })
</script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    
    window.addEventListener("showConfirmMessage", event=>{
       Swal.fire({
        title: event.detail.message.title,
        text: event.detail.message.text,
        icon: event.detail.message.type,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuer',
        cancelButtonText: 'Annuler'
        }).then((result) => {
        if (result.isConfirmed) {

            if(event.detail.message.data ){
                    @this.deleteTypeArticle(event.detail.message.data.type_article_id)
                }
            if(event.detail.message.data.propriete_id){
                @this.deletePropArticle(event.detail.message.data.propriete_id)
                }
               
          }
        })
    })

</script>

<script>
    window.addEventListener("showModal", event=>{
      //  console.log(event)
        $("#modalProp").modal("show")
    })

    window.addEventListener("closeModal", event=>{
       // console.log(event)
        $("#modalProp").modal("hide")
    })

    window.addEventListener("showEditModal", event=>{
      //  console.log(event)
        $("#modalEditProp").modal("show")
    })

    window.addEventListener("closeEditModal", event=>{
       // console.log(event)
        $("#modalEditProp").modal("hide")
    })

    
</script>