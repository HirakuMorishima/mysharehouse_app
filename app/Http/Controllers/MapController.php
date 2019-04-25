<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Map;

class MapController extends Controller
{
    public function index(Request $request)
    {
        // 全Mapデータ取得
        $list = Map::all();
        return view('map.data', ['list' => $list]);        
    }
    // 指定したピンのid番号を受けとって表示 
    public function getMap($id)
    {
        // 指定のMapデータ取得
        $map = Map::find($id);
        return view('map.show', ['map' => $map]);
    }
    // DI（注入）
    public function postMap(Request $request)
    {
        // POSTで受信したMapデータの登録
        $map = new Map(); 
        $map->name = $request->name;
        $map->lat = $request->lat;
        $map->lng = $request->lng;
        $map->description = $request->description;        
        $map->save();
        // Mapデータ取得（最新画面を表示->indexメソッドを呼びさせる redilect）
        $list = Map::all();
        return view('map.data', ['list' => $list]);
    }
}
