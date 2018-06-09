<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;
use App\Producto;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BotController extends Controller
{
    
    
   
    public function bot(Request $request){
      $chatid = $request['message']['chat']['id']; // get chatid from request
      $text = $request['message']['text']; // get the user sent text
      
      //\Botan::track($request['message'], 'Message');
        
      $productos = Producto::where('name', 'like', '%'.$text.'%')->get();
          
      if($productos->count() > 0){ 
          
            foreach($productos as $producto){
                $result = '['.$producto->sku.'] '.$producto->name.' [$'.number_format($producto->price,2).']'.' [25% - $'.number_format($producto->_25,2).']'.' [35% - $'.number_format($producto->_35,2).']'.' [42% - $'.number_format($producto->_42,2).']'.' [50% - $'.number_format($producto->_50,2).']';    
                $response = \Telegram::sendMessage([
                        'chat_id' => $chatid, 
                        'text' => $result
                  ]);
            } 
      }
      else{
          $response = \Telegram::sendMessage([
                'chat_id' => $chatid, 
                'text' => 'No encontrados'
              ]); 
      }
        
        
    }
    
    
    public function test(Request $request){
      $chatid = $request['message']['chat']['id']; // get chatid from request
      $text = $request['message']['text']; // get the user sent text
      
      //\Botan::track($request['message'], 'Message');
        
      $productos = Producto::where('name', 'like', '%'.$text.'%')->get();
          
      if($productos->count() > 0){ 
          
            foreach($productos as $producto){
                $result = '['.$producto->sku.'] '.$producto->name.' [$'.number_format($producto->price,2).']'.' [25% - $'.number_format($producto->_25,2).']'.' [35% - $'.number_format($producto->_35,2).']'.' [42% - $'.number_format($producto->_42,2).']'.' [50% - $'.number_format($producto->_50,2).']';    
                $response = \Telegram::sendMessage([
                        'chat_id' => $chatid, 
                        'text' => $result
                  ]);
            } 
      }
      else{
          $response = \Telegram::sendMessage([
                'chat_id' => $chatid, 
                'text' => 'No encontrados'
              ]); 
      }
    }
}
