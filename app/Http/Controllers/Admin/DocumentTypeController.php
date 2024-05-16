<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentType;
class DocumentTypeController extends Controller
{
    public function store(Request $request){

        $this->validate($request,[
            'document_type' => 'required',
            'code_type' => 'required',
            'total_document' => 'required'
        ]);
        try{
            DB::beginTransaction();

                $documentType = new DocumentType();
                $documentType->document_type =$request->document_type;
                $documentType->code_type =$request->code_type;
                $documentType->total_document =$request->total_document;
                $documentType->status =0;
                $documentType->save();

                DB::commit();
                return redirect()->back()->with('success','সফলভাবে সংরক্ষণ করা হয়েছে');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }

    }



    public function update(Request $request, string $id)
    {
        try{
            DB::beginTransaction();
                $documentType = DocumentType::find($id);
                $documentType->document_type =$request->document_type;
                $documentType->code_type =$request->code_type;
                $documentType->total_document =$request->total_document;
                $documentType->status =0;
                $documentType->save();

                DB::commit();
                return redirect()->back()->with('info','সফলভাবে সংশোধন করা হয়েছে');


            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('error_404')->with('error','some thing went wrong ');
            }
    }
}
