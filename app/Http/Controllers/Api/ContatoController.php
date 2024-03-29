<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ContatoController extends Controller
{
    public function index()
    {   
        $usuarioLogado = Auth::user();
        
        $usuarios = User::where('id', '!=', $usuarioLogado->id)->get();

        return response()->json([
            'contatos' => $usuarios,
        ], Response::HTTP_OK);
    }

    public function show(User $usuario)
    {
        return response()->json([
            'contato' => $usuario,
        ], Response::HTTP_OK);
    }

    public function eu()
    {
        $usuarioLogado = Auth::user()    ;

        return response()->json([
            'usuarioLogado' => $usuarioLogado
        ], Response::HTTP_OK);
    }
}
