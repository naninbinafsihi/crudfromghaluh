<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\Artikel;
use App\Models\TagArtikel;
use Illuminate\Http\Request;

class TagArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Tag $tag)
    {
        $tag = Tag::latest()->paginate(5);
        return view('tag.inserttag',compact('tag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name'           =>'required|min:0',
            
        ]);

        //create post
        
        Tag::create([
            'name'    =>$request->name,
            
        ]);
        return redirect()->route('tags.index')->with(['success' => 'Data Berhasil Disimpan!']);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag_Artikel  $tag_Artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Tag_Artikel $tag_Artikel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag_Artikel  $tag_Artikel
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag_Artikel $tag_Artikel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag_Artikel  $tag_Artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag_Artikel $tag_Artikel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag_Artikel  $tag_Artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag_Artikel $tag_Artikel)
    {
        //delete post
        $artikel->delete();

        //redirect to index
        return redirect()->route('artikel.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
