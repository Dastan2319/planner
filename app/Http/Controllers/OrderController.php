<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\Tasks;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderByTag(Request $request){
        if($request['tag'] && $request['tag']!=0) {
            $tasks = Tasks::query()
                ->where('tags_id',$request['tag'])
                ->get();
        }
    }
}
