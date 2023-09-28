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

        $expression = $request->input('expression');
        $tokens = $this->component_lexico($expression);
        $analisis = $this->isValidCode($expression);

        return view('lexer.result')->with('analisis', $analisis)->with('tokens', $tokens)->with('expression', $expression);
        
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
            '/[,;]/' => 'END_OPERATOR',
            '/\becho\b/i' => 'RESERVED_WORD',
            '/[a-zA-Z]\w*/' => 'IDENTIFIER',
            '/[><=]/' => 'COMPARISON_OPERATOR',
            '/\d+/' => 'NUMBER',
            '/\=/' => 'ASSIGNMENT_OPERATOR',
            "/'/i" => 'SINGLE_QUOTE',
            '/"/i' => 'DOUBLE_QUOTE',
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

    private function isValidCode($code)
    {

        $keywords = ['if', 'else'];
        $errors = [];
        
        // Verificar la presencia de palabras clave
        foreach ($keywords as $keyword) {
            if (strpos($code, $keyword) === false) {
                $errors[] = 'Falta la estructura "' . $keyword . '"';
                break;
            }
            else{
                $errors[] = 'Buena la estructura "' . $keyword . '"';
            }
        }

        // Verificar que las llaves estén balanceadas
        $balance = 0;
        for ($i = 0; $i < strlen($code); $i++) {
            if ($code[$i] === '{') {
                $balance++;
            } elseif ($code[$i] === '}') {
                $balance--;
            }
    
            if ($balance != 0) {
                $errors[] = 'Falta cerrar una llave ' . $code[$i];
                break;
            }else{
                $errors[] = 'Llaves estan balanceadas';
            }
        }
    
    
        return $errors;
}

}
