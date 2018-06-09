<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Producto;

class AjaxController extends Controller
{
    public function newContact(Request $request)
    {
        
        Mail::send(['text' => 'emails.notifyNewContact'], ['email'=>$request['email']], function ($message) {
            $message->from('socios@cienciafitness.com', 'Ciencia fitness');
            $message->subject('Nuevo Contacto');
            $message->to('jonathan.gomez@cienciafitness.com');
        });
        
        $response = array(
              'status' => 'success',
              'msg' => $request->email,
          );
      return response()->json($response); 
    }
    
    public function comentario(Request $request)
    {
        
        Mail::send(['text' => 'emails.blog.comment'], ['blog'=>$request['post'],'email'=>$request['email'],'name'=>$request['name'],'comment'=>$request['comment']], function ($message) {
            $message->from('socios@cienciafitness.com', 'Ciencia fitness');
            $message->subject('Comentario');
            $message->to('jonathan.gomez@cienciafitness.com');
        });
        
        $response = array(
              'status' => 'success',
              'msg' => $request->email,
          );
      return response()->json($response); 
    }
    
    public function info(Request $request)
    {
        $email = $request['email'];
        $sku = $request['sku'];
        $producto = Producto::where('sku', '=', $sku)->firstOrFail();
        
        Mail::send(['html' => 'emails.info'], ['producto'=>$producto], function ($message) use($request) {
            $message->from('socios@cienciafitness.com', 'Ciencia fitness');
            $message->subject('Informacion');
            $message->to($request['email']);
        });
        
        $response = array(
              'status' => 'success',
              'msg' => $request->email,
          );
      return response()->json($response); 
    }
}
