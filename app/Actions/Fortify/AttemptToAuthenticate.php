<?php

namespace App\Actions\Fortify;

use App\Services\Auth\MultiGuardAuthenticator;
use Illuminate\Http\Request;

class AttemptToAuthenticate
{
    public function __invoke(Request $request)
    {
        return app(MultiGuardAuthenticator::class)
            ->authenticate($request);
    }
}
