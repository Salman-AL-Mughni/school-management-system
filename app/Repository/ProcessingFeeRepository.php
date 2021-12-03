<?php


namespace App\Repository;


use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{

    public function index()
    {
        $ProcessingFees = ProcessingFee::all();
        return view('pages.ProcessingFee.index',compact('ProcessingFees'));
    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('pages.ProcessingFee.add',compact('student'));
    }

    public function edit($id)
    {
        $ProcessingFee = ProcessingFee::findorfail($id);
        return view('pages.ProcessingFee.edit',compact('ProcessingFee'));
    }

    public function store($request)
    {
        DB::beginTransaction();


            // حفظ البيانات في جدول معالجة الرسوم
            $ProcessingFee = new ProcessingFee();
            $ProcessingFee->date = date('Y-m-d');
            $ProcessingFee->student_id = $request->student_id;
            $ProcessingFee->amount = $request->Debit;
            $ProcessingFee->description = $request->description;
            $ProcessingFee->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = new StudentAccount();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'ProcessingFee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $ProcessingFee->id;
            $students_accounts->Debit = 0.00;
            $students_accounts->credit = $request->Debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('ProcessingFee.index');
        

    }

    public function update($request)
    {
        DB::beginTransaction();


            // تعديل البيانات في جدول معالجة الرسوم
            $ProcessingFee = ProcessingFee::findorfail($request->id);;
            $ProcessingFee->date = date('Y-m-d');
            $ProcessingFee->student_id = $request->student_id;
            $ProcessingFee->amount = $request->Debit;
            $ProcessingFee->description = $request->description;
            $ProcessingFee->save();

            // تعديل البيانات في جدول حساب الطلاب
            $students_accounts = StudentAccount::where('processing_id',$request->id)->first();;
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'ProcessingFee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $ProcessingFee->id;
            $students_accounts->Debit = 0.00;
            $students_accounts->credit = $request->Debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('ProcessingFee.index');

    }

    public function destroy($request)
    {

            ProcessingFee::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }


}
