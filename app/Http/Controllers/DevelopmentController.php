<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DevelopmentController extends Controller
{
    public function index()
    {
        //
    }

    public function getColumns(string $table)
    {
        return Schema::getColumnListing($table);
    }
}
