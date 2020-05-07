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
        $tasks =Task::all();
        
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
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
            'content' => 'required|max:191', //lesoon14課題で追加
            
        ]);
        
        $task = new Task;
        $task->status = $request->status;    // 追加
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // getで/idにアクセスされた場合の「取得表示処理」
    {
        $task = Task::find($id);

        return view('tasks.show', [
            'task' => $task,
        ]);
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)  // getで/id/editにアクセスされた場合の「更新画面表示処理」
    {
        $task = Task::find($id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
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
        $task = Task::find($id);
        $task->delete();

        return redirect('/');
    }
}
