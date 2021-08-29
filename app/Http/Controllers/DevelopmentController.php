<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;

class DevelopmentController extends Controller
{
    protected string $tomorrow;
    protected string $dayAfterTomorrow;

    public function index()
    {
        //
    }

    public function getColumns(string $table)
    {
        return Schema::getColumnListing($table);
    }
}
