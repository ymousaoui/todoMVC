<?php

namespace App\Http\Controllers;

use App\Models\todoList;
use App\Models\User;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('hello');
        $users = User::all();
        $list = todoList::all();
        return view('todoList',['data' => $users, 'list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatieData= $request->validate([
            'titre'=> 'required|min:4|max:100',
            'description'=>'required|min:5'
        ]);

        $todoList = new todoList();
        $todoList->titre = $request->input('titre');
        $todoList->description = $request->input('description');
        $todoList->user_id = $request->input('user');
        $todoList->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function show(todoList $todoList)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\todoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre'=> 'required|min:4|max:100',
            'description'=>'required|min:5'
        ]);
        $task = todoList::findOrFail($id);
        $task->update($request->all());
        // $task->id = $id;
        // $task->titre = $request->input('titre');
        // $task->description = $request->input('description');
        // $task->user_id = $request->input('user');

        // $task->save();
       
        return redirect()->route('todoList.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        todoList::destroy([$id]);
        return redirect()->route('todoList.index');
    }

}
