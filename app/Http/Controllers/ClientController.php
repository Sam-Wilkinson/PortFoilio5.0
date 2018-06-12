<?php

namespace App\Http\Controllers;
use App;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClient;

class ClientController extends Controller
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
        $clients = Client::with('projects','testimonials')->orderBy('id','desc')->get();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClient $request)
    {
        $client = new Client;
        $client->name = $request->name;
        $client->description = $request->description;
        if($request->image != null){
            $client->image = App::make('ImageResize')->imageStore($request->image, 'ClientImg');
        }
        $client->social = $request->social;
        if($client->save()){
        return redirect()->route('clients.index')->with([
            "status"=> "Success",
            "message"=> "You have successfully added a Client",
            "color"=> "success"
            ]);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClient $request, Client $client)
    {
        $client->name = $request->name;
        $client->description = $request->description;
        if($request->image != null){
            if(Storage::disk('imageFolder')->exists($project->image)){
                App::make('ImageResize')->imageDelete($client->image, 'ClientImg');
            }
            $client->image = App::make('ImageResize')->imageStore($request->image, 'ClientImg');
        }
        if($request->social != null){
        $client->social = $request->social;
        }
        if($client->save()){
        return redirect()->route('clients.index')->with([
            "status"=> "Success",
            "message"=> "You have successfully modified a client",
            "color"=> "success"
            ]);
        }else{
            return redirect()->route('clients.index')->with([
                "status"=> "Failure",
                "message"=> "Unfortunately the client was not modified",
                "color"=> "danger"
            ]);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if($client->projects->isEmpty()){
        }else{
            foreach($client->projects as $project){
                foreach($project->testimonials as $testimonial){
                    $testimonial->detach();
                    $testimonial->delete();
                }
                $project->delete();
            }
        }
        if($client->delete()){
            return redirect()->route('clients.index')->with([
                "status"=> "Sorry to see it go!",
                "message"=> "You have successfully removed the client, their projects and their testimonials",
                "color"=> "success"
            ]);
        }else{
            return redirect()->route('clients.index')->with([
                "status"=> "Failure",
                "message"=> "Unfortunately the client was not deleted",
                "color"=> "danger"
            ]);
        }
    }
}
