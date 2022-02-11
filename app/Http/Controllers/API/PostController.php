<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Imagen;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * http://127.0.0.1:8000/api/post
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return response()->json([
            'data' => $posts,
            'mensaje' => 'Listado',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;

        if ($request->hasFile("cover")) {
            $file = $request->file("cover");
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(\public_path("cover/"), $imageName);

            $post = new Post([
                "titulo" => $request->titulo,
                //"autor" =>$request->autor,
                // "post" =>$request->post,
                "cover" => $imageName,
            ]);
            $post->save();
        }

        if ($request->hasFile("images")) {
            $files = $request->file("images");
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $request['post_id'] = $post->id;
                $request['imagen'] = $imageName;
                $file->move(\public_path("/imagenes"), $imageName);
                Imagen::create($request->all());

            }
        }

        return response()->json([
            'data' => $post,
            'galeria' => $files,
            'mesaje' => 'Registro Guardado',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //dar shoy
    public function show($id)
    {
        $post = Post::find($id);
        $gal = Post::find($id)->imagens;

        return response()->json([
            "data" => $post,
            "galeria" => $gal,
            "status" => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //dar update y mostra la importacion  y ruta
    //public function update(Request $request,$id)
    public function update(Request $request, $id)
    {
        //return $request;
        $post = Post::find($id);
        //return $request;
        if ($request->hasFile("cover")) {
            if (File::exists("cover/" . $post->cover)) {
                File::delete("cover/" . $post->cover);
            }
            $file = $request->file("cover");
            $post->cover = time() . "_" . $file->getClientOriginalName();
            $file->move(\public_path("/cover"), $post->cover);
            $request['cover'] = $post->cover;
        }

        $post->update([
            "titulo" => $request->titulo,

            "cover" => $post->cover,
        ]);

        if ($request->hasFile("images")) {
            $files = $request->file("images");
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $request["post_id"] = $id;
                $request["imagen"] = $imageName;
                $file->move(\public_path("images"), $imageName);
                Imagen::create($request->all());

            }
        }

        return response()->json([
            'data' => $post,
            //'galeria' => $files,
            'mesaje' => 'Registro Actualizado',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    //dar delete
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (File::exists("cover/" . $post->cover)) {
            File::delete("cover/" . $post->cover);
        }
        $images = Imagen::where("post_id", $post->id)->get();
        foreach ($images as $image) {
            if (File::exists("imagenes/" . $image->image)) {
                File::delete("imagenes/" . $image->image);
            }
        }
        $post->delete();
        return response()->json([
            'data' => $post,
            'mesaje' => 'Registro Borrado',
        ]);

    }

   /* public function deleteimage($id)
    {
        $images = Imagen::findOrFail($id);
        if (File::exists("images/" . $images->image)) {
            File::delete("images/" . $images->image);
        }

        Imagen::find($id)->delete();
        return back();
    }

    public function deletecover($id)
    {
        $cover = Post::findOrFail($id)->cover;
        if (File::exists("cover/" . $cover)) {
            File::delete("cover/" . $cover);
        }
        return 'Registro borrado';
    }
*/
}
