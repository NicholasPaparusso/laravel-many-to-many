<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $projects = Project::where('name','like',"%$search%")->paginate(8);
        }else{

            $projects = Project::where('user_id', Auth::id())->orderby('id','desc')->paginate(8);

        }

        $direction = 'desc';
        return view('admin.projects.index', compact('projects','direction'));
    }


    public function orderby($column , $direction){
        $direction = $direction === 'desc' ? 'asc' : 'desc';
        $projects = Project::orderby($column, $direction)->paginate(8);

        return view('admin.projects.index', compact('projects', 'direction'));
    }

    public function types_project(){

        $types = Type::all();
        return view('admin.projects.types_project',compact('types'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project_form = $request->all();

        if(array_key_exists('cover_image',$project_form)){

            $project_form['image_original_name'] = $request->file('cover_image')->getClientOriginalName();

            $project_form['cover_image'] = Storage::disk('public')->put('uploads', $project_form['cover_image']);

           // dd(storage_path());
        }

        // dd($project_form);

        $project_form['slug']= Project::generateSlug($project_form['name']);

        // $new_project = new Project();
        // $new_project->fill($project_form);
        // $new_project->save();
        // dd(Auth::id());
        // $project_form['user_id'] = Auth::id();

        $project_form['user_id'] = Auth::id();
        $new_project = Project::create($project_form);
        if(array_key_exists('technologies', $project_form)){
            $new_project->technologies()->attach($project_form['technologies']);
        }

        return redirect(route('admin.projects.show', $new_project))->with('message', 'Progetto inizializzato correttamente');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        if($project->user_id === Auth::id()){
            return view('admin.projects.show', compact('project'));
        }else{
            return redirect()->route('admin.projects.index')->with('message','Non sei autorizzato/a a vedere questo progetto');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        if($project->user_id === Auth::id()){
            return view('admin.projects.edit', compact('project','types','technologies'));
        }else{
            return redirect()->route('admin.projects.index')->with('message','Non sei autorizzato/a a modificare questo progetto');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project_form = $request->all();

        if($project_form['name'] != $project->name){
            $project_form['slug'] = Project::generateSlug($project_form['title']);
        }else{
            $project_form['slug'] = $project->slug;
        }


        if(array_key_exists('cover_image', $project_form)){

            if($project->cover_image){
                Storage::disk('public')->delete($project->cover_image);
            }


            $project_form['image_original_name'] = $request->file('cover_image')->getClientOriginalName();

            $project_form['cover_image'] = Storage::disk('public')->put('uploads', $project_form['cover_image']);
        }

        $project->update($project_form);
        if(array_key_exists('technologies', $project_form)){
            $project->technologies()->sync($project_form['technologies']);
        }else{
            // $project->technologies()->sync([]);
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project)->with('message','Progetto modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->cover_image){
            Storage::disk('public')->delete($project->cover_image);
        }
        $project->delete();
        return redirect(route('admin.projects.index'))->with('deleted','Progetto eliminato con successo');
    }
}
