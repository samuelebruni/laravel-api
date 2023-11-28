<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Illuminate\Support\Str;
use App\Models\Project;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $validate_data = $request ->validated();

        $validate_data['slug'] = Str::slug($request->name, '-');
        $type = Type::create($validate_data);

        return to_route('admin.types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $validate_data = $request->validated();
        
        $validate_data['slug'] = $type->generateSlug($request->name);
        
        $type->update($validate_data);
        
        return to_route('admin.types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $projects = Project::all();
        foreach ($projects as $project) {
            if ($project->type->id == $type->id) {
                $project->type()->dissociate();
                $project->save();
            }
        }
        $type->delete();
        return to_route('admin.types.index');
    }
}
