<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Traits\OfferTrait;
use App\Http\Requests\offerRequest;
use LaravelLocalization;



class OfferController extends Controller
{
    use OfferTrait;

public function create(){

return view('ajaxoffers.create');

}


public function store(offerRequest $request){
  //  $file_name= $this -> saveImage($request -> photo,'images/offers');
     $file_name = $this->saveImage($request->photo, 'images/offers');

              //insert
            $offer=  Offer::create([
                'photo' => $file_name,
                  'name_ar' => $request->name_ar,
                  'name_en' =>   $request->name_en,
                  'price' =>  $request->price,
                  'details_ar' => $request->details_ar,
                  'details_en' => $request->details_en,
              ]);
              if($offer)              
                      return response() -> json([
                      
                          'status' => true,
                          'msg' => 'تم اضافة العرض بنجاح',

                      ]);
              else
                      return response() -> json([
                                      
                          'status' => false,
                          'msg' => 'فشل الحفظ',

                     ]);
}



            public function all(){
                  $offers = Offer::select('id',
                  'price',
                  'photo',
                  'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
                  'details_' . LaravelLocalization::getCurrentLocale() . ' as details'
                  )->limit(10)->get();
                    return view ('ajaxoffers.all', compact('offers'));
            }
        
            
            public function delete(Request $request){

              $offer = offer::find($request -> id);
              if(!$offer)
              return  redirect()->back()-> with(['error'=>__('messages.offer not exist')]);
              $offer ->delete();
              return response() -> json([
                      
                'status' => true,
                'msg' => 'تم اضافة العرض بنجاح',
                'id' => $request->id,

            ]);
            
            }
          
            public function edit(Request $request ){
 
              //Offer::findOrFail($offer_id);
             $offer= Offer::find($request->offer_id);
                     if($offer)
                     $offer = Offer::select('id','name_ar','name_en','details_ar','details_en','price') -> find($request->offer_id);
                     return view ('ajaxoffers.edit', compact('offer'));
                     
                     return response()->json([
                      
                      'status' =>false,
                      'msg' => 'هذا العرض غير موجود',
                    // 'id' => $request->id,
      
                  ]);
                         
                         
                         
             }
            
    public  function update(Request $request){
      $offer = Offer::find($request -> offer_id);
      if (!$offer)
          return response()->json([
              'status' => false,
              'msg' => 'هذ العرض غير موجود',
          ]);

      //update data
      $offer->update($request->all());

      return response()->json([
          'status' => true,
          'msg' => 'تم  التحديث بنجاح',
      ]);
  }

}
