<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Http\Requests\TopicAddRequest;
use App\Handlers\ImageUploadHandler;

class TopicsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
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

    public function show(Topic $topic)
    {
        $topic->load('user', 'category');
        return view('topics.show', compact('topic'))->with('success', '文章发布成功');
    }

    public function edit(Topic $topic)
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function update(TopicAddRequest $request, Topic $topic)
    {
        $topic->update($request->all());

        return view('topics.show', compact('topic'))->with('success', '文章更新成功');
    }

    // 异步上传文章文件或者图片
    public function uploadImage(Request $request, ImageUploadHandler $upload)
    {
        // 初始化返回 json 数据
        $data = [
            'success' => false,
            'msg' => '上传失败!',
            'file_path' => ''
        ];

        // 判断是否有文件上传，并赋值给 $file
        if($file = $request->upload_file) {
            // 保存图片
            $result = $upload->save($file, 'topics', \Auth::id(), 1024);
            if($result) {
                $data['file_path'] = $result['path'];
                $data['msg'] = '上传成功';
                $data['success'] = true;
            }
        }

        return $data;
    }
}
