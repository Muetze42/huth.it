<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;

class DevelopmentController extends Controller
{
    public function index()
    {
        exit;
    }

    public function getColumns(string $table): array
    {
        return Schema::getColumnListing($table);
    }
}
