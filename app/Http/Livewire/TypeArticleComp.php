<?php

namespace App\Http\Livewire;

use App\Models\ProprieteArticle;
use App\Models\TypeArticle;
use Carbon\Carbon;
use DeepCopy\Matcher\PropertyMatcher;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class TypeArticleComp extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search = "";

    public $isAddTypeArticle = false;

    public $newTypeArticleName="";

    public $newValue = "";

    public $selectedTypeArticle;

    public $newProprieteModal=[];


    public $editProprieteModal = [];



    public function render()
    {
        Carbon::setLocale("fr");

        $searchCritere = "%".$this->search."%";//% une facon de dire a eloquen tout mot qui contient la variable search

        $data= [
            "typearticles"=> TypeArticle::where("nom","like",$searchCritere)->latest()->paginate(5),

            "proprietesTypeArticles" => ProprieteArticle::where("type_article_id", optional($this->selectedTypeArticle)->id)->get(),
            "test"=> ProprieteArticle::all()

        ];
       // dd($this->selectedTypeArticle);
       // dd(ProprieteArticle::where("type_article_id",$this->selectedTypeArticle->id)->get());

        //dd($data["test"]);
       // dd(optional($this->selectedTypeArticle));
        return view('livewire.typearticles.index', $data)->extends("layouts.master")->section("contenu");
    }

//afficher le formulaire du type d'article
    public function showAddTypeArticleForm(){
       if($this->isAddTypeArticle){
        $this->isAddTypeArticle = false;
        $this->isAddTypeArticle = "";
        $this->resetErrorBag(["newTypeArticleName"]);// annule les erreur du formulaire
        $this->newTypeArticleName="";
       }else{
        $this->isAddTypeArticle = true;
       }
    }

    public function addNewTypearticle(){
        $validated = $this->validate([
            "newTypeArticleName"=>"required|max:50|unique:type_articles,nom"
        ]);
        TypeArticle::create(["nom"=>$validated["newTypeArticleName"]]);

        $this->showAddTypeArticleForm();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Type d'article crée avec succès!"]);
    }

    public function editTypeArticle($id){


        $typeArticle = TypeArticle::find($id);


        //$this->dispatchBrowserEvent("ShowEditForm",["typearticle" => $typeArticle->nom]);
       $this->dispatchBrowserEvent("showEditForm", ["typearticle" => $typeArticle]);
      // dd($typeArticle);

    }

    public function updateTypeArticle(TypeArticle $typeArticle, $valueFromJS){
        $this->newValue = $valueFromJS;
        $validated = $this->validate([
            "newValue" => ["required", "max:50", Rule::unique("type_articles", "nom")->ignore($typeArticle->id)]
        ]);

        $typeArticle->update(["nom"=> $validated["newValue"]]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Type d'article mis à jour avec succès!"]);

    }

    public function confirmDelete($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            "text" => "Vous êtes sur le point de supprimer $name de la liste des types d'article. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "page"=>"PAGELIST",
            "data" => [
                "type_article_id" => $id
            ]
        ]]);
    }

    public function deleteTypeArticle($id){
        TypeArticle::destroy($id);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Type article supprimé avec succès!"]);

    }

    public function showProp(TypeArticle $typeArticle){

     $this->selectedTypeArticle = $typeArticle;

        $this->dispatchBrowserEvent("showModal", []);
    }

    public function addProp(){
        $validated = $this->validate([
            "newProprieteModal.nom" => [ "required", Rule::unique("propriete_articles", "nom")->where("type_article_id", $this->selectedTypeArticle->id)],
            "newProprieteModal.estObligatoire" => "required"
        ]);

        ProprieteArticle::create([
            "nom" => $this->newProprieteModal["nom"],
            "estObligatoire" => $this->newProprieteModal["estObligatoire"],
            "type_article_id" => $this->selectedTypeArticle->id,
        ]);

        $this->newProprieteModal=[];
        $this->resetErrorBag();// annule les erreur du formulaire
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Propriété article ajoutée avec succès!"]);
    }


    public function editProp(ProprieteArticle $proprieteArticle){


        $this->editProprieteModal["nom"] = $proprieteArticle->nom;
        $this->editProprieteModal["estObligatoire"] = $proprieteArticle->estObligatoire;
        $this->editProprieteModal["id"] = $proprieteArticle->id;

        $this->dispatchBrowserEvent("showEditModal", []);
    }


    public function updateProp(){
        $this->validate([
            "editProprieteModal.nom" => ["required",Rule::unique("propriete_articles", "nom")->ignore($this->editProprieteModal["id"])
            ],
            "editProprieteModal.estObligatoire" => "required"
        ]);

        ProprieteArticle::find($this->editProprieteModal["id"])->update([
            "nom" => $this->editProprieteModal["nom"],
            "estObligatoire" => $this->editProprieteModal["estObligatoire"]
        ]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Propriété mise à jour avec succès!"]);
        $this->closeEditModal();
    }

    public function showdeletePrompt($name, $id){

        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            "text" => "Vous êtes sur le point de supprimer $name de la liste des propriétés d'article. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "FABIO"=> 1,
            "data" => [
                "propriete_id" => $id
            ]
        ]]);

    }

    public function deletePropArticle($id){
        ProprieteArticle::destroy($id);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Propriété article supprimée avec succès!"]);
    }

    public function closeEditModal(){
        $this->dispatchBrowserEvent("closeEditModal");
    }

    public function closeModal(){
        $this->dispatchBrowserEvent("closeModal");
    }
}
