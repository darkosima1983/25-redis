<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\NewAvatarRequest;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

   public function changeAvatar(NewAvatarRequest $request)
    {
        // obriši staru sliku
        $avatar = Auth::user()->avatar;
        if($avatar !== null){
            File::delete("storage/images/avatars/$avatar");
        }
        
        $name = uniqid().".webp";
        $file = $request->file('profile_image');
        
        // Intervention Image v3 sintaksa
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)->toWebp(90);

        Storage::disk('public')->put("images/avatars/$name", (string) $image);

        // upiši u bazu
        Auth::user()->update([
            'avatar' => $name,
        ]);

        return redirect()
            ->route('profile.edit')
            ->with('status', 'avatar-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
