<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('institucional/nosotros');
    }

    public function nosotros(): string
    {
        return view('institucional/nosotros');
    }
}