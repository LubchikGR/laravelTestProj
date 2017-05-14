<?php
declare(strict_types = 1);
namespace fileSaver\Http\Controllers;

use Illuminate\Http\Request;

use fileSaver\Http\Requests;
use Symfony\Component\HttpFoundation\Response;

class PhotoController extends Controller
{
    protected $redirectTo = '/album/{id}';

    /**
     * Show photo.
     *
     * @param  Request  $request
     * @return Response
     */
    public function photoIndex(Request $request)
    {
        return view('tasks.index');
    }

    /**
     * Save new photo.
     *
     * @param  Request  $request
     * @return Response
     */
    public function photoNew(Request $request)
    {
        return view('tasks.index');
    }

    /**
     * Edit photo.
     *
     * @param  Request  $request
     * @return Response
     */
    public function photoEdit(Request $request)
    {
        return view('tasks.index');
    }

    /**
     * Delete photo.
     *
     * @param  Request  $request
     * @return Response
     */
    public function photoDelete(Request $request)
    {
        return view('tasks.index');
    }
}
