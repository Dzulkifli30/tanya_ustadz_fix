<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Content::latest()->paginate(4);

        //render view with posts
        return view('welcome', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('tanya');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tanya=Content::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'pertanyaan' => $request->pertanyaan,
        ]);
        $rules = array(
            'nama' => 'required|string',
            'email' => 'required|string',
            'pertanyaan' => 'required|unique|max:255',
        );
        $cek = Validator::make($request->all(),$rules);
        return redirect()->route('content.index')->with(['success' => 'Data Berhasil Disimpan!']);

    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        if ($query) {
            $posts = Content::where('pertanyaan', 'like', '%' . $query . '%')->paginate(4);
        } else {
            $posts = Content::paginate(4);
        }

        return view('search', ['posts' => $posts]);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Content::findOrFail($id);
        return view('detail', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function jawab($id)
    {
        $post = Content::findOrFail($id);
        return view('jawab', compact('post'));

    }
    public function kirimJawaban(Request $request)
    {
        $post = Content::find($request->input('post_id'));

        if ($request->has('video')) {
            $videoData = $request->input('video');
            list($type, $videoData) = explode(';', $videoData);
            list(, $videoData) = explode(',', $videoData);
            $videoData = base64_decode($videoData);
            $path = 'videos/' . uniqid() . '.webm';
            Storage::disk('public')->put($path, $videoData);

            $post->jawaban = $path;
            $post->save();
        }

        return redirect()->route('content.index')->with('success', 'Jawaban berhasil dikirim.');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
