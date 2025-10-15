<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;
use Carbon\Carbon;

class LocationComp extends Component
{
    public function render()
    {
        Carbon::setLocale("fr");


        $query = Location::query();
       // $search = $this->search;

        /*if(isset($search))
            $this->resetPage();

        $query->when($search != "", function($query) use($search){
            $query->where("client.nom", "like", "%{$search}%");
            $query->orWhere("client.prenom", "like", "%{$search}%");
        }); */

        return view('livewire.locations.index', [
            "locations" => $query->latest()->paginate(10)
        ])
        ->extends("layouts.master")
        ->section("contenu");
    }
}
