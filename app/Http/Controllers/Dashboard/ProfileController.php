<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Locales;

class ProfileController extends Controller
{
    public function edit()
    {

        $contries = Countries::getNames();
        $locales = Locales::getNames();
        return view(
            'dashboard.profile.edit',
            [
                'user' => Auth::user(),
                'contries' => $contries,
                'locales' => $locales
            ]
        );
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'gender' => 'in:male,female',
            'country' => ['required', 'string', 'size:2'],
        ]);
        // dd($request->except('_token', '_method'));
        $user = $request->user();


        #I can shorcut all this code using [  fill()  ] function
        // $profile = $user->profile();
        // if ($profile->first_name)
        //     $user->profile()->update($request->all());
        // else
        //     $user->profile()->create($request->all());

        ## this will update or create profile
        $user->profile->fill($request->except('_token', '_method'))->save();

        return redirect()->route('dashboard.profile.edit')->with('success', 'Profile updated');
    }
}
