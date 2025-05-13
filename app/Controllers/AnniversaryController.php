<?php

namespace App\Controllers;

class AnniversaryController extends BaseController
{
    public function index()
    {
        return view('slide1');  // Halaman pertama
    }

    public function slide($slide)
    {
        switch ($slide) {
            case 1:
                return view('slide1');
            case 2:
                return view('slide2');
            case 3:
                return view('slide3');
            case 4:
                return view('slide4');
            case 5:
                return view('slide5');
            case 6:
                return view('slide6');
            default:
                return redirect()->to('/');
        }
    }
}
