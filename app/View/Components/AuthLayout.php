<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthLayout extends Component
{

    public  $primaryColor;
    public  $secondaryColor;
    public  $reversColumns;

    public function __construct(
         $primaryColor = "green",
         $secondaryColor = "blue",
         $reversColumns = false)
    {
        $this->primaryColor = $primaryColor;
        $this->secondaryColor = $secondaryColor;
        $this->reversColumns = $reversColumns;
    }


    public function render()
    {
        return view('layouts.auth');
    }

}
