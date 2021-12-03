<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Graeds;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGraeds;
use App\models\Classroom;
use App\models\Graed;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class GraedController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $Graeds = Graed::all();
        return view('pages.Graeds.Graeds', compact('Graeds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreGraeds $request)
    {

        /*if (Graed::where('Name->ar', $request->Name)->orwhere('Name->en', $request->Name)->exists()) {
            return redirect()->back()->withErrors(trans('Graeds_trans.exises'));
        } //هذا الكود لمنع ادخال قيمة مكررة او موجودة في الداتا
*/
        $validated = $request->validated();
        $Grade = new Graed();
        $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
        $Grade->Notes = $request->Notes;
        $Grade->save();
        toastr()->success(trans('messages.success'));
        return redirect()->route('Graeds.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(StoreGraeds $request)
    {
        $validated = $request->validated();
        $Grade = Graed::findOrFail($request->id);//هذا الكود لارجاع القيمة المراد تعديلها ولا يظهر رقم id في url
        $Grade->update([
            $Grade->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
            $Grade->Notes = $request->Notes,
        ]);
        toastr()->success(trans('messages.Update'));
        return redirect()->route('Graeds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {

    $MyClass_id = Classroom::where('Grade_id',$request->id)->pluck('Grade_id');//هذا الكود يقول اذهب على جدول الصفوف اذا كان قيمة المرحلة =المرحلة لا تحذف

    if($MyClass_id->count() == 0){

        $Grades = Graed::findOrFail($request->id)->delete();//هذا الكود لارجاع القيمة المراد تعديلها ولا يظهر رقم id في url
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Graeds.index');
    }

    else{

        toastr()->error(trans('Graeds_trans.delete_Grade_Error'));
        return redirect()->route('Graeds.index');

    }
}


}
