<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Http\Requests\TopicAddRequest;

class TopicsController extends Controller
{
    public function index(Request $request)
    {
        
        $topics = Topic::withOrder($request->order)->paginate(10);
        return view('topics.index', compact('topics'));
    }

    public function create(Topic $topic)
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicAddRequest $request)
    {
        $topic = $request->user()->topics()->create($request->except('_token'));
        return redirect()->route('topics.show', $topic->id);
    }

    public function show()
    {

    }

    public function edit(Topic $topic)
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function update()
    {

    }
}
