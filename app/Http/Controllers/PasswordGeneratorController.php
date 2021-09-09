<?php

namespace App\Http\Controllers;


use App\Helpers\WordPress\PasswordHash as WordPressPasswordHash;
use App\Helpers\Joomla\PasswordHash as JoomlaPasswordHash;
use Illuminate\Http\Request;

class PasswordGeneratorController extends Controller
{
    public function hash(Request $request): array
    {
        $password = $request->input('password');

        $wpHash = new WordPressPasswordHash(8, true);
        $jHash = new JoomlaPasswordHash(10, TRUE);

        return [
            'wordpress' => $wpHash->HashPassword(trim($password)),
            'joomla' => $jHash->HashPassword($password),
        ];
    }
}
