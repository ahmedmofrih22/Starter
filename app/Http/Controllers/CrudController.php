<?php

namespace App\Http\Controllers;
use App\Models\Offer;
use App\Models\Video;
use Illuminate\Http\Requests;
use App\Http\Requests\offerRequest;
use LaravelLocalization;
use App\Traits\offerTrait;
use App\Events\VideoViewer;

//use App\Models\Offer;

//use Illuminate\Support\Facsdes\Validator;
use Validator;
class CrudController extends Controller

{

use offerTrait;

    public function __construct()
    {

    }

    public function getOffers(){
        return Offer::get();
    }


    // public function store(){
    //     Offer::create([
    //         'name' => 'offer3',
    //         'price' => '500',
    //         'details' => 'offer details',
    //    ]);

    // }
    // protected  function getmassge(){
    //     return [
    //         'name.required' =>__('messages.offer name required'),
    //         'name.unique' =>__('messages.offer name unique'),

    //         'price.required' => __('messages.Offer Price'),
    //         'details.required' =>__ ('messages.Offer details ar'),
    //     ];


    // }
    // protected  function getrules(){
    //     return $rules= [
    //         'name' => 'required|max:100|unique:offers,name',
    //         'price' => 'required|numeric',
    //         'details' => 'required',
    //     ];


    // }

    public function create(){


return view('offers.create');
    }



    public function store(offerRequest $request){
        //app()->setLocale('ar');

//validator data befor insert


//$rules = $this -> getrules();
//$massge = $this -> getmassge();

//$validator= Validator::make($request -> all(), $rules,$massge);
//if($validator -> fails()){
    //return $validator -> errors();
   // return json_encode($validator ->errors(), JSON_UNESCAPED_UNICODE);
   //return redirect()->back()->withErrors($validator)->withInputs($request -> all());

//}
//save photo


$file_name= $this -> saveImage($request -> photo,'images/offers');
      // $file_name = $this->saveImage($request->photo, 'images/offers');

                //insert
                Offer::create([
                    'photo' => $file_name,
                    'name_ar' => $request->name_ar,
                    'name_en' =>   $request->name_en,
                    'price' =>  $request->price,
                    'details_ar' => $request->details_ar,
                    'details_en' => $request->details_en,
                ]);

                     return redirect()->back()->with(['success' => 'تم اضافه العرض بنجاح ']);

            }












            // public function getAllOffers(){
            // $offers = Offer::select('id',
            // 'price',
            // 'photo',

            // 'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            // 'details_' . LaravelLocalization::getCurrentLocale() . ' as details'
            // )->get();


            ############## pagination #############
            public function getAllOffers(){
                $offers = Offer::select('id',
            'price',
            'photo',

            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details'
            )->paginate(PAGINATION_COUNT);
             //  return view ('offers.all', compact('offers'));
               return view ('offers.paginations', compact('offers'));

            }









    public function editOffer($offer_id){

     //Offer::findOrFail($offer_id);
    $offer= Offer::find($offer_id);
            if(!$offer)

                return  redirect()->back();

                $offer = Offer::select('id','name_ar','name_en','details_ar','details_en','price') -> find($offer_id);
                return view ('offers.edit', compact('offer'));
    }

    public function delete($offer_id){
$offer = offer::find($offer_id);
if(!$offer)
return  redirect()->back()-> with(['error'=>__('messages.offer not exist')]);
$offer ->delete();
return  redirect()->route('offers.all')->with(['success'=>__('messages.offer deleted successfully')]);
    }

    public function updateOffer(offerRequest $request,$offer_id){

        $offer = Offer::find($offer_id);
        if(!$offer)
        return  redirect()->back();

        // udate date
        $offer -> update($request -> all());
        return  redirect()->back() -> with(['success'=> 'تم تحجيث بنجاح']);

        // $offer -> update({
        //     'name_ar' => $request -> name_ar;
        //     'name_en' => $request -> name_en;
        //     'price' => $request -> price;

        // })


    }

    public function gitVideo(){
     $video =   video::first();
     event(new VideoViewer( $video));
return view('video') -> with('video' ,$video);

    }

public function getInactiveOffers(){
    // where  whereNull  whereNitNull whereIn  لشرط
   return  $inactiveOffer= Offer::get();
   //return  $inactiveOffer= Offer::invalid()->get();

}


}