<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Tag;
use App\Models\TagArtikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $katakunci=request('search');
        if($katakunci){
         $artikels = Artikel::where( 'name', 'LIKE', '%' . $katakunci . '%' )->paginate(4);
              }  else {
                $artikels = Artikel::latest()->paginate(4);
              } 
            return view('artikel.index',$artikels,compact('artikels'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = Tag::get();// ini jika mau melempar varibel
        return view('artikel.inputartikel',compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'judul'     => 'required|min:5',
            'isi'       => 'required|min:5',
            'tag_id'    => 'required|min:1'
        ]);
        
        $artikel = Artikel::create([
            'judul'     => $request->judul,
            'isi'       => $request->isi,
            
         
        ]);
      
    $artikel->tags()->attach($request->tag_id);
    

    return redirect()->route('artikels.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Artikel $artikel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function edit(Artikel $artikel)
    {
        $artikels = Artikel::latest();
        $tags = Tag::all();
        return view('artikel.edit',compact('artikel','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artikel $artikel)
    {
        $this->validate($request, [
            'judul'     => 'required|min:5',
            'isi'       => 'required|min:5',
            'tag_id'    => 'required|min:1'
            
        ]);

        
            $artikel->update([
                'judul'     => $request->judul,
                'isi'       => $request->isi,
                'tag_id '   => $artikel->tags()->sync($request->tag_id),
            
            ]);

            return redirect()->route('artikels.index')->with(['success' => 'Data Berhasil Diubah!']);
        }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel)
    {
         //delete post
         $artikel->delete();

         //redirect to index
         return redirect()->route('artikels.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
