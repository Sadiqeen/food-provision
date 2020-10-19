<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LanguageController extends Controller
{
    /**
     * Switch language
     *
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index($locale)
    {
        if (!in_array($locale, ['en', 'th'])) {
            abort(404);
        }

        \Session::put('locale',$locale);

        if (\Auth::check()) {
            switch ($locale) {
                case 'th':
                    $locale = 2;
                    break;

                default:
                    $locale = 1;
                    break;
            }

            $user = User::find(\Auth::id());
            $user->locale = $locale;
            $user->save();
        }

        return redirect()->back();
    }
}
