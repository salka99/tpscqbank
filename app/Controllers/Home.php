<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Redirect to questions page
        return redirect()->to('/questions');
    }

    
}
