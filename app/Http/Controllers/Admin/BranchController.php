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
use App\Models\ForwardingLetterOnulipi;
class BranchController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

   public function checkBranch(Request $request){

    $branchStep = $request->branchStep;

    $designationCount = Branch::where('branch_step',$branchStep )
    //->where('designation_serial',$designationSerial )
    ->count();


return $designationCount;

   }


   public function showBranchStep(Request $request){

    $branchId = $request->branchId;
    $branchStep = Branch::where('id',$branchId)->value('branch_step');

    return $branchStep;

   }

    public function index(){


        if (is_null($this->user) || !$this->user->can('branchAdd')) {
            //abort(403, 'Sorry !! You are Unauthorized to View !');
            return redirect()->route('error_404');
               }

try{
               \LogActivity::addToLog('branch list ');


          $branchLists = Branch::where('id','!=',1)->orderBy('branch_step','asc')->get();

          $stepValue = Branch::orderBy('id','desc')->max('branch_step');
          return view('admin.branchList.index',compact('branchLists','stepValue'));

        } catch (\Exception $e) {
            return redirect()->route('error_404')->with('error','some thing went wrong ');
        }

          //dd($stepValue);


           }


           public function store(Request $request){

            if (is_null($this->user) || !$this->user->can('branchAdd')) {
                //abort(403, 'Sorry !! You are Unauthorized to Add !');
                return redirect()->route('error_404');
            }

            $request->validate([
                'branch_name' => 'required',
                'branch_code' => 'required',
              ]);

              try{
                DB::beginTransaction();
              \LogActivity::addToLog('branch store ');




             $input = $request->all();

             Branch::create($input);


             DB::commit();

    return redirect()->route('branchList.index')->with('success','Added successfully!');
} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}


        }



        public function update(Request $request,$id){

            if (is_null($this->user) || !$this->user->can('branchUpdate')) {
                //abort(403, 'Sorry !! You are Unauthorized to Update !');
                return redirect()->route('error_404');
            }
            try{
                DB::beginTransaction();
            \LogActivity::addToLog('branch update ');

            $medicine = Branch::findOrFail($id);

            $input = $request->all();

            $medicine->fill($input)->save();
            DB::commit();
    return redirect()->route('branchList.index')->with('success','Updated successfully!');

} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->route('error_404')->with('error','some thing went wrong ');
}

        }


        public function destroy($id)
    {

        if (is_null($this->user) || !$this->user->can('branchDelete')) {
           // abort(403, 'Sorry !! You are Unauthorized to Delete !');
           return redirect()->route('error_404');
        }
        try{
            DB::beginTransaction();
        \LogActivity::addToLog('branch delete ');


        Branch::destroy($id);
        DB::commit();
        return redirect()->route('branchList.index')->with('error','Deleted successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('error_404')->with('error','some thing went wrong ');
    }
    }
}
