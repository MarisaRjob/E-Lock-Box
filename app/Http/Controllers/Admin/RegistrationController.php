<?php

namespace App\Http\Controllers\Admin;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationFormRequest;
use Illuminate\Support\Facades\Log;
use Sentinel;
use App\Http\Requests;
use DB;
use App\VrfyCode;
use App\UserProfile;
use App\Http\Controllers\Controller;


class RegistrationController extends Controller
{
    /**
     * @return registration.create
     */
    public function create()
    {
        return view('registration.create');
    }

    /**
     * Create a high-level user including admin, case manager and staff
     * Using email, password, first name, last name, phone, address 1, address 2, city, state, zip, level
     * @param RegistrationFormRequest $request
     * @return registration.create
     */
    public function store(RegistrationFormRequest $request)
    {
        //get email, pwd, f_n, l_n
        try {
            $input = $request->only('email', 'password', 'first_name', 'last_name');
            ////register and activate, store account into users table and activations table
            $user = Sentinel::registerAndActivate($input);
            //get role
            $role = $request->only('role');
            //find a role from roles table
            $usersRole = Sentinel::findRoleByName($role);
            ////assign a role to this user and store in role_users table
            $usersRole->users()->attach($user);
            ////set a default code and store in code table
            $email = $request->only('email');
            //find user id
            $user_id = DB::table('users')->where('email', $email)->first()->id;
            $default_code = 100000000;
            //save user id and default code into code table
            $newcode = new VrfyCode;
            $newcode->user_id = $user_id;
            $newcode->code = $default_code;
            $newcode->save();
            //save other information into profile table
            $newprofile = new UserProfile;
            $newprofile->user_id = $user_id;
            $newprofile->phone_number = $request->get('phone_number');
            $newprofile->address1 = $request->get('address1');
            $newprofile->address2 = $request->get('address2');
            $newprofile->city = $request->get('city');
            $newprofile->state = $request->get('state');
            $newprofile->zip = $request->get('zip');
            $newprofile->save();
            @Log::info('Account Created: ' . Sentinel::getUser()->email . ' Account: ' . $request->get('email') . ' Role: ' . $request->get('role'));
            //return back with message
            return redirect('admin/user/create')->withFlashMessage('User Successfully Created and Activated!');
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withErrors(array("message" => "Failure"));
        }

    }
}
