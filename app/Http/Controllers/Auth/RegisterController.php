<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Uzzal\Acl\Models\Role;
use Uzzal\Acl\Models\UserRole;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'is_active' => true,
            'password' => Hash::make($data['password']),
        ]);
        $this->assignRoles($user->user_id);
        return $user;
    }

    private function assignRoles($user_id, $roles = []){
        if(count($roles)==0){
            $t = Role::where('name', 'Default')->first();
            if($t){
                $roles = array($t->role_id);
            }
        }

        $curr = extract_roles(UserRole::where('user_id', $user_id)->get());
        $delete = array_diff($curr, $roles);
        $insert = array_diff($roles, $curr);

        $data = [];
        foreach ($insert as $v) {
            $data[] = [
                'user_id' => $user_id,
                'role_id' => $v
            ];
        }

        DB::transaction(function () use ($user_id, $delete, $data) {
            UserRole::where('user_id', $user_id)->whereIn('role_id', $delete)->delete();
            UserRole::bulkInsert($data);
        });
    }
}
