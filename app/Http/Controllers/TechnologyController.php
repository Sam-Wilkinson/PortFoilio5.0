<?php

namespace App\Http\Controllers;

use App\Technology;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTechnology;

class TechnologyController extends Controller
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
        $technologies = Technology::with('projects')->orderBy('id','desc')->get();
        return view('admin.technologies.index',compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::get();
        return view('admin.technologies.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTechnology $request)
    {
        $technology = new Technology;
        $technology->name = $request->name;
        $technology->description = $request->description;
        $technology->competence = $request->competence;
        $technology->save();
        foreach($request->projects as $project)
        {
           $technology->projects()->attach($project);
        }
        return redirect()->route('technologies.index')->with([
            "status"=> "Success",
            "message"=> "You have successfully added a Project",
            "color"=> "success"
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        $projects = Project::get();
        return view('admin.technologies.edit',compact('technology','projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTechnology $request, Technology $technology)
    {
        $technology->name = $request->name;
        $technology->description = $request->description;
        $technology->competence = $request->competence;
        $technology->save();
        if($technology->projects != $request->projects){
            $technology->projects()->detach();
            foreach($request->projects as $project)
            {
            $technology->projects()->attach($project);
            }
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
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->projects()->detach();

        if($technology->delete()){
            return redirect()->route('technologies.index')->with([
                "status"=> "Sorry to see it go!",
                "message"=> "You have successfully removed the technology",
                "color"=> "success"
            ]);
        }else{
            return redirect()->route('technologies.index')->with([
                "status"=> "Failure",
                "message"=> "Unfortunately the technology was not deleted",
                "color"=> "danger"
            ]);
        }
    }
}
