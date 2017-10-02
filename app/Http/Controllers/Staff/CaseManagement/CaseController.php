<?php

namespace App\Http\Controllers\Staff\CaseManagement;

use App\Activity;
use App\Avatar;
use App\CaseAddress;
use App\CaseEmail;
use App\CasePhone;
use App\DocType;
use App\ProgramList;
use App\UserRole;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateCaseFormRequest;
use App\Http\Requests\UpdateCaseFormRequest;
use App\Http\Controllers\Controller;
use Mockery\CountValidator\Exception;
use Sentinel;
use DB;
use App\VrfyCode;
use App\UserProfile;
use App\CreateCase;
use App\User;
use App\Docs;
use Illuminate\Support\Facades\File;
use App\WorkHistory;
use App\EduHistory;
use App\AddContact;
use Illuminate\Support\Facades\Storage;


class CaseController extends Controller
{
    /**
     * This function is to show the view case page by listing the cases in the case management
     * @return [array]          [return staff.case.view]
     */
    public function view()
    {
//        $data = CreateCase::all()->sortByDesc('id')->paginate(10);
        //orderBy('id','desc')
        $data = CreateCase::orderBy('id', 'desc')->paginate(10);
        $program_list = ProgramList::all();
        $program_name = null;
        foreach ($program_list as $program) {
            $program_name[$program->id] = $program->program_name;
        }
        return view('staff.case.view', [
            'datas' => $data,
            'program_name' => $program_name,
        ]);
    }

    /**
     * This function is to show the detail page for a specific case 
     * @param  [int]   $id      [case id]
     * @return [array]          true -> [return staff.case.detail] false -> [return error]
     */
    public function viewdetail($id)
    {
        $data = CreateCase::find($id);
        if ($data) {
            $email = $data->email;
            $caseUser = User::where('email', $email)->first();
            $docs = Docs::where('case_id', $id)->get();
            $workhistorys = WorkHistory::where('case_id', $id)->get();
            $eduhistorys = EduHistory::where('case_id', $id)->get();
            $addcontacts = AddContact::where('case_id', $id)->get();
            $cm_id_list = UserRole::where('role_id', 2)->get();
            $ad_id_list = UserRole::where('role_id', 1)->get();
            $all_list = null;
            foreach ($cm_id_list as $cm_id) {
                $cm = User::find($cm_id->user_id);
                $all_list[$cm_id->user_id] = $cm->first_name . ' ' . $cm->last_name;
            }
            foreach ($ad_id_list as $ad_id) {
                $ad = User::find($ad_id->user_id);
                $all_list[$ad_id->user_id] = $ad->first_name . ' ' . $ad->last_name;
            }
            $case_address = CaseAddress::where('case_id', $id)->get();
            $case_phone = CasePhone::where('case_id', $id)->get();
            $case_email = CaseEmail::where('case_id', $id)->get();
            $program_name = null;
            $program_list = ProgramList::all();
            foreach ($program_list as $program) {
                $program_name[$program->id] = $program->program_name;
            }
            $doc_type_name = null;
            $doc_type_abbr = null;
            $doc_type = DocType::all();
            foreach ($doc_type as $doc_name) {
                $doc_type_name[$doc_name->id] = $doc_name->document_type;
                $doc_type_abbr[$doc_name->id] = $doc_name->document_abbr;
            }
            $admins = UserRole::where("role_id", 1)->get();
            $managers = UserRole::where("role_id", 2)->get();
            $staffs = UserRole::where("role_id", 3)->get();
            $avatar = Avatar::where("case_id", $id)->first();
            $activities = Activity::where("related", $email)->get();
            return view('staff.case.detail', [
                'data' => $data,
                'caseUser' => $caseUser,
                'docs' => $docs,
                'workhistorys' => $workhistorys,
                'eduhistorys' => $eduhistorys,
                'addcontacts' => $addcontacts,
                'all_list' => $all_list,
                'case_address' => $case_address,
                'case_phone' => $case_phone,
                'case_email' => $case_email,
                'program_name' => $program_name,
                'doc_type_name' => $doc_type_name,
                'doc_type_abbr' => $doc_type_abbr,
                'admins' => $admins,
                'managers' => $managers,
                'staffs' => $staffs,
                'avatar' => $avatar,
                'activities' => $activities,
            ]);
        } else {
            return redirect('error');
        }
    }
}
