<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksFormRequest;
use App\Models\Priority;
use App\Models\Tags;
use App\Models\Tasks;
use App\Policies\TasksPolicy;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    public function toggle(Tasks $task){
        $this->authorize('update',$task);

        if($task->isReady){
            $task->isReady = 0;
        }else{
            $task->isReady = 1;
        }

        $task->save();

        return back();

    }

    public function index()
    {
        $tasks=Tasks::all();
        if(request()->has('tags_id')) {

            if(request()->get('tags_id') != 0) {
                $tasks = $tasks
                    ->where('tags_id', request()->get('tags_id'));
            }
        }
        if(request()->has('priority_id')) {
            if (request()->get('priority_id')!=0) {
                $tasks = $tasks
                    ->where('priority_id', request()->get('priority_id'));
            }
        }
        if(request()->has('isReady')){
            if (request()->get('isReady')!=-1){
                $tasks = $tasks
                    ->where('isReady', request()->get('isReady'));
            }
        }
        return view('tasks.index',[
            'tasks' => $tasks,
            'tags'=>Tags::all(),
            'priority'=>Priority::all()
        ]);
    }

    public function create()
    {
        $this->authorize('create',Tasks::class);
        return view('tasks.form',[
            'tags'=>Tags::all(),
            'priority'=>Priority::all()
        ]);
    }


    public function store(TasksFormRequest $request)
    {
        $this->authorize('create',Tasks::class);

        auth()->user()
            ->tasks()
            ->create($this->getData($request));

        return redirect('tasks');
    }


    public function show(Tasks $task)
    {
        $this->authorize('view',$task);
        return view('tasks.view',[
            'task'=>$task
        ]);
    }


    public function edit(Tasks $task)
    {
        $this->authorize('update',$task);
        return view('tasks.form',[
            'task'=>$task,
            'tags'=>Tags::all(),
            'priority'=>Priority::all()
        ]);
    }


    public function update(TasksFormRequest $request, Tasks $task)
    {
        $this->authorize('update',$task);
        $task->update($this->getData($request));
        return redirect('tasks');
    }


    public function destroy(Tasks $task)
    {
        $this->authorize('delete',$task);
        $task->delete();
        return redirect('tasks');
    }

    protected function getData(TasksFormRequest $request){
        $data = $request->validated();
        return $data;
    }
}
