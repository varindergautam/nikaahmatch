<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\User;
use Validator;
use Redirect;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {
        $this->rules = [
             'father'   => ['max:255'],
             'mother'   => ['max:255'],
             'sibling.*'  => ['max:255'],
             'grand_mother'  => ['max:255'],
             'grand_father'  => ['max:255'],
             'nana'  => ['max:255'],
             'nani'  => ['max:255'],
             'father_prof'  => ['max:255'],
             'father_educ'  => ['max:255'],
             'mother_prof'  => ['max:255'],
             'mother_educ'  => ['max:255'],
             'sibling_m_s.*'  => ['max:255'],
             'Yon_old.*'  => ['max:255'],
             'relation.*'  => ['max:255'],
             'father_phone' => ['required', 'max:255'],
             'mother_phone' => ['required','max:255'],
             'sibiling_phone.*' => ['max:255'],
             'guardian_name' => ['max:255'],
             'guardian_phone' => ['required','max:255'],
         ];
         $this->messages = [
             'father.max'   => translate('Max 255 characters'),
             'mother.max'   => translate('Max 255 characters'),
             'sibling.*.max'  => translate('Max 255 characters'),
             'grand_mother.max'  => translate('Max 255 characters'),
             'grand_father.max'  => translate('Max 255 characters'),
             'nana.max'  => translate('Max 255 characters'),
             'nani.max'  => translate('Max 255 characters'),
             'father_prof.max'  => translate('Max 255 characters'),
             'father_educ.max'  => translate('Max 255 characters'),
             'mother_prof.max'  => translate('Max 255 characters'),
             'mother_educ.max'  => translate('Max 255 characters'),
             'sibling_m_s.*.max'  => translate('Max 255 characters'),
             'Yon_old.*.max'  => translate('Max 255 characters'),
             'relation.*.max'  => translate('Max 255 characters'),
             'father_phone.max' => translate('Max 255 characters'),
             'mother_phone.max' => translate('Max 255 characters'),
             'sibiling_phone.*.max' => translate('Max 255 characters'),
             'guardian_name.max' => translate('Max 255 characters'),
             'guardian_phone.max' => translate('Max 255 characters'),
             'father_phone.required' => translate('Father phone number is required'),
             'mother_phone.required' => translate('Mother phone number is required'),  
         ];

         $rules = $this->rules;
         $messages = $this->messages;
         $validator = Validator::make($request->all(), $rules, $messages);

         if ($validator->fails()) {
             flash(translate('Something went wrong'))->error();
             return Redirect::back()->withErrors($validator);
         }

         $family = Family::where('user_id', $id)->first();
         if(empty($family)){
             $family           = new Family;
             $family->user_id  = $id;
         }

            $family->father = $request->father;
            $family->mother = $request->mother;
            $family->father_phone = $request->father_phone;
            $family->mother_phone = $request->mother_phone;
            $family->sibiling_phone = json_encode($request->input('sibiling_phone'));
            $family->guardian_name = $request->guardian_name;
            $family->guardian_phone = $request->guardian_phone;
            $family->sibling = json_encode($request->input('sibling'));
            $family->Yon_old = json_encode($request->input('Yon_old'));
            $family->relation = json_encode($request->input('relation'));
            $family->grand_father = $request->grand_father;
            $family->grand_mother = $request->grand_mother;
            $family->nana = $request->nana;
            $family->nani = $request->nani;
            $family->father_prof = $request->father_prof;
            $family->father_educ = $request->father_educ;
            $family->mother_prof = $request->mother_prof;
            $family->mother_educ = $request->mother_educ;
            $family->sibling_m_s = json_encode($request->input('sibling_m_s'));
          
            
            if($family->save()){
             User::where('id', $id)->update(['is_profile_updated' => 1]);
             flash(translate('Family info has been updated successfully'))->success();
             return back();
         }
         else {
             flash(translate('Sorry! Something went wrong.'))->error();
             return back();
         }

     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
