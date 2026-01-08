<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomVerifyEmailController extends Controller
{
    public function __invoke(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (! hash_equals(sha1($user->email), $hash)) {
            abort(403, 'Invalid verification link');
        }

        if (! $user->hasVerifiedEmail()) {
            $user->email_verified_at = now();
            $user->status = 'active';
            $user->save();
        }

        return redirect('/login')
            ->with('success', 'Email verified successfully. Please login.');
    }
}
