<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Sentinel;
use DB;
use App\Http\Requests\VrfycodeFormRequest;
use Mail;

class LoginController extends Controller
{
    //
    /**
     * This function is for login.
     * @return [null]                  [return to login page]
     */
    public function login()
    {
        if ($user = Sentinel::check()) {
            $admin = Sentinel::findRoleByName('Admins');
            $manager = Sentinel::findRoleByName('Managers');
            $staff = Sentinel::findRoleByName('Staff');
            $youth = Sentinel::findRoleByName('Youths');
            if ($user->inRole($admin)) {
                return redirect()->intended('admin');
            } elseif ($user->inRole($manager)) {
                return redirect()->intended('manager');
            } elseif ($user->inRole($staff)) {
                return redirect()->intended('staff');
            } elseif ($user->inRole($youth)) {
                return redirect()->intended('youth');
            }
        }
        return view('login.login');
    }

    /**
     * This function is for check user name and password.
     * @param  [array]  $request        [form from login/login]
     * @return [null]                   [return to login/login or redirectVrfyCode()]
     */
    public function authenticate(Request $request)
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $input = $request->only('email', 'password');
        try {
            if (Sentinel::authenticate($input)) {
                Sentinel::logout();
                $code = rand(100000, 999999);
                $email = $request->only('email');
                $user_id = DB::table('users')->where('email', $email)->first()->id;
                DB::table('code')->where('user_id', $user_id)->update(['code' => $code]);
                $this->basic_email($user_id);
                return $this->redirectVrfyCode($user_id, $email, $code);
            }
            @Log::warning('User Login Failed: ' . $request->get('email') . ' ip: ' . $ip . ' Reason: Wrong username or password.');
            return redirect()->back()->withInput()->withErrorMessage('Invalid credentials provided');
        } catch (NotActivatedException $e) {
            return redirect()->back()->withInput()->withErrorMessage('User Not Activated.');
        } catch (ThrottlingException $e) {
            return redirect()->back()->withInput()->withErrorMessage($e->getMessage());
        } catch (\Swift_TransportException $e) {
            abort(404);
        }
    }

    /**
     * This function is for redirect to verify page.
     * @param  [int]        $user_id        [user id]
     * @param  [string]     $email          [user email]
     * @param  [int]        $code           [code]
     * @return [array]                      [return to login/verify]
     */
    protected function redirectVrfyCode($user_id, $email, $code)
    {
        return view('login.verify', [
            'user_id' => $user_id,
            'email' => $email,
        ]);
    }

    /**
     * This function is for verify code.
     * @param  [array]    $request      [form form login/verify]
     * @return [null]                   [return to redirectWhenLoggedIn]
     */
    protected function vrfy(VrfycodeFormRequest $request)
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $input = $request->only('user_id', 'vrfycode');
        $userid = $request->get('user_id');
        $excode = DB::table('code')->where('user_id', $input['user_id'])->first()->code;
        if ($excode == $input['vrfycode']) {
            return $this->redirectWhenLoggedIn($userid);
        }
        @Log::warning('User Login Failed: ' . Sentinel::findById($userid)->email . ' ip: ' . $ip . ' Reason: Wrong verification code.');
        return redirect('/login')->withInput()->withErrorMessage('Wrong verification code');
    }

    /**
     * This function is for check user name and password.
     * @param  [int]    $user_id        [user id]
     * @return [array]                  [return to home]
     */
    protected function redirectWhenLoggedIn($userid)
    {
        $user = Sentinel::findById($userid);
        $admin = Sentinel::findRoleByName('Admins');
        $manager = Sentinel::findRoleByName('Managers');
        $staff = Sentinel::findRoleByName('Staff');
        $youth = Sentinel::findRoleByName('Youths');
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        if ($user->inRole($admin)) {
            Log::info('Admin User Login: ' . $user->email . ' ip: ' . $ip);
            Sentinel::login($user);//create session!! do not delete!!
            return redirect()->intended('admin');
        } elseif ($user->inRole($manager)) {
            Log::info('Manager User Login: ' . $user->email . ' ip: ' . $ip);
            Sentinel::login($user);//create session!! do not delete!!
            return redirect()->intended('manager');
        } elseif ($user->inRole($staff)) {
            Log::info('Staff User Login: ' . $user->email . ' ip: ' . $ip);
            Sentinel::login($user);//create session!! do not delete!!
            return redirect()->intended('staff');
        } elseif ($user->inRole($youth)) {
            Log::info('Youth User Login: ' . $user->email . ' ip: ' . $ip);
            Sentinel::login($user);//create session!! do not delete!!
            return redirect()->intended('youth');
        } else {
            return redirect()->intended('/');
        }
    }

    /**
     * This function is sending email.
     * @param  [int]    $user_id        [user id]
     * @return [null]                   [return null]
     */
    public function basic_email($user_id)
    {
        $first_name = DB::table('users')->where('id', $user_id)->first()->first_name;
        $code = DB::table('code')->where('user_id', $user_id)->first()->code;
        $email = DB::table('users')->where('id', $user_id)->first()->email;
        $imgPath = 'https://cdn.shopify.com/s/files/1/1090/4924/files/Living_Advantage_Logo_large.png?13792516517561167664';
        $data = ['name' => $first_name, 'code' => $code, 'email' => $email, 'imgPath' => $imgPath];
        Mail::send('mail', $data, function ($message) use ($email, $first_name) {
            $message->to($email, $first_name)->subject('e-Lockbox Verification code');
            $message->from('marisafkj@gmail.com', 'Living Advantage Inc.');
        });
    }

    /**
     * This function is for logout.
     * @return [null]                  [return to home page]
     */
    public function logout()
    {
        @Log::info('User Logout: ' . Sentinel::getUser()->email);
        Sentinel::logout();
        return redirect()->intended('/');
    }

}
