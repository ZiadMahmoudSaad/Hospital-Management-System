<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Auth;
class CreateAccount implements CreatesNewUsers
{
    public function create(array $input)
    {
        if ($input['type'] === 'admin') {
            return $this->createAdmin($input);
        }

        return $this->createUser($input);
    }
    use PasswordValidationRules;


    protected function createUser(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        Auth::guard('web')->login($user);
        return $user;
    }


    protected function createAdmin(array $input): Admin
    {
        Validator::make($input, [
            'name' => ['required'],
            'email' => ['required','string','email','unique:admins'],
            'password' => $this->passwordRules(),
        ])->validate();
            $admin = Admin::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        Auth::guard('admin')->login($admin);
        return $admin;
    }
}
