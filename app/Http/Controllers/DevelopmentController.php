<?php

namespace App\Http\Controllers;

use App\Models\RepoWatch;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class DevelopmentController extends Controller
{
    protected string $tomorrow;
    protected string $dayAfterTomorrow;
    protected string $gitHubUrl = 'https://github.com/:package';
    protected string $gitHubApiUrl = 'https://api.github.com/repos/:package/releases/latest';

    public function index()
    {
        //
    }

    public function getColumns(string $table)
    {
        return Schema::getColumnListing($table);
    }
}
