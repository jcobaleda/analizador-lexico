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

        $tokens = $this->component_lexico($input);

        return view('lexer.result', compact('tokens'));
    }

    private function component_lexico($input)
    {
        // Define los patrones para tokens con expresiones regulares
        $patterns = [
            '/\bif\b/i' => 'IF_KEYWORD',
            '/\belse\b/i' => 'ELSE_KEYWORD',
            '/\bfor\b/i' => 'FOR_KEYWORD',
            '/\bwhile\b/i' => 'WHILE_KEYWORD',
            '/\bforeach\b/i' => 'FOREACH_KEYWORD',
            '/\b,\b/i' => 'END_OPERATOR',
            '/\b;\b/i' => 'END_OPERATOR',
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
