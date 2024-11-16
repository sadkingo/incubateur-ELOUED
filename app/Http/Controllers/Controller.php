<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getProjectsCount() {
        $currentYear = date('Y');
        $setting = Setting::where('name', 'project_count')->first();

        if ($setting) {
            if ($setting->updated_at->format('Y') !== $currentYear) {
                $setting->value = 1;
                $setting->save();
                $setting->touch();
            } else {
                $setting->value = $setting->value + 1;
                $setting->save();
            }
        } else {
            $setting = new Setting();
            $setting->name = 'project_count';
            $setting->value = 1;
            $setting->save();
        }

        $count = str_pad($setting->value, 3, '0', STR_PAD_LEFT);

        return $count;
    }

    public function getprojectTrackingText($project) {
        if($project->project_classification == 1) {
            if ($project->project_tracking == 1) {
                return '<span value="1">'.  trans('auth/project.project_tracking.configuration_stage') . '</span>';
            } elseif ($project->project_tracking == 2) {
                return '<span value="2" >'.  trans('auth/project.project_tracking.create_bmc') . '</span>';
            } elseif ($project->project_tracking == 3) {
                return '<span value="3" >'.  trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') . '</span>';
            // } elseif ($project->project_tracking == 4) {
                // return '<span value="4" >'.  trans('auth/project.project_tracking.discussion_stage') . '</span>';
            } elseif ($project->project_tracking == 5) {
                return '<span value="5" >'.  trans('auth/project.project_tracking.labelle_innovative_project') . '</span>';
            }
        } else if($project->project_classification == 2){
            if ($project->project_tracking == 1) {
                return '<span value="1" >'.  trans('auth/project.project_tracking.configuration_stage') . '</span>';
            } elseif ($project->project_tracking == 2) {
                return '<span value="2" >'.  trans('auth/project.project_tracking.create_bmc') . '</span>';
            } elseif ($project->project_tracking == 3) {
                return '<span value="3" >'.  trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') . '</span>';
            } elseif ($project->project_tracking == 4) {
                return '<span value="4" >'.  trans('auth/project.project_tracking.discussion_stage') . '</span>';
            } elseif ($project->project_tracking == 5) {
                return '<span value="5" >'.  trans('auth/project.project_tracking.labelle_innovative_project') . '</span>';
            }
        } else if($project->project_classification == 3){
            if ($project->project_tracking == 1) {
                return '<span value="1" >'.  trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') . '</span>';
            } elseif ($project->project_tracking == 2) {
                return '<span value="2" >'.  trans('auth/project.project_tracking.write_a_descriptive_model') . '</span>';
            } elseif ($project->project_tracking == 3) {
                return '<span value="3" >'.  trans('auth/project.project_tracking.stage_of_registering_a_patent_application') . '</span>';
            } elseif ($project->project_tracking == 4) {
                return '<span value="4" >'.  trans('auth/project.project_tracking.obtain_a_certificate_of_registration_for_the_patent_filing_application') . '</span>';
            } elseif ($project->project_tracking == 5) {
                return '<span value="5" >'.  trans('auth/project.project_tracking.receiving_reservations_and_amendments_requested_from_INAPI') . '</span>';
            } elseif ($project->project_tracking == 6) {
                return '<span value="6" >'.  trans('auth/project.project_tracking.resend_the_amended_form_after_lifting_the_reservations') . '</span>';
            } elseif ($project->project_tracking == 7) {
                return '<span value="7" >'.  trans('auth/project.project_tracking.obtained_a_patent') . '</span>';
            }
        } else if($project->project_classification == 4 ){
            if ($project->project_tracking == 1) {
                return '<span value="1">'.  trans('auth/project.project_tracking.configuration_stage') . '</span>';
            } elseif ($project->project_tracking == 2) {
                return '<span value="2">'.  trans('auth/project.project_tracking.create_bmc') . '</span>';
            } elseif ($project->project_tracking == 3) {
                return '<span value="3">'.  trans('auth/project.project_tracking.the_stage_of_preparing_the_prototype') . '</span>';
            } elseif ($project->project_tracking == 4) {
                return '<span value="4">'.  trans('auth/project.project_tracking.write_a_descriptive_model') . '</span>';
            } elseif ($project->project_tracking == 5) {
                return '<span value="5">'.  trans('auth/project.project_tracking.stage_of_registering_a_patent_application') . '</span>';
            } elseif ($project->project_tracking == 6) {
                return '<span value="6">'.  trans('auth/project.project_tracking.obtain_a_certificate_of_registration_for_the_patent_filing_application') . '</span>';
            } elseif ($project->project_tracking == 7) {
                return '<span value="7">'.  trans('auth/project.project_tracking.receiving_reservations_and_amendments_requested_from_INAPI') . '</span>';
            } elseif ($project->project_tracking == 8) {
                return '<span value="8">'.  trans('auth/project.project_tracking.resend_the_amended_form_after_lifting_the_reservations') . '</span>';
            } elseif ($project->project_tracking == 9) {
                return '<span value="9">'.  trans('auth/project.project_tracking.discussion_stage') . '</span>';
            } elseif ($project->project_tracking == 10) {
                return '<span value="10">'.  trans('auth/project.project_tracking.obtained_a_patent_startup') . '</span>';
            }
        }   

    }

    public function getStatusProjectTrackingText($project) {
        if($project->project_classification == 1 || $project->project_classification == 2){
            if($project->project_tracking == 1){
                if($project->status_project_tracking == 0) {
                    return '<span >'. trans('auth/project.status_project_tracking.emty') .' </span>';
                } elseif($project->status_project_tracking == 1){
                    return '<span class="text-warning">'. trans('auth/project.status_project_tracking.practice') .' </span>';
                }elseif($project->status_project_tracking == 2){
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.complete') .' </span>';
                }else{
                    return '<span class="text-danger">'. trans('auth/project.status_project_tracking.not_yet') .' </span>';
                }
            }elseif($project->project_tracking == 2 || $project->project_tracking == 3){
                if($project->status_project_tracking == 0){
                    return '<span >'. trans('auth/project.status_project_tracking.emty') .' </span>';
                }elseif($project->status_project_tracking == 1){
                    return '<span class="text-warning">'. trans('auth/project.status_project_tracking.development_mode') .' </span>';
                }elseif($project->status_project_tracking == 2){
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.accomplished') .' </span>';
                }else{
                    return '<span class="text-danger">'. trans('auth/project.status_project_tracking.not_completed') .' </span>';
                }
                
            }elseif($project->project_tracking == 4){
                if($project->status_project_tracking == 2){
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.discuss') .' </span>';
                }else{
                    return '<span class="text-danger">'. trans('auth/project.status_project_tracking.not_discussed') .' </span>';
                }
            }else{
                if($project->status_project_tracking == 0){
                    return '<span >'. trans('auth/project.status_project_tracking.emty') .' </span>';
                }elseif($project->status_project_tracking == 1){
                    return '<span class="text-warning">'. trans('auth/project.status_project_tracking.did_not_happen') .' </span>';
                }elseif($project->status_project_tracking == 2){
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.get') .' </span>';
                }else{
                    return '<span class="text-light bg-dark">'. trans('auth/project.status_project_tracking.exclusion_or_waiver_of_the_student') .' </span>';
                }
            }
        }elseif($project->project_classification == 3){
            if($project->project_tracking == 0){
                return '<span >'. trans('auth/project.status_project_tracking.emty') .' </span>';
            }elseif($project->project_tracking == 1){
                if($project->status_project_tracking == 1){
                    return '<span class="text-warning">'. trans('auth/project.status_project_tracking.development_mode') .' </span>';
                }elseif($project->status_project_tracking == 2){
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.accomplished') .' </span>';
                }else{
                    return '<span class="text-danger">'. trans('auth/project.status_project_tracking.not_completed') .' </span>';
                }
            }elseif($project->project_tracking == 2 ){
                if($project->status_project_tracking == 1){
                    return '<span class="text-danger">'. trans('auth/project.status_project_tracking.no') .' </span>';
                }else{
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.yes') .' </span>';
                }
            }elseif($project->project_tracking == 3 || $project->project_tracking == 5 || $project->project_tracking == 6){
                if($project->status_project_tracking == 0){
                    return '<span >'. trans('auth/project.status_project_tracking.emty') .' </span>';
                }
            }elseif($project->project_tracking == 4){
                if($project->status_project_tracking == 1){
                    return '<span class="text-danger">'. trans('auth/project.status_project_tracking.did_not_happen') .' </span>';
                }else{
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.get') .' </span>';
                }
            }else{
                if($project->status_project_tracking == 0){
                    return '<span >'. trans('auth/project.status_project_tracking.emty') .' </span>';
                }elseif($project->status_project_tracking == 1){
                    return '<span class="text-danger">'. trans('auth/project.status_project_tracking.no') .' </span>';
                }else{
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.yes') .' </span>';  
                }
            }
        } else {
            if($project->project_tracking == 1){
                if($project->status_project_tracking == 0){
                    return '<span >'. trans('auth/project.status_project_tracking.emty') .' </span>';
                }elseif($project->status_project_tracking == 1){
                    return '<span class="text-warning">'. trans('auth/project.status_project_tracking.practice') .' </span>';
                }elseif($project->status_project_tracking == 2){
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.complete') .' </span>';
                }else{
                    return '<span class="text-danger">'. trans('auth/project.status_project_tracking.not_yet') .' </span>';
                }
            } elseif($project->project_tracking == 2 || $project->project_tracking == 3){
                if($project->status_project_tracking == 0){
                    return '<span >'. trans('auth/project.status_project_tracking.emty') .' </span>';
                }elseif($project->status_project_tracking == 1){
                    return '<span class="text-warning">'. trans('auth/project.status_project_tracking.development_mode') .' </span>';
                }elseif($project->status_project_tracking == 2){
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.accomplished') .' </span>';
                }else{
                    return '<span class="text-danger">'. trans('auth/project.status_project_tracking.not_completed') .' </span>';
                }
            } elseif($project->project_tracking == 4 ){
                if($project->status_project_tracking == 1){
                    return '<span class="text-danger">'. trans('auth/project.status_project_tracking.no') .' </span>';
                }else{
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.yes') .' </span>';
                }
            } elseif($project->project_tracking == 6){
                if($project->status_project_tracking == 1){
                    return '<span class="text-danger">'. trans('auth/project.status_project_tracking.did_not_happen') .' </span>';
                }else{
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.get') .' </span>';
                }  
            } elseif($project->project_tracking == 9){
                if($project->status_project_tracking == 2){
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.discuss') .' </span>';
                }else{
                    return '<span class="text-danger">'. trans('auth/project.status_project_tracking.not_discussed') .' </span>';
                }
            } else{
                if($project->status_project_tracking == 0){
                    return '<span >'. trans('auth/project.status_project_tracking.emty') .' </span>';
                }elseif($project->status_project_tracking == 1){
                    return '<span class="text-danger">'. trans('auth/project.status_project_tracking.no') .' </span>';
                }else{
                    return '<span class="text-success">'. trans('auth/project.status_project_tracking.yes') .' </span>';
                }               
            }    
        }
    }

    public function getBmcState($project) {
        if ($project->project_classification != null){
            if (in_array($project->project_classification, [1, 2, 4]) && $project->status == 2){
                if ($project->statusAdministrative){
                    // if (!$multipleRecords){
                    //     if ($project->statusAdministrative->status == 0) {
                    //         return '<span class="text-secondary">يتم دراسة ملفك الاداري</span>';
                    //     }elseif($project->statusAdministrative->status == 1){
                    //         if($project->project_tracking == 2 && $project->status_project_tracking == 1 ){
                    //             if ($project->bmc_status == 0){
                    //                 return '<a href="'. url("student/project/' . $project->id . '/addBmc") .'"
                    //                     class="btn btn-primary text-white">'. trans('project.status_project.enter_bmc_file') .'</a>';
                    //             }elseif($project->bmc_status == 1){
                    //                 return '<span class="text-secondary">'. trans('project.status_project.under_studying') .'</span>';
                    //             }elseif($project->bmc_status == 2){
                    //                 return '<span class="text-success">'. trans('project.status_project.bmc_accepted') .'</span>';
                    //             }elseif($project->bmc_status == 3){
                    //                 return '<a href="'. url('student/project/' . $project->id . '/reformatBmc') .'"
                    //                     class="btn btn-primary text-white">
                    //                     '. trans('project.status_project.bmc_reformat') .'
                    //                 </a>';
                    //             }else{
                    //                 return '<span class="text-warning">'. trans('project.administrative.add') .'</span>';
                    //             }
                    //         }elseif($project->project_tracking == 2 && $project->status_project_tracking == 2){
                    //             return '<span class="text-success">'. trans('project.status_project.bmc_accepted') .'</span>';
                    //         }else{
                    //             return '<span class="text-warning">أكمل مرحلة التكوين أولا </span>';
                    //         }    
                    //     }else{
                    //         return '<span class="text-warning">'. trans('project.status_project.missing') .'</span>';
                    //     }
                    // }else{
                        if ($project->statusAdministrative->every(fn($item) => $item->status == 1)){
                            if($project->project_tracking == 2 && $project->status_project_tracking == 1 ){    
                                if ($project->bmc_status == 0){
                                    return '<button class="btn btn-primary text-white" onclick="addBmc(' . $project->id . ')">'. trans('project.status_project.enter_bmc_file') .'</button>';
                                }elseif($project->bmc_status == 1){
                                    return '<span class="text-secondary">'. trans('project.status_project.under_studying') .'</span>';
                                }elseif($project->bmc_status == 2){
                                    return '<span class="text-success">'. trans('project.status_project.bmc_accepted') .'</span>';
                                }elseif($project->bmc_status == 3){
                                    return '<button class="btn btn-primary text-white" onclick="reformatBmc(' . $project->id . ')">
                                        '. trans('project.status_project.bmc_reformat') .'
                                    </button>';
                                }else{
                                    return '<span class="text-warning">'. trans('project.administrative.add') .'</span>';
                                }
                            }elseif($project->project_tracking == 2 && $project->status_project_tracking == 2){
                                return '<span class="text-success">'. trans('project.status_project.bmc_accepted') .'</span>';
                            }else{
                                return '<span class="text-warning">أكمل  مرحلة التكوين أولا </span>';
                            }    
                        }else{
                            return '<span class="text-secondary">يتم دراسة ملفك الاداري</span>';
                        }
                    // }
                }else{
                    return '<span class="text-warning">'. trans('project.administrative.add') .'</span>';
                }
            }else{
                return '<span class="text-warning">'. trans('project.classification.not_eligible') .'</span>';
            }
        }else{
            return '<span class="text-warning">'. trans('project.classification.no_classifi') .'</span>';
        }

    }

}
