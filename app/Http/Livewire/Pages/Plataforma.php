<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class Plataforma extends Component
{
    public function render()
    {
        return view('livewire.pages.plataforma')
        ->extends('layouts.default', ['pageId' => 'plataforma'])
        ->section('defaultPage');;
    }
}
