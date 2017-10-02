<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserRole;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;

use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    //
    public function initResetPwd()
    {
        return view('admin.resetpwd');
    }

    public function sendEmailPwd(Request $request)
    {
        $u = User::where('email', $request->email)->first();
        if ($u) {
            $user_id = $u->id;
            $role_id = UserRole::where('user_id', $user_id)->first()->role_id;
//            if ($role_id == 1) {
            $user = Sentinel::findById($user_id);

//                dd(md5($user->email));
//                $pwd = $request->password;
//                Sentinel::update($user, array('password' => $pwd));
//                Activation::remove($user);
//                Activation::create($user);
//                Activation::complete($user, '3w3xqSg2pcIoXk1bCBPOovQEAzvrGEzm');
            $this->resetEmail($user);
            return redirect()->back()->withFlashMessage('Please check your email to verify the changes.');
//            } elseif ($role_id == 2) {
//                return redirect()->back()->withFlashMessage('You are case manager, your malicious attempt has been reported to admin.');
//            } elseif ($role_id == 3) {
//                return redirect()->back()->withFlashMessage('You are staff, your malicious attempt has been reported to admin.');
//            } else {
//                return redirect()->back()->withFlashMessage('You are youth, please contact with your case manager to request password change.');
//            }
        } else {
            return redirect()->back()->withFlashMessage('Email not exist');
        }
    }

    public function resetEmail($user)
    {
        $email = $user->email;
        $user_id = $user->id;
        $first_name = $user->first_name;
        $mdemail = md5($user->email);
        $time = time();
        $mdtime = md5($time);
        $mdfn = md5($first_name);
        $random = rand(100000, 999999);
        $mdrandom = md5($random);
        $link = "http://www.mylaspace.com/reset/" . $time . "/" . $user_id . "/" . $mdemail . "/" . $mdrandom;
        $imgPath = 'https://cdn.shopify.com/s/files/1/1090/4924/files/Living_Advantage_Logo_large.png?13792516517561167664';
        $data = ['name' => $first_name, 'email' => $email, 'imgPath' => $imgPath, 'link' => $link];
        Mail::send('resetemail', $data, function ($message) use ($email, $first_name) {
            $message->to($email, $first_name)->subject('e-Lockbox Reset Password');
            $message->from('livingadvantageelockbox@gmail.com', 'Living Advantage Inc.');
        });
    }

    public function resetPwd()
    {
        $url = URL::current();

        return view('admin.reset', [
            'url' => $url,
        ]);
    }

    public function storeNewPwd($time, $user_id, $mdemail, $mdrandom, Request $request)
    {
        $user = Sentinel::findById($user_id);
        $cur_time = time();
        if ($cur_time - $time > 1800) {
            echo "Expired Link";
        } else {
            if (md5($user->email) == $mdemail) {
                Sentinel::update($user, array('password' => $request->password));
                @Log::info('Password Self-Reset: ' . $user->email);
                return redirect('/');
            } else {
                echo "Authentication Failure";
            }
        }
    }
}
