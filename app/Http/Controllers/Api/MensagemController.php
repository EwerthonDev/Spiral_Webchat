<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mensagem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MensagemController extends Controller
{   
    public function listarMensagens(User $usuario)
    {   
        $contatoDe = Auth::user()->id;
        $contatoPara = $usuario->id;

        /**
         * [de = $contatoDe && para = $contatoPara]
         * OR
         * [de = $contatoPara && para = $contatoDe]
         */
        $mensagens = Mensagem::where(
            function($query) use ($contatoDe, $contatoPara) {
                $query->where([
                    'de' => $contatoDe,
                    'para' => $contatoPara
                ]);
            }
        )->orWhere(
            function($query) use ($contatoDe, $contatoPara) {
                $query->where([
                    'de' => $contatoPara,
                    'para' => $contatoDe
                ]);
            }
        )->orderBy('created_at', 'ASC')->get();
       
        return response()->json([
            'mensagens' => $mensagens
        ], Response::HTTP_OK);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $mensagem = new Mensagem();
        $mensagem->de = Auth::user()->id;
        $mensagem->para = $request->para;
        $mensagem->conteudo = filter_var($request->conteudo, FILTER_SANITIZE_STRIPPED);
        $mensagem->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
