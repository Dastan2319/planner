<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriorityFormRequest;
use App\Models\Priority;
use App\Models\User;
use App\Policies\PriorityPolicy;
use Illuminate\Http\Request;

class PriorityController extends Controller
{

    public function index()
    {
//        $this->authorize('view-any',User::class);
        $this->authorize('view-any',Priority::class);

        return view('priority.index',[
            'priorities'=>Priority::all()
        ]);
    }

    public function create()
    {
        $this->authorize('create',Priority::class);

        return view('priority.form');
    }

    public function store(PriorityFormRequest $request)
    {
        $this->authorize('create',Priority::class);
        auth()->user()
            ->priority()
            ->create($this->getData($request));

        return redirect('priority');
    }


    public function show(Priority $priority)
    {
        return redirect('priority.update');
    }


    public function edit(Priority $priority)
    {
        $this->authorize('update',$priority);
        return view('priority.form',[
            'priority'=>$priority
        ]);
    }

    public function update(PriorityFormRequest $request, Priority $priority)
    {
        $this->authorize('update',Priority::class);
        $priority->update($this->getData($request));
        return redirect('priority');
    }

    public function destroy(Priority $priority)
    {
        $this->authorize('delete',$priority);
        $priority->delete();
        return redirect('priority');
    }

    protected function getData(PriorityFormRequest $request){
        $data = $request->validated();
        return $data;
    }
}
