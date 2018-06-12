<?php

namespace App\Http\Controllers;
use App;
use App\Project;
use App\Client;
use App\Technology;
use App\Http\Requests\StoreProject;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Checks login before displaying any projects
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('client','testimonials','technologies')->orderBy('id','desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::get();
        $technologies = Technology::get();
        return view('admin.projects.create', compact('clients','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProject $request)
    {
        $project = new Project;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->image = $request->image;
        $project->URL = $request->URL;
        $project->date = $request->date;
        $project->client_id= $request->client;
        if($request->image != null){
            $project->image = App::make('ImageResize')->imageStore($request->image, 'ProjectImg');
        }
        $project->save();
        foreach($request->technologies as $tech)
        {
           $project->technologies()->attach($tech);
        }
        return redirect()->route('projects.index')->with([
            "status"=> "Success",
            "message"=> "You have successfully added a Project",
            "color"=> "success"
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $clients = Client::get();
        $technologies = Technology::get();
        return view('admin.projects.edit',compact('project','clients','technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProject $request, Project $project)
    {
        $project->name = $request->name;
        $project->description = $request->description;
        $project->image = $request->image;
        $project->URL = $request->URL;
        $project->date = $request->date;
        $project->client_id= $request->client;
        if($request->image != null){
            if(Storage::disk('imageFolder')->exists($project->image)){
                $project->image = App::make('ImageResize')->imageDelete($request->image, 'ProjectImg');
            }
            $project->image = App::make('ImageResize')->imageStore($request->image,'ProjectImg');
        }
        $project->save();
        $project->technologies()->detach();
        foreach($request->technologies as $tech)
        {
           $project->technologies()->attach($tech);
        }
        return redirect()->route('projects.index')->with([
            "status"=> "Success",
            "message"=> "You have successfully added a Project",
            "color"=> "success"
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->technologies()->detach();
        $project->testimonials()->detach();
        if($project->delete()){
            return redirect()->route('projects.index')->with([
                "status"=> "Sorry to see it go!",
                "message"=> "You have successfully removed the project",
                "color"=> "success"
            ]);
        }else{
            return redirect()->route('projects.index')->with([
                "status"=> "Failure",
                "message"=> "Unfortunately your project was not deleted",
                "color"=> "danger"
            ]);
        }
    }
}
