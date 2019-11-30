<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \FileUploader;
use Illuminate\Support\Facades\File;
use App\Plan;
use App\City;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.dashboard-index');
    }

    public function albumDoMes()
    {
        /**
         * Get album photos
         */
        $path = storage_path('app/public/') . 'albums/' . auth()->user()->id . '/' . date('n') . '/';

        // Verify if there is a folder for the project, if not creates one
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        // Get files from folder
        $filesInFolder = File::files(storage_path('app/public/albums/') . auth()->user()->id . '/' . date('n'));
        $files = array();
        foreach ($filesInFolder as $file) {
            array_push($files, [
                'name' => $file->getFilename(),
                'size' => $file->getSize(),
                'type' => File::mimeType($file->getPathname()),
                'file' => '/storage/albums/' . auth()->user()->id . '/' . date('n') . '/' . $file->getFilename(),
            ]);
        }

        return view('dashboard.dashboard-album-do-mes', [
            'files' => $files,
        ]);
    }

    public function meusPedidos()
    {
        return view('dashboard.dashboard-meus-pedidos');
    }

    public function dadosCadastrais()
    {
        // Get all cities
        $cities = City::all();

        // Get all available plans
        $plans = Plan::all();

        // Avatar path
        $path = 'storage/user_images/';
        $avatar_url = auth()->user()->profile_picture;

        // Get user avatar
        $avatar = auth()->user()->profile_picture ? array(
            "name" => $avatar_url,
            "type" => FileUploader::mime_content_type($path . $avatar_url),
            "size" => filesize($path . $avatar_url),
            "file" => asset($path . $avatar_url),
            "data" => array(
                "readerForce" => true
            )
        ) : null;

        return view('dashboard.dashboard-dados-cadastrais', [
            'plans' => $plans,
            'avatar' => $avatar,
            'cities' => $cities,
        ]);
    }

    public function editarDadosCadastrais()
    {
        return view('dashboard.dashboard-editar-dados-cadastrais');
    }
}
