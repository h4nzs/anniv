<?php
    
    namespace App\Controllers;

class AnnivGate extends BaseController
{
    public function index()
    {
        return view('anniv_gate');
    }

    public function check()
    {
        $inputKey = $this->request->getPost('keyword');
        if (strtolower(trim($inputKey)) === 'bilqis') {
            return redirect()->to('/anniv');
        } else {
            return redirect()->back()->with('error', 'Kata kunci salah!')->withInput();
        }
    }
}
