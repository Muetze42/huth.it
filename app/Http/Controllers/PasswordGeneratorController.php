<?php

namespace App\Http\Controllers;


use App\Helpers\WordPress\PasswordHash as WordPressPasswordHash;
use App\Helpers\Joomla\PasswordHash as JoomlaPasswordHash;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class PasswordGeneratorController extends Controller
{
    public function wordpress(Request $request): string
    {
        $password = $request->input('password');

        $wpHash = new WordPressPasswordHash(8, true);

        return $wpHash->HashPassword(trim($password));
    }

    public function joomla(Request $request): string
    {
        $password = $request->input('password');

        $jHash = new JoomlaPasswordHash(10, TRUE);

        return $jHash->HashPassword($password);
    }
}
