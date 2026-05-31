<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    //
    public function index(Request $request)
    {
        $view_name = 'regular-user';
        if ($request->attributes->get('is_reader')) {
            $view_name = 'reader';
        }

        return view($view_name);

    }
}
