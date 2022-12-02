<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ErlModel;
use DataTable;
use Validator;

class ErpController extends Controller
{
    public function erp_create(Request $request) {

        $validator = Validator::make($request->all(),[

            'imgpro' => 'required',
            'imgurl' => 'required'

        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = $request->all();

        ErlModel::updateOrCreate(
            ['id' => $request->book_id],
            ['imgpro' => $request->imgpro, 'imgurl' => $request->imgurl]);   

        return response()->json(['status'=>200,'success'=>'Image details save']);
    }

    public function erp_details() {

         return ErlModel::all();
    }
    public function erp_edit($id) {

        return ErlModel::find($id); 
    }
    public function erp_update(Request $request,$id) {

        $update = ErlModel::find($id);
        $update->imgpro = $request->input('imgpro');
        $update->imgurl = $request->input('imgurl');

        return $update->update();
         
    }
    public function erp_delete($id) {

        $delete = ErlModel::find($id);
        return $delete->delete();
         
    }
}
