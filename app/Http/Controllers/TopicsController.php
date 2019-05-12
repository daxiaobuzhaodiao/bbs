<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicsController extends Controller
{
    public function index(Request $request)
    {
        
        $topics = Topic::withOrder($request->order)->paginate(10);
        return view('topics.index', compact('topics'));
    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }
}
