<?php

declare(strict_types = 1);

namespace fileSaver\Http\Controllers;

use fileSaver\Controllers\ImageSaver;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use fileSaver\Http\Requests;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use fileSaver\Entity\Album;

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
     * @param  Album $album
     * @return View
     */
    public function albumIndex(Request $request, Album $album)
    {
        return view('album/index', [
            'album' => $album,
        ]);
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

            if(!is_null($photoLink)) {
                $path = $this->fs->upload($request->input('photoLink'),'gallery', 'jpg', 100);
                $album->image = $path;
            } elseif ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $this->fs->upload($file,'gallery', 'jpg', 100);
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
     * @param  Album $album
     * @return View
     */
    public function albumEdit(Request $request, Album $album)
    {
        $this->validate($request, [
            'name' => 'required|max:70',
        ]);

        return view('album/edit', [
            'album' => $album
        ]);
    }

    /**
     * Set deleted album.
     *
     * @param  Request $request
     * @param  Album $album
     * @return Response
     */
    public function albumDelete(Request $request, Album $album)
    {
        return new Response();
    }
}