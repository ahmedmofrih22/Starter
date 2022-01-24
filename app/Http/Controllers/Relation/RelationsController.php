<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\models\Hospital;
use App\models\Doctor;
use App\models\Patient;
use App\models\Service;
use App\models\Countrie;
use Illuminate\Http\Request;
use  App\Models\Phone;
use App\User;

class RelationsController extends Controller
{
    public function hasOneRelation(){
        $user = \App\User::with(['phone'=> function($q){
            $q->select('code','phone','user_id');
        }])->find(3);
        return response()->json($user);
        //$user->phone;
       // $user->phone->code;
    }
    public function hasOneRelationReserve(){
    // $phone = Phone::find(1);
    $phone = Phone::with(['user'=> function($q){
        $q->select('id','name');
    }])->find(1);
    $phone -> makeVisible(['user_id']);
    //$phone -> makeHidden(['code']);

    return $phone;

    }

    public function getUserHasPhone(){
   return  User::whereHas('phone')->get();

    }


        public function getUserHasNotPhone(){
            return  User::whereDoesntHave('phone')->get();
            }
            public function getUserIsCode(){
                return  User::whereHas('phone',function($q){
                    $q->where('code','0');
                })->get();
            }

         public function getHospitalDoctor(){
             // 1 Hospital::where('id',1)->first();
             // 2 Hospital::first();
             // return $hospital->doctors;

            $hospital= Hospital:: find(1);

           $hospital= Hospital::with('doctors') ->find(1);
          $doctors= $hospital->doctors;
         $doctor= Doctor::find(3);
         return $doctor -> hospital ;

         }

         public function hospitals(){
          $hospitals=  Hospital::select('id','name','address')->get();
             return view('doctors.hospitals',compact('hospitals'));
         }

         public function doctors($hospitals_id){
             $hospital = Hospital::find($hospitals_id);
            $doctors= $hospital -> doctors;
            return view('doctors.doctors',compact('doctors'));
         }
         public function hospitalsHasDoctors(){
          return $hospital=   Hospital::whereHas('doctors')->get();
         }

         public function hospitalsHasOnlyMale(){
            return $hospital=   Hospital::with('doctors')-> whereHas('doctors',function($q){
                $q->where('gender',1);
            })->get();
         }

         public function hospitalsNotHasDoctors(){
           return  Hospital::whereDoesntHave('doctors')->get();
         }

         public function deleteHospital($hospitals_id){
            $hospital= Hospital::find($hospitals_id);
            if(!$hospital)
            return abort('404');
            $hospital->doctors()->delete();
            $hospital->delete();
           // return redirect()->route('hospital.all');

         }

         public function getDoctorService(){
             $doctor = Doctor::with('service')->find(3);
           return $doctor -> service;
          //return  $doctor->name;
         }

         public function getServiceDoctores(){
          return  $doctors = Service::with(['doctor'=>function($q){
              $q->select('doctors.id','name','title');
          }])->find(1);
         }
         public function getDoctorServiceById($doctor_Id){
             $doctor = Doctor::find($doctor_Id);
             $services = $doctor -> service;
             $Doctors = Doctor::select('id','name')->get();
             $allServices = Service::select('id','name')->get();
             return view('doctors.services',compact('services','Doctors','allServices'));

         }

         public function saveServicesToDoctors(Request $request){

            $doctor = Doctor::find($request->Doctor_id);
            if(!$doctor)
            return abort('404');
            //$doctor ->service()-> attach($request->servicesIds);
                        //$doctor ->service()-> sync($request->servicesIds);
            $doctor ->service()->syncWithoutDetaching($request->servicesIds);
            return 'success';
         }

         public function getPatientDoctor(){
          $patient=  patient::find(2);
        return  $patient -> doctor;
         }
         public function getCountrieDoctor(){
            $countrie = Countrie::with('doctor')->find(1);
            return  $countrie = Countrie::with('hospital')->find(1);


         }

         public function getDoctor(){
            return  $doctors=   Doctor::select('id','name','gender')->get();

    //     if(isset($doctors)&&$doctors->count()>0){
    //     foreach ($doctors as $doctor) {
    //         $doctor->gender= $doctor->gender== 1 ?'male':'female';
    //     }
    // }
    // return $doctors;
       }













    }