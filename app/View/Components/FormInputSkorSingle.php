<?php

namespace App\View\Components;

use App\Models\Klub;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInputSkorSingle extends Component
{
    public $klub;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // kirim var klub ke component
        $this->klub = Klub::orderBy('nama_klub', "ASC")->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input-skor-single');
    }
}
