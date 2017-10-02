<?php

namespace App\Http\Controllers\admin\ActivityManagement;

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
use Psy\Exception\ErrorException;

class ActivityController extends Controller
{
    /**
     * This function is for view brief activities.
     * @return [array]  [return to admin/activity/view]
     */
    public function view() {
        $admins = UserRole::where("role_id", 1)->get();
        $managers = UserRole::where("role_id", 2)->get();
        $staffs = UserRole::where("role_id", 3)->get();
        $activities = Activity::all();
        return view('admin/activity/view', [
            'activities' => $activities,
            'admins' => $admins,
            'managers' => $managers,
            'staffs' => $staffs,
        ]);
    }

    /**
     * This function is for view detailed activity.
     * @param  [int]    $activity_id    [activity id]
     * @return [array]                  [return to admin/activity/detail]
     */
    public function viewdetail($activity_id) {
        $admins = UserRole::where("role_id", 1)->get();
        $managers = UserRole::where("role_id", 2)->get();
        $staffs = UserRole::where("role_id", 3)->get();
        $activity = Activity::where("id", $activity_id)->first();

        if($activity->assigned == Sentinel::getUser()->id) {
            $activity->reci_status = 1;
        }
        if($activity->mentioned == Sentinel::getUser()->id) {
            $activity->ment_status = 1;
        }
        $activity->save();
        $activities = Activity::all();

        return view('admin/activity/detail', [
            'activities' => $activities,
            'activity' => $activity,
            'admins' => $admins,
            'managers' => $managers,
            'staffs' => $staffs,
        ]);
    }

    /**
     * This function is for edit activity.
     * @param  [int]    $activity_id    [activity id]
     * @param  [array]  $request        [form from admin/activity/detail]
     * @return [array]                  [return to admin]
     */
    public function update($activity_id, Request $request) {
        try{
            $activity = Activity::where('id', $activity_id)->first();
            $activity->subject = $request->get('subject');
            $activity->task = $request->get('task');
            $activity->ddl = date("Y-m-d", strtotime($request->get('ddl')));
            $recipient = @User::where('email', $request->get('recipient'))->first()->id;
            if($recipient == null) {
                throw new ErrorException('Invaid user input');
            }
            if($activity->assigned == $recipient) {
                $activity->assigned = $recipient;
            } else {
                $activity->assigned = $recipient;
                $activity->reci_status = 0;
            }
            if($request->get('mentioned')) {
                $mentioned = @User::where('email', $request->get('mentioned'))->first()->id;
                if($mentioned == null) {
                    throw new ErrorException('Invaid user input');
                }
                if($activity->mentioned == $mentioned) {
                    $activity->mentioned = $mentioned;
                } else {
                    $activity->mentioned = $mentioned;
                    $activity->ment_status = 0;
                }
            }
            $activity->message = $request->get('message');
            if($activity->assigned == Sentinel::getUser()->id) {
                if($request->get('unread') == 1) {
                    $activity->reci_status = 1;
                } else {
                    $activity->reci_status = 0;
                }
            }
            if($activity->mentioned == Sentinel::getUser()->id) {
                if($request->get('unread') == 1) {
                    $activity->ment_status = 1;
                } else {
                    $activity->ment_status = 0;
                }
            }
            @Log::info('Activity Edited: ' . Sentinel::getUser()->email . ' Activity Subject: ' . $activity->subject . ' Activity Recipient: '.Sentinel::findById($activity->assigned)->email);
            $activity->save();
        } catch (InvalidArgumentException $e) {
            print $e;
        } catch (ErrorException $e) {
            return redirect()->back()->withErrors(["Invalid recipient!"]);
        }
        return redirect('admin');
    }

    /**
     * This function is for create activity.
     * @param  [array]  $request    [form from admin/activity/view]
     * @return [array]              [return to admin]
     */
    public function create(Request $request) {
        try{
            $activity = new Activity;
            $activity->subject = $request->get('subject');
            $activity->ddl = date("Y-m-d", strtotime($request->get('ddl')));
            $recipient = @User::where('email', $request->get('recipient'))->first()->id;
            if($recipient == null) {
                throw new ErrorException('Invaid user input');
            }
            $activity->assigned = $recipient;
            $activity->creator = Sentinel::getUser()->id;
            if($request->get('mentioned')) {
                $mentioned = @User::where('email', $request->get('mentioned'))->first()->id;
                if($mentioned == null) {
                    throw new ErrorException('Invaid user input');
                }
                $activity->mentioned = $mentioned;
            }
            if($request->get('case_related')) {
                $activity->related = $request->get('case_related');
            }
            $activity->message = $request->get('message');
            $activity->save();
            @Log::info('Activity Created: ' . Sentinel::getUser()->email . ' Activity Subject: ' . $activity->subject . ' Activity Recipient: '.Sentinel::findById($activity->assigned)->email);
            if($request->get('case_related')) {
                return redirect()->back();
            } else {
                return redirect('admin')->withFlashMessage('Activity successfull created!');
            }
        } catch (InvalidArgumentException $e) {
            print $e;
        } catch (ErrorException $e) {
            return redirect()->back()->withErrors(["Invalid recipient!"]);
        }
    }

    /**
     * This function is for delete activity.
     * @param  [int]    $activity_id    [activity id]
     * @return [array]                  [return to admin]
     */
    public function delete($activity_id) {
        $activity = Activity::where('id', $activity_id)->first();
        $activity->delete();
        @Log::info('Activity Deleted: ' . Sentinel::getUser()->email . ' Activity Subject: ' . $activity->subject . ' Activity Recipient: '.Sentinel::findById($activity->assigned)->email);
        return redirect('admin');
    }
}
