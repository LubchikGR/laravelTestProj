<?php
declare(strict_types=1);

namespace fileSaver\Http\Controllers;

use fileSaver\Controllers\ImageSaver;
use fileSaver\Entity\Album;
use fileSaver\Entity\Photo;
use Illuminate\Http\Request;
use fileSaver\Http\Requests;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class PhotoController extends Controller
{
    protected $fs;

    public function __construct(ImageSaver $saver)
    {
        $this->fs = $saver;
    }

    /**
     * Show photo.
     *
     * @param  Request $request
     * @param  int $photo
     * @return View|RedirectResponse
     */
    public function photoShow(Request $request, int $photo)
    {
        $photo = Photo::find($photo);
        if(!is_null($photo)){
            return view('photo/show', [
                'photo' => $photo
            ]);
        } else {
            return new RedirectResponse($this->getRedirectUrl());
        }

    }

    /**
     * Save new photo.
     *
     * @param  Request $request
     * @return View|RedirectResponse
     */
    public function photoNew(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:70',
                'file' => 'max:10000|mimes:jpeg,png,jpg',
                'album_id' => 'required',
                'photoLink' => 'url'
            ]);

            $photo = new Photo();

            $photo->name = $request->input('name');
            $photo->album_id = $request->input('album_id');
            $photoLink = $request->input('photoLink');

            if (!empty($photoLink)) {
                $path = $this->fs->upload($request->input('photoLink'), 'gallery/photo', 'jpg', 100);
                $photo->image = $path;
            } elseif ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $this->fs->upload($file, 'gallery/photo', 'jpg', 100);
                $photo->image = $path;
            }

            if(!is_null($photo->image)){
                $album = Album::find($photo->album_id );
                $album->photoCounter = $album->photoCounter + 1;
                $album->save();
            }
            $photo->save();
            return new RedirectResponse("/album/show/$photo->album_id");
        } else {
            return view('photo/new', [
                'albums' => Album::all()
            ]);
        }
    }

    /**
     * Edit photo.
     *
     * @param  Request $request
     * @param  int $photo
     * @return View|RedirectResponse|Response
     */
    public function photoEdit(Request $request, int $photo)
    {
        $photo = Photo::find($photo);

        if(is_null($photo)) {
            return new Response('',404);
        }

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:70',
                'file' => 'max:10000|mimes:jpeg,png,jpg',
                'album_id' => 'required',
                'photoLink' => 'url'
            ]);

            $photo->name = $request->input('name');
            $photo->album_id = $request->input('album_id');

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $this->fs->upload($file, 'gallery/photo', 'jpg', 100);
                if ($path && !is_null($photo->image)) {
                    $this->fs->removeFile($photo->image);
                }
                $photo->image = $path;
            }
            $photo->save();

            return new RedirectResponse("/album/show/$photo->album_id");
        } else {
            return view('photo/edit', [
                'photo' => $photo,
                'albums' => Album::all()
            ]);
        }
    }

    /**
     * Delete photo.
     *
     * @param  Request $request
     * @param  int $photo
     * @return Response
     */
    public function photoDelete(Request $request, int $photo)
    {
        $photo = Photo::find($photo);

        if (!is_null($photo)) {
            $albumId = $photo->album_id;
            $this->fs->removeFile($photo->image);
            $album = Album::find($albumId);
            $album->photoCounter = $album->photoCounter - 1;
            $album->save();
            $photo->delete();
            return new RedirectResponse("/album/show/$albumId");
        } else {
            return new Response('',404);
        }
    }
}
