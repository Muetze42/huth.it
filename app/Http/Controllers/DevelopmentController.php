<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DevelopmentController extends Controller
{
    public function index()
    {
        dd(implode('', range('.', '%')));
        foreach(range('.', '%') as $letter) {
        }

        exit;

        Hash::make('A');
    }

    public function getColumns(string $table): array
    {
        return Schema::getColumnListing($table);
    }
}
