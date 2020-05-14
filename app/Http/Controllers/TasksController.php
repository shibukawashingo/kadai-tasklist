<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // getでTasks/にアクセスされた場合の「一覧表示処理」
    {
       $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }
        return view('welcome', $data);
        
    }

    /**
     * Show the form for creating a new resource.  
     * @return \Illuminate\Http\Response
     */
    public function create()  // getで/createにアクセスされた場合の「新規登録画面表示処理」
     
    {
         $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // postでTasks/にアクセスされた場合の「新規登録処理」
    {
        $this->validate($request, [
            'status' => 'required|max:10',   // 追加
            'content' => 'required|max:191',
        ]);
        $request->user()->tasks()->create([
            'status' => $request->content,
        ]);

        $request->user()->tasks()->create([
            'content' => $request->content,
        ]);


        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // getで/idにアクセスされた場合の「取得表示処理」
    {
        $user = User::find($id);
        $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'tasks' => $tasks,
        ];

        $data += $this->counts($user);

        return view('users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)  // getで/id/editにアクセスされた場合の「更新画面表示処理」
    {   
        $task = \App\Task::find($id);
        
        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
        }
       
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)  
    // putまたはpatchで/idにアクセスされた場合の「更新処理」
    {
        $this->validate($request, [
            'status' => 'required|max:10',   // 追加
            'content' => 'required|max:191', //lesoon14課題で追加
        ]);
        
        $task = Task::find($id);
        $task->status = $request->status;    // 追加
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // deleteで/idにアクセスされた場合の「削除処理」
    {
        $task = \App\Task::find($id);

        if (\Auth::id() === $task->user_id) {
            $task->delete();
        }

        return back();
    }
}
