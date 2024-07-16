<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Exercicio01Controller extends Controller
{
     public function Exercicio01View()
    {
        return view('Exercicio01');
    }

    public function Exercicio01(Request $request)
    {

        $n1 = $request->n1;


        if ($n1 % 2 == 0) {
            return 'O numero é par';
        } else if ($n1 % 1 == 0)

            return 'O numero é impar';
    }
}
