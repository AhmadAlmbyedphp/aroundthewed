<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Portfolil;
use Illuminate\Http\Request;

class PortfolilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =Portfolil::all();
        return view('admin.portfolis.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portfolis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
        'name'=>'required|string',
        'descrediten'=>'required|max:500',
        'covre'=>'image'
       ]);
       $portfolil=new Portfolil();
       $portfolil->name=$request->get('name');
       $portfolil->descrediten=$request->get('descrediten');
       if($request->has('covre')){
        $img=$request->file('covre');
        $imgname=time().$portfolil->name.'.'.$img->getClientOriginalExtension();
                $request->file('covre')->storePubliclyAs('portfolils/',$imgname,['disk'=>'public']);
                $portfolil->covre=$imgname ;
       }
        $seved=$portfolil->save();
          if($seved){
            session()->flash('massage','portfolils updated scssesfuly');
            return redirect()->route('portfolis.index');
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolil  $portfolil
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolil $portfolil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolil  $portfolil
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $portfolils=Portfolil::find($id);
           return view('admin.portfolis.edit',compact('portfolils'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolil  $portfolil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $request->validate([
                'name'=>'required|string',
                'descrediten'=>'required|max:500',
                'covre'=>'image'
            ]);
           $portfolil= Portfolil::find($id);
           $portfolil->name=$request->get('name');
           $portfolil->descrediten=$request->get('descrediten');
           if($request->has('covre')){
            $img=$request->file('covre');
            $imgname=time().$portfolil->name.'.'.$img->getClientOriginalExtension();
                    $request->file('covre')->storePubliclyAs('portfolils/',$imgname,['disk'=>'public']);
                    $portfolil->covre=$imgname ;
           }
            $seved=$portfolil->save();
              if($seved){
                session()->flash('massage','portfolils updated scssesfuly');
                return redirect()->route('portfolis.index');
              }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolil  $portfolil
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=Portfolil::find($id);
        Storage::disk('public')->delete("portfolils/$item->cover");
        $deleted= $item->delete();
         if($deleted) {
            session()->flash('massage','portfolils deleted scssesfuly');
            return redirect()->back();
         }else{
            return 'error';
         }
    }
}
