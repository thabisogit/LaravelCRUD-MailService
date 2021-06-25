<?php

namespace App\Http\Controllers;

use App\User;
use App\UserLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public static function getLanguage($language_id)
    {
        $language = UserLanguage::find($language_id);
        return ($language == null ? '' :$language->getAttributes()["language"]);
    }

}
