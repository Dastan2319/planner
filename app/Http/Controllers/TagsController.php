<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagsFormRequest;
use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
//        $tags = Tags::query()
//        ->latest()
//        ->paginate(100);

//        $this->authorize('view-any',Tags::class);

        return view('tags.index',[
            'tags'=>Tags::all()
        ]);

    }

    public function create()
    {
        $this->authorize('create',Tags::class);

        return view('tags.create');
    }


    public function store(TagsFormRequest $request)
    {
        $this->authorize('create',Tags::class);

        auth()->user()
            ->tags()
            ->create($this->getData($request));

        return redirect('tags');
    }


    public function show(Tags $tags)
    {
        return redirect('tags.update');
    }


    public function edit(Tags $tag)
    {
        $this->authorize('update',$tag);
        return view('tags.create',[
            'tag'=>$tag
        ]);
    }


    public function update(TagsFormRequest $request, Tags $tag)
    {
        $this->authorize('update',$tag);
        $tag->update($this->getData($request));
        return redirect('tags');
    }


    public function destroy(Tags $tag)
    {
        $this->authorize('delete',$tag);
        $tag->delete();
        return redirect('tags');

    }

    protected function getData(TagsFormRequest $request){
        $data = $request->validated();
        return $data;
    }
}
