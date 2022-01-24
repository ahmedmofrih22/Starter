<?php

namespace App\Http\Controllers;

use App\models\Offer;

use Illuminate\Http\Request;

class CollectTut extends Controller
{
            public function index(){
                // $numbers=[1,2,3,4];
                // $col= collect($numbers);
                // return $col->avg();
                ///////
            //     $name = collect(['name','age']);
            // return    $res=   $name->combine(['ahmed',22]);
            ////////
            // $name = collect([1,2,3,4,5,6]);

            //     return    $name->count();
            // $name = collect([1,6,3,5,5,6]);

            // return    $name->countBy();

            $name = collect([1,6,3,5,5,6]);

            return    $name->duplicates();

            //each
            //fillter
            //search
            //transform

            }

        public function complex(){
        $coll= Offer::get();

        $coll->each(function($cate){

            if($cate -> status == 0){

                unset($cate->details_ar);
                unset($cate->details_en);
            }

            $cate->name='ahmed';
        });

        return $coll;

        }


        public function complexFilter(){
        //     $coll = Offer::get();
        //     $coll = collect($coll);
        //  $filter=   $coll->filter(function($value,$key){ بيجيب البيانات الي عربي بس
        //         return $value['name_ar']=='ar';
        //     });

        //     return array_values($filter->all()) ;

    //         $coll = Offer::get();
    //         $coll = collect($coll);
    //   return   $filter=   $coll->transform(function($value,$key){  بيجيب الاسم بس
    //             return 'name_ar is :' .$value['name_ar'];
    //         });

            $coll = Offer::get();
            $coll = collect($coll);
      return   $filter=   $coll->transform(function($value,$key){

              $data=[];
              $data['name_ar']=$value['name_ar'];
              $data['age']=22;
              $data ['love']=$value['!'];

              return $data;

            });



        }


}

