<?php


namespace App\Repository;


use App\Models\Fee;
use App\Models\Grade;
use App\models\Graed;

class FeesRepository implements FeesRepositoryInterface
{

    public function index(){

        $fees = Fee::all();
        $Grades = Graed::all();
        return view('pages.Fees.index',compact('fees','Grades'));

    }

    public function create(){

        $Grades = Graed::all();
        return view('pages.Fees.add',compact('Grades'));
    }

    public function edit($id){

        $fee = Fee::findorfail($id);
        $Grades = Graed::all();
        return view('pages.Fees.edit',compact('fee','Grades'));

    }


    public function store($request)
    {


            $fees = new Fee();
            $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fees->amount  =$request->amount;
            $fees->Grade_id  =$request->Grade_id;
            $fees->Classroom_id  =$request->Classroom_id;
            $fees->description  =$request->description;
            $fees->year  =$request->year;
            $fees->Fee_type  =$request->Fee_type;
            $fees->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees.index');




    }

    public function update($request)
    {

            $fees = Fee::findorfail($request->id);
            $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fees->amount  =$request->amount;
            $fees->Grade_id  =$request->Grade_id;
            $fees->Classroom_id  =$request->Classroom_id;
            $fees->description  =$request->description;
            $fees->year  =$request->year;
            $fees->Fee_type  =$request->Fee_type;
            $fees->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fees.index');
        }




    public function destroy($request)
    {

            Fee::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();



    }
}
