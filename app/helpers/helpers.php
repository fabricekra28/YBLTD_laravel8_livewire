<?php
use Illuminate\Support\Str;

define("PAGELIST","liste");
define("PAGECREATION","create");
define("PAGEEDITFORM","edit");

define("PAGELISTS","liste");
define("PAGECREATIONS","create");
define("PAGEEDITFORMS","edit");

function setActiveMenu($menus){
    $result = "";
    foreach ($menus as $menu) {
        if(request()->route()->getName() === $menu){
            $result = "active";
        }
    }
    return $result;
}

function setRootMenu($menus, $class){
    $result = "";
    foreach ($menus as $menu) {
        if(contains(request()->route()->getName(), $menu)){
            $result = $class;
        }
    }
    return $result;
}


function contains($container, $content){
    return Str::contains($container, $content);
}

function authNomComplet(){
    return auth()->user()->prenom . " " . auth()->user()->nom;
}

function setMenuOpen($route){
    if(request()->route()->getName() === $route ){
        return "menu-open";
    }
    return "";
}
