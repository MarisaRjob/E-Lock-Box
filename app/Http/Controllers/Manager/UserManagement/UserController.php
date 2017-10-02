<?php

namespace App\Http\Controllers\Manager\UserManagement;

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\UserProfile;
use App\UserRole;
use App\UserStatus;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    /**
     * View users in a list - name, email, phone number, level, status, action for details
     * @return manager.user.view
     */
    public function view() {
        $users = User::all();
        $profiles = UserProfile::all();
        $user_roles = UserRole::all();
        $statuss = UserStatus::all();
        $i = 0;
        foreach ($users as $user) {
            $data[$i]['id'] = $user->id;
            $data[$i]['ln'] = $user->last_name;
            $data[$i]['fn'] = $user->first_name;
            $data[$i]['em'] = $user->email;
            foreach ($profiles as $profile) {
                if ($profile->user_id == $user->id) {
                    $data[$i]['ph'] = $profile->phone_number;
                    break;
                } else {
                    $data[$i]['ph'] = "";
                }
            }
            foreach ($user_roles as $user_role) {
                if ($user_role->user_id == $user->id) {
                    if ($user_role->role_id == 1) {
                        $data[$i]['ro'] = "Admin";
                    } elseif ($user_role->role_id == 2) {
                        $data[$i]['ro'] = "Case Manager";
                    } elseif ($user_role->role_id == 3) {
                        $data[$i]['ro'] = "Staff";
                    } elseif ($user_role->role_id == 4) {
                        $data[$i]['ro'] = "Youth";
                    } else {
                        $data[$i]['ro'] = "Phantom";
                    }
                    break;
                }else {
                    $data[$i]['ro'] = "Phantom";
                }
            }
            foreach ($statuss as $status) {
                if ($status->user_id == $user->id) {
                    $data[$i]['ac'] = "Active";
                    break;
                } else {
                    $data[$i]['ac'] = "Inactive";
                }
            }
            $i++;
        }
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $collection = new Collection($data);
        $perPage = 20;
        $currentPageSearchResults = $collection->slice(($currentPage -1) * $perPage, $perPage)->all();
        $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        return view('manager.user.view', [
            'datas' => $paginatedSearchResults,
        ]);
    }

    /**
     * View detail information of a user - name, level, email, phone, status, address
     * @param int $user_id
     * @return mamager.user.detail
     */
    public function viewdetail($user_id) {
        $user = User::where('id', $user_id)->first();
        $profile = UserProfile::where('user_id', $user_id)->first();
        $role_id = UserRole::where('user_id', $user_id)->first()->role_id;
        $status_boolean = UserStatus::where('user_id', $user_id)->first();
        $status = "Inactive";
        $role = 'N/A';
        $editrole = null;
        if($role_id == 1) {
            $role = 'Administrator';
            $editrole = 'Admins';
        } else if($role_id == 2) {
            $role = 'Manager';
            $editrole = 'Managers';
        } else if($role_id == 3) {
            $role = 'Staff';
            $editrole = 'Staff';
        } else if($role_id == 4) {
            $role = 'Youth';
            $editrole = 'Youths';
        }
        if($status_boolean) {
            $status = "Active";
        }
        return view('manager.user.detail', [
            'user_id' => $user_id,
            'user' => $user,
            'profile' => $profile,
            'role' => $role,
            'editrole' => $editrole,
            'status' =>$status,
        ]);
    }

    /**
     * Edit own information - first name, last name, phone, address 1, address 2, city, state, zip, level
     * @param int $user_id
     * @param Request $request - User's inputs
     * @return manager.user.detail
     */
    public function update($user_id, Request $request) {
        $user = User::where('id', $user_id)->first();
        $profile = UserProfile::where('user_id', $user_id)->first();
        $role = UserRole::where('user_id', $user_id)->first();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $profile->phone_number = $request->phone_number;
        $profile->address1 = $request->address1;
        $profile->address2 = $request->address2;
        $profile->city = $request->city;
        $profile->state = $request->state;
        $profile->zip = $request->zip;
        $user->save();
        $profile->save();
        $role->save();
        @Log::info('User Edited: ' . Sentinel::getUser()->email . ' User: ' . $user->email);
        return redirect()->back();
    }
}
