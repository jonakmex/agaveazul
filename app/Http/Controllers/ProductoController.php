<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Producto;
use DB;
use Telegram\Bot\Api;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::paginate(9);
        return view('productos.catalogo')->with('productos',$productos);
    }
    
    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function searchByName(Request $request)
    {
        $name = $request->get('name');
        $page = $request->get('page');
        
        // Perform the query using Query Builder
        $productos = Producto::where('name', 'like', '%'.$name.'%')->paginate(9);
        $productos->appends(['name' => $request->get('name')]);
        return view('productos.catalogo')->with('productos',$productos);
    }
    
    public function searchByCategory(Request $request)
    {
        $categoria = $request->get('categoria');
        $page = $request->get('page');
        
        // Perform the query using Query Builder
        $productos = Producto::where('categoria', '=', $categoria)->paginate(9);
        $productos->appends(['categoria' => $request->get('categoria')]);
        return view('productos.catalogo')->with('productos',$productos);
    }
    
    public function searchBySku($sku)
    {
        
        // Perform the query using Query Builder
        $producto = Producto::where('sku', '=', $sku)->firstOrFail();
        return view('productos.detalle')->with('producto',$producto);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.detalle')->with('producto',$producto);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    
     
    public function bot()
    {
        $telegram = new Api('456999184:AAFrZCS6-Wgq-TCtQ6HsHS6qggtqq6-9G1s');
        $response = Telegram::getMe();
        $response = $telegram->sendMessage([
          'chat_id' => 'CHAT_ID', 
          'text' => 'Hello World'
        ]);

        $messageId = $response->getMessageId();
        return 'Hello world';
    }
}
