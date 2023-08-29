<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LexerController extends Controller
{
    public function showForm()
    {
        //ruta inicial
        return view('welcome');
    }

    public function analyze(Request $request)
    {
        $input = $request->input('expression');

        $tokens = $this->componenr_lexico($input);

        return view('lexer.result', compact('tokens'));
    }

    private function componenr_lexico($input)
    {
        // Define los patrones para tokens
        $patterns = [
            '/\bif\b/i' => 'IF_KEYWORD',
            '/\belse\b/i' => 'ELSE_KEYWORD',
            '/[a-zA-Z]\w*/' => 'IDENTIFIER',
            '/[><=]/' => 'COMPARISON_OPERATOR',
            '/\d+/' => 'NUMBER',
            '/\=/' => 'ASSIGNMENT_OPERATOR',
        ];
    //inicializar tokens
    $tokens = [];

    //recorre la expresion
    foreach ($patterns as $pattern => $type) {
        preg_match($pattern, $input, $matches);
        if (!empty($matches[0])) {
            $tokens[] = ['type' => $type, 'value' => $matches[0]];
        }
        $input = preg_replace($pattern, '', $input, 1);
    }

        return $tokens;
    }
}