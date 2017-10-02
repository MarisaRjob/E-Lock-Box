<?php

namespace App\Http\Controllers\Youth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel;
use DB;
use App\User;
use App\UserRole;
use App\UserProfile;
use App\Avatar;
use App\CaseAddress;
use App\CaseEmail;
use App\CasePhone;
use App\Docs;
use App\CreateCase;
use App\WorkHistory;
use App\EduHistory;
use App\AddContact;
use App\DocType;
use App\ProgramList;
use App\Survey;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class YouthController extends Controller
{
    /**
     * This function is to provide data for youth home page.
     * @return [array]          [return youth.youth]
     */
    public function getHome() {
        //$user_id = Sentinel::getUser()->id;
        $email = Sentinel::getUser()->email;
        //$caseUser = User::where('email', $email)->first();
        $id = @CreateCase::where('email', $email)->first()->id;
        if($id != null) {
            $data = CreateCase::where('id', $id)->first();
            //dd($data);
            //echo $id;
            $docs = Docs::where('case_id', $id)->Where('visible', 'visible')->get();
            //dd($docs);
            $workhistorys = WorkHistory::where('case_id', $id)->get();
            $eduhistorys = EduHistory::where('case_id', $id)->get();
            $addcontacts = AddContact::where('case_id', $id)->get();
            $cm_id_list = UserRole::where('role_id', 2)->get();
            $ad_id_list = UserRole::where('role_id', 1)->get();
            $all_list = null;
            $program_name = null;
            $program_id = $data->program;
            //dd($program_id);
            $program_list = ProgramList::all();
            foreach ($program_list as $program) {
                $program_name[$program->id] = $program->program_name;
            }
            $case_address = CaseAddress::where('case_id', $id)->get();
            $case_phone = CasePhone::where('case_id', $id)->get();
            $case_email = CaseEmail::where('case_id', $id)->get();
            $doc_type_name = null;
            $doc_type_abbr = null;
            $doc_type = DocType::all();
            $surveys = Survey::where('program', $program_id)->get();
            //dd($survey);
            foreach ($cm_id_list as $cm_id) {
                $cm = User::find($cm_id->user_id);
                $all_list[$cm_id->user_id] = $cm->first_name . ' ' . $cm->last_name;
            }
            $cm_email = User::where('id', $data->cm_id)->first()->email;

            //dd($cm_email);
            foreach ($doc_type as $doc_name) {
                $doc_type_name[$doc_name->id] = $doc_name->document_type;
                $doc_type_abbr[$doc_name->id] = $doc_name->document_abbr;
            }
            $avatar = Avatar::where("case_id", $id)->first();
            return view('youth.youth', ['docs' => $docs,
                'workhistorys' => $workhistorys,
                'eduhistorys' => $eduhistorys,
                'addcontacts' => $addcontacts,
                'all_list' => $all_list,
                'doc_type_name' => $doc_type_name,
                'doc_type_abbr' => $doc_type_abbr,
                'data' => $data,
                'program_name' => $program_name,
                'case_address' => $case_address,
                'case_phone' => $case_phone,
                'case_email' => $case_email,
                'avatar' => $avatar,
                'cm_email' => $cm_email,
                'surveys' => $surveys,
            ]);
        } else {
            abort(404);
        }

    }

    /**
     * This function is to log out youth.
     * @return [array]          [return homepage]
     */
}
