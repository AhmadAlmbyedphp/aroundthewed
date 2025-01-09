<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Client::all();
        return view('admin.client.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'name'=>'required|string',
           'jop'=>'required|string',
           'covre'=>'image|mimes:jpg,png'
        ]);
        $client=new Client();
        $client->name=$request->get('name');
        if($request->has('covre')){
            $img=$request->file('covre');
                $imgname=time().$client->name.'.'.$img->getClientOriginalExtension();
                $request->file('covre')->storePubliclyAs('clients/',$imgname,['disk'=>'public']);
                $client->covre=$imgname ;
              }
         $client->jop=$request->get('jop');
      $seved= $client->save();
      if($seved){
        session()->flash('massage','clients cerated scssesfuly');
        return redirect()->route('clients.index');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $client=Client::find($id);
          return view('admin.client.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required|string',
            'jop'=>'required|string',
            'covre'=>'image|mimes:jpg,png'
         ]);
         $client=Client::find($id);
        $client->name=$request->get('name');
        if($request->has('covre')){
            $img=$request->file('covre');
                $imgname=time().$client->name.'.'.$img->getClientOriginalExtension();
                $request->file('covre')->storePubliclyAs('clients/',$imgname,['disk'=>'public']);
                $client->covre=$imgname ;
              }
         $client->jop=$request->get('jop');
      $seved= $client->save();
      if($seved){
        session()->flash('massage','clients updated scssesfuly');
        return redirect()->route('clients.index');
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=Client::find($id);
        Storage::disk('public')->delete("clients/$item->cover");
        $deleted= $item->delete();
         if($deleted) {
            session()->flash('massage','clients deleted scssesfuly');
            return redirect()->back();
         }else{
            return 'error';
         }
    }
}
