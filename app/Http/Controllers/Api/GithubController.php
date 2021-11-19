<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GithubController extends Controller
{
    public function form(Request $request)
    {
        Log::debug("form\n".print_r($request->all(), true));
        if ($request->files) {
            Log::debug("form request->files->all()\n".print_r($request->files->all(), true));
            Log::debug("form request->files\n".print_r($request->files, true));
        }
    }

    public function json(Request $request)
    {
        Log::debug("json\n".print_r($request->all(), true));
        if ($request->files) {
            Log::debug("json request->files->all()\n".print_r($request->files->all(), true));
            Log::debug("json request->files\n".print_r($request->files, true));
        }
    }
}
