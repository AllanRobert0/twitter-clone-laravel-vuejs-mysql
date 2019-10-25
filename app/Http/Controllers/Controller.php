<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;

use Illuminate\Http\Request;
use Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    //Web

    //retorna as views
    public function homepage(){
        $texto = 'Allan Roberto';
        return view('welcome' , [
            'devName' => $texto
        ]);
    }

    public function feed(){
        return view('feed');
    }

    //Api
    public function entrar(Request $request){

        //simula um sistema de login, apenas procura usuario
        //com email e senha inseridos
        $usuario = DB::table('table_usuarios')->where(
            [
                ['email', '=', $request->email],
                ['senha', '=', $request->senha]
            ]
        )->first();
        
        if(!$usuario){
            return  Response::json([
                'erro' => 'Usuario ou Senha Incorretos'
            ], 400);
        }
        else{
            return  Response::json([ 
                'token' => ['15as4da5s4da5d4s5a2a3', $usuario->id, $usuario->nome]
            ], 200);
        }
    }

    public function cadastrar(Request $request){
        
        //salva um novo usuario
        $email_existe = DB::table('table_usuarios')->where(
            [
                ['email', '=', $request->email]
            ]
        )->first();
        
        if($email_existe){
            return  Response::json([
                "erro" =>" Email Ja cadastrado"
            ], 400);
        }

        DB::table('table_usuarios')->insert(
            [ 
                'nome' => $request->nome,
                'email' => $request->email, 
                'senha' => $request->senha
            ]
        );
        
        return  Response::json([
                "sucesso" =>" Cadastrado com Sucesso"
        ], 200);
    }

    public function salvartweet(Request $request){
        //salva um tweet
        $id = DB::table('table_tweets')->insertGetId(
            [ 
                'usuario_id' => $request->usuario_id,
                'texto_tweet' => $request->texto_tweet,
            ]
        );
        return Response::json(array('success' => true,'tweet_id'=>$id, 'texto_tweet'=>$request->texto_tweet, 'usuario_id'=>$request->usuario_id), 200);
    }

    public function carregarfeed(Request $request){
        
        //Metodo para carregar feed (resolvivel com uma unica query sql)

        $usuarios_tweets = DB::table('table_seguindo')
        ->where(
            [
                ['usuario_id', '=', $request->usuario_id]
            ]
        )
        ->join('table_usuarios', 'table_usuarios.id', '=', 'table_seguindo.usuario_id')
        ->select('table_seguindo.usuario_seguido_id')
        ->get();

        $tweets = array();
        
        foreach ($usuarios_tweets as &$value) {
            
            $tweets_temp = DB::table('table_tweets')
            ->where(
                [
                    ['usuario_id', '=', $value->usuario_seguido_id ]
                ]
            )
            ->get();
            array_push($tweets, $tweets_temp );
        };
            
        $tweets_temp = DB::table('table_tweets')
        ->where(
            [
                ['usuario_id', '=', $request->usuario_id ]
            ]
        )
        ->get();

        array_push($tweets, $tweets_temp );

        return $tweets;
    }

    public function salvarcomenatrio(Request $request){

        //salva um comentario no banco e retorna as informacoes sobre o mesmo

        $id = DB::table('table_comentarios')->insertGetId(
            [ 
                'usuario_id' => $request->usuario_id,
                'tweet_id' => $request->tweet_id,
                'texto_comentario' => $request->texto_comentario
            ]
        );
        return Response::json(array('success' => true,
            'comentario_id'=>$id, 
            'usuario_id' =>$request->usuario_id,
            'nome' =>$request->nome, 
            'texto_comentario'=>$request->texto_comentario),
            200);
    }

    public function carregarcomentarios(Request $request){
        //carrega os comentarios de um tweet

         $comentarios = DB::table('table_comentarios')
            ->where(
                [
                    ['tweet_id', '=', $request->tweet_id]
                ]
            )
            ->join('table_usuarios', 'table_usuarios.id', '=', 'table_comentarios.usuario_id')
            ->select('table_comentarios.*', 'table_usuarios.nome')
            ->orderBy('id', 'asc')->get();
            

        return $comentarios;
    }

    public function seguir(Request $request){

        //segue um outro usuario

        $verifica_seguindo = DB::table('table_seguindo')->where(
            [
                ['usuario_id', '=',$request->usuario_id,],
                ['usuario_seguido_id', '=', $request->usuario_seguido_id]
            ]
        )->first();

        if($verifica_seguindo){
            return  Response::json([
                'erro' => 'Já segue esse Usuario'
            ], 400);
        }
        
        DB::table('table_seguindo')->insert(
            [ 
                'usuario_id' => $request->usuario_id,
                'usuario_seguido_id' => $request->usuario_seguido_id
            ]
        );
        return Response::json(array('mensagem' => 'Seguindo com Sucesso'), 200);
    }
}
