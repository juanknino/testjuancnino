<?php

namespace App\Http\Controllers;

use App\AnuncioAjax;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class AnuncioAjaxController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        $datos= array();
        $datos['name'] = $request->name;
        $datos['status'] = $request->status;
        $datos['idcreateruser']=1;
        $datos['created_at']=time();

        $idanun = DB::table('anuncios')->insertGetId($datos);

        $datos2= array();

        foreach($request->components as $comp){
            $otherobject=new stdClass();
            $otherobject=$request->$comp;

            if(empty($request->$comp['name'])){
                continue;
            }
            if($comp=='image'){
                $tamaño = getimagesize($request->$comp['url']);
                $otherobject['peso']=$tamaño['bits'];
                $otherobject['type']=$tamaño['mime'];
            }
            if($comp=='video'){
                $headers = get_headers($request->$comp['url'], 1);
                $headers = array_change_key_case($headers);
                $fileSize = -1;
                if(isset($headers['content-length'])){
                    $fileSize = $headers['content-length'];
                }
                $otherobject['peso']=round($fileSize / 1024);
                $url=explode('.',$request->$comp['url']);
                $tipo=end($url);
                $otherobject['type']=$tipo;
            }
            $datos2['idanuncio']=$idanun;
            $datos2['tipo']=$comp;
            $datos2['name']=$request->$comp['name'];
            $datos2['properties']=json_encode($otherobject);
            $datos2['created_at']=1;
            $id = DB::table('componentes_anuncios')->insertGetId($datos2);
        }
        $return='<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Anuncio Guardado!</strong> Se guardo toda la información.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $return;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

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
}
