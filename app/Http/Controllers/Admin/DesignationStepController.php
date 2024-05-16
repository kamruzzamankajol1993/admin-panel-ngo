<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Illuminate\Support\Str;
use Mail;
use DB;
use PDF;
use Carbon\Carbon;
use Response;
use App\Models\Branch;
use App\Models\Admin;
use App\Models\DesignationList;
use App\Models\DesignationStep;
use App\Models\AdminDesignationHistory;
class DesignationStepController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index(){




       $getPreviousData =  AdminDesignationHistory::select('admin_id')->groupBy('admin_id')
        ->get();

        $convert_name_title = $getPreviousData->implode("admin_id", " ");
        $separated_data_title = explode(" ", $convert_name_title);

        //dd($getPreviousData);

        if (is_null($this->user) || !$this->user->can('assignedEmployee.view')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }
try{
               \LogActivity::addToLog('designation step list ');

               $branchLists = Branch::where('id','!=',1)->orderBy('branch_step','asc')->get();





               $designationLists = DesignationList::where('id','!=',1)->
               orderBy(
                 Branch::select('branch_step')
                     ->whereColumn('designation_lists.branch_id', 'branches.id'),
                 'asc'
             )->orderBy('designation_serial','asc')->get();

          $designationStepLists = DesignationStep::latest()->get();
          //$designationLists = DesignationList::latest()->get();
          $users = Admin::where('id','!=',1)->get();
          $users_as = Admin::whereNotIn('id',$separated_data_title)->where('id','!=',1)->get();

               return view('admin.designationStepList.index',compact('users_as','users','branchLists','designationLists','designationStepLists'));

            } catch (\Exception $e) {
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }
           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('assignedEmployee.edit')) {
                //abort(403, 'Sorry !! You are Unauthorized to Add !');
                return redirect()->route('error_404');
            }
            \LogActivity::addToLog('designation step store ');
//dd($request->all());
//
            $request->validate([
                'designation_list_id' => 'required',
                'adminId' => 'required',
                'admin_job_start_date' => 'required',
              ]);



              try{
                DB::beginTransaction();
             $dateFormate = date('Y-m-d', strtotime($request->admin_job_start_date));



                //dd($dateFormate);


                $newData = Admin::find($request->adminId);
                $newData->branch_id = $request->branchId;
                $newData->designation_list_id = $request->designation_list_id;
                $newData->admin_job_start_date = $dateFormate;
                $newData->save();



                $saveHistoryData = new AdminDesignationHistory();
                $saveHistoryData->admin_id = $request->adminId;
                $saveHistoryData->admin_job_start_date = $dateFormate;
                $saveHistoryData->designation_list_id = $request->designation_list_id;
                $saveHistoryData->save();


            //   }


          //  }



          DB::commit();
    return redirect()->route('assignedEmployee.index')->with('success','Added successfully!');
} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}


        }





        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('designationStepUpdate')) {
                //abort(403, 'Sorry !! You are Unauthorized to Update !');
                return redirect()->route('error_404');
            }
            try{
                DB::beginTransaction();
            \LogActivity::addToLog('designation step update ');
            $medicine = DesignationStep::findOrFail($id);

            $input = $request->all();

            $medicine->fill($input)->save();
            DB::commit();
    return redirect()->route('designationStepList.index')->with('success','Updated successfully!');

} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}

        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('designationStepDelete')) {
            //abort(403, 'Sorry !! You are Unauthorized to Delete !');
            return redirect()->route('error_404');
        }
        try{
            DB::beginTransaction();
        \LogActivity::addToLog('designation step delete ');
        DesignationStep::destroy($id);
        DB::commit();
        return redirect()->route('designationStepList.index')->with('error','Deleted successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }
}
