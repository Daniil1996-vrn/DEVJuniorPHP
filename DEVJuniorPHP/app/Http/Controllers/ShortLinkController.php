<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;
use Illuminate\Support\Str;
class ShortLinkController extends Controller
{
    public function index()
    {
        return view('shortenLink',[
            'shortLinks'=>ShortLink::all()
        ]);
     
    }

    public function showShortLinkAllRecords()
    {
        return response()->json(ShortLink::all());
    }

    public function store(Request $request)
    {
    $request->validate([
            'link'=>'required|url'
        ]);
        ShortLink::create([
            'link'=>$request->link,
            'code'=>str_random(6)
        ]);

        return response()->json(ShortLink::all());
    }

    public function shortenLink($code)
    {
        $link=ShortLink::where('code',$code)->first();
        $link->count++;
        $link->save();
       // print_r($link);

        return redirect($link->link);
    }

}
