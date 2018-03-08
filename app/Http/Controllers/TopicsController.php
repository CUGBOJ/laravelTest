<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    //
    public function index(Request $request)
    {
        $topics = Topic::paginate(10);
        $username = $request->input('username');
        $pro_id = $request->input('pro_id');
        return view('topics.index', ['username' => $username, 'pro_id' => $pro_id]);
    }

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    public function create()
    {
        $this->authorize('topic_create');
        return view('topics.create');
    }

    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'index',]
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('topic_create');
        $this->validate($request, [
            'title' => 'required|max:50|min:2',
            'body' => 'required',
            'pro_id' => 'required|exists:problems,id',
        ]);

        $username = Auth::user()->username;
        $topic = Topic::create([
            'title' => $request->title,
            'body' => $request->body,
            'pro_id' => $request->pro_id,
            'username' => $username,
            'last_reply_username' => $username,
        ]);
        session()->flash('success', 'Add topic success.');
        return redirect()->route('topics.show', [$topic]);
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('topic_destroy');
        $topic->delete();
        return redirect()->route('topics.index')->with('success', 'Delete topic success.');
    }

    public function update(Topic $topic,Request $request)
    {
        $this->authorize('topic_edit');
        $this->validate($request, [
            'title' => 'required|max:50|min:2',
            'body' => 'required',
        ]);
        $topic->update($request->all());
        session()->flash('success', 'Change topic success.');
        return redirect()->route('topics.show', [$topic]);
    }

    public function edit(Topic $topic)
    {
        $this->authorize('topic_edit');
        return view('topics.edit', compact('topic'));
    }
}
