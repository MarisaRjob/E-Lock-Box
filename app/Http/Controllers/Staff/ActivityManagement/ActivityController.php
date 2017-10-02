<?php

namespace App\Http\Controllers\Staff\ActivityManagement;

use App\Activity;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\User;
use App\UserRole;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ActivityController extends Controller
{
    /**
     * This function is for view brief activities.
     * @return [array]  [return to staff/activity/view]
     */
    public function view() {
        $admins = UserRole::where("role_id", 1)->get();
        $managers = UserRole::where("role_id", 2)->get();
        $staffs = UserRole::where("role_id", 3)->get();
        $activities = Activity::all();
        return view('staff/activity/view', [
            'activities' => $activities,
            'admins' => $admins,
            'managers' => $managers,
            'staffs' => $staffs,
        ]);
    }

    /**
     * This function is for view detailed activity.
     * @param  [int]    $activity_id    [activity id]
     * @return [array]                  [return to staff/activity/detail]
     */
    public function viewdetail($activity_id) {
        $admins = UserRole::where("role_id", 1)->get();
        $managers = UserRole::where("role_id", 2)->get();
        $staffs = UserRole::where("role_id", 3)->get();
        $activity = Activity::where("id", $activity_id)->first();

        if ($activity->assigned == Sentinel::getUser()->id) {
            $activity->reci_status = 1;
        }
        if ($activity->mentioned == Sentinel::getUser()->id) {
            $activity->ment_status = 1;
        }
        $activity->save();
        $activities = Activity::all();

        return view('staff/activity/detail', [
            'activities' => $activities,
            'activity' => $activity,
            'admins' => $admins,
            'managers' => $managers,
            'staffs' => $staffs,
        ]);
    }

    /**
     * This function is for create activity.
     * @param  [array]  $request    [form from staff/activity/view]
     * @return [array]              [return to staff]
     */
    public function create(Request $request) {
        try{
            $activity = new Activity;
            $activity->subject = $request->get('subject');
            $activity->ddl = date("Y-m-d", strtotime($request->get('ddl')));
            $recipient = User::where('email', $request->get('recipient'))->first()->id;
            $activity->assigned = $recipient;
            $activity->creator = Sentinel::getUser()->id;
            if($request->get('mentioned')) {
                $mentioned = User::where('email', $request->get('mentioned'))->first()->id;
                $activity->mentioned = $mentioned;
            }
            if($request->get('case_related')) {
                $activity->related = $request->get('case_related');
            }
            $activity->message = $request->get('message');
            $activity->save();
            @Log::info('Activity Created: ' . Sentinel::getUser()->email . ' Activity Subject: ' . $activity->subject . ' Activity Recipient: '.Sentinel::findById($activity->assigned)->email);
        } catch (InvalidArgumentException $e) {
            print $e;
        }
        return redirect('staff');
    }
}
