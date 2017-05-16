<?php

declare(strict_types=1);

namespace fileSaver\Http\Controllers;

use fileSaver\Controllers\ImageSaver;
use fileSaver\Entity\Photo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use fileSaver\Http\Requests;
use Symfony\Component\HttpFoundation\RedirectResponse;
use fileSaver\Entity\Album;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class AlbumController extends Controller
{
    protected $fs;

    public function __construct(ImageSaver $saver)
    {
        $this->fs = $saver;
    }

    /**
     * Show album.
     *
     * @param  Request $request
     * @param  int $album
     * @return View|Response
     */
    public function albumShow(Request $request, int $album)
    {
        $album = Album::find($album);
        if (!is_null($album)) {
            return view('album/show', [
                'album' => $album,
                'photos' => Photo::where('album_id', $album->id)->get()
            ]);
        } else {
            return new Response('', 404);
        }
    }

    /**
     * Create new album.
     * @param  Request $request
     * @return View|RedirectResponse
     */
    public function albumNew(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:70',
                'file' => 'max:10000|mimes:jpeg,png,jpg',
                'photoLink' => 'url'
            ]);

            $album = new Album();

            $album->name = $request->input('name');
            $photoLink = $request->input('photoLink');

            if (!empty($photoLink)) {
                $path = $this->fs->upload($photoLink, 'gallery', 'jpg', 100);
                $album->image = $path;
            } elseif ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $this->fs->upload($file, 'gallery', 'jpg', 100);
                $album->image = $path;
            }
            $album->save();
            return new RedirectResponse('/');
        } else {
            return view('album/new');
        }
    }

    /**
     * Edit album.
     *
     * @param  Request $request
     * @param  int $album
     * @return View|RedirectResponse|Response
     */
    public function albumEdit(Request $request, int $album)
    {
        $album = Album::find($album);

        if (is_null($album)) {
            return new Response('', 404);
        }

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:70',
                'file' => 'max:10000|mimes:jpeg,png,jpg'
            ]);

            $album->name = $request->input('name');

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $this->fs->upload($file, 'gallery', 'jpg', 100);
                if ($path && !is_null($album->image)) {
                    $this->fs->removeFile($album->image);
                }
                $album->image = $path;
            }
            $album->save();

            return new RedirectResponse('/');
        } else {
            return view('album/edit', [
                'album' => $album
            ]);
        }
    }

    /**
     * Delete album.
     *
     * @param  Request $request
     * @param  int $album
     * @return RedirectResponse|Response
     */
    public function albumDelete(Request $request, int $album)
    {
        $album = Album::find($album);

        if (!is_null($album)) {
            $this->fs->removeFile($album->image);
            $this->deleteAllAlbomPhoto($album->id);
            $album->delete();
            return new RedirectResponse("/");
        } else {
            return new Response('', 404);
        }
    }

    private function deleteAllAlbomPhoto($albumId)
    {
        $photos = Photo::where('album_id', $albumId)->get();
        foreach ($photos as $photo) {
            $this->fs->removeFile($photo->image);
        }
    }
}