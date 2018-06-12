<?php

namespace App\Http\Controllers;

use App\Testimonial;
use App\Project;
use App\Client;
use Illuminate\Http\Request;

class TestimonialController extends Controller
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
        $testimonials = Testimonial::orderBy('id','desc')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::orderBy('id','desc')->get();
        $clients = Client::orderBy('id','desc')->get();
        return view('admin.testimonials.create', compact('projects','clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        $projects = Project::orderBy('client_id','desc')->get();
        $clients = Client::orderBy('id','desc')->get();
        return view('admin.testimonials.edit', compact('testimonial','projects','clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->projects()->detach();
        if($testimonial->delete()){
            return redirect()->route('testimonials.index')->with([
                "status"=> "Sorry to see it go!",
                "message"=> "You have successfully removed the testimonial",
                "color"=> "success"
            ]);
        }else{
            return redirect()->route('testimonials.index')->with([
                "status"=> "Failure",
                "message"=> "Unfortunately the testimonial was not deleted",
                "color"=> "danger"
            ]);
        }
    }
}
