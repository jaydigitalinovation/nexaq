<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Admincontroller;
use App\Http\Controllers\Auth\Adminlogincontroller;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AboutusController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\IndustriesController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CaseStudiesController;
use App\Http\Controllers\Admin\SolutionController;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('/submit_form',[CaseStudiesController::class,'submit_form']);



Route::prefix('admin')->group(function(){

Route::get('/login',[Adminlogincontroller::class, 'login']);
Route::post('/login',[Adminlogincontroller::class, 'authenticate'])->name('login');
Route::get('/logout',[Adminlogincontroller::class, 'logout'])->name('adminlogout');

Route::get('/forgetpasswordview',[Adminlogincontroller::class, 'forgetpasswordview'])->name('forgetpasswordview');
Route::post('/resetpasswordlink',[Adminlogincontroller::class, 'resetpasswordlink'])->name('resetpasswordlink');

Route::get('/resetpasswordview/{id}',[Adminlogincontroller::class, 'resetpasswordview'])->name('resetpasswordview');
Route::post('/resetpassword/{id}',[Adminlogincontroller::class, 'resetpassword'])->name('resetpassword');

Route::get('/changepassword',[Admincontroller::class, 'changepassword']);
Route::post('/updatepassword/{id}',[Admincontroller::class, 'updatepassword']);

Route::get('/home',[Admincontroller::class, 'home']);


Route::get('/home_banner',[HomeController::class, 'home_banner']);
Route::get('/add_home_banner',[HomeController::class, 'add_home_banner']);
Route::post('/store_home_banner',[HomeController::class, 'store_home_banner']);
Route::get('/update_home_banner/{id}',[HomeController::class, 'update_home_banner']);
Route::post('/store_update_home_banner/{id}',[HomeController::class, 'store_update_home_banner']);
Route::get('/delete_home_banner/{id}',[HomeController::class, 'delete_home_banner']);
Route::post('/delete_all_home_banner',[HomeController::class, 'delete_all_home_banner']);


Route::get('/achievement',[HomeController::class, 'achievement']);
Route::get('/add_achievement',[HomeController::class, 'add_achievement']);
Route::post('/store_achievement',[HomeController::class, 'store_achievement']);
Route::get('/update_achievement/{id}',[HomeController::class, 'update_achievement']);
Route::post('/store_update_achievement/{id}',[HomeController::class, 'store_update_achievement']);
Route::get('/delete_achievement/{id}',[HomeController::class, 'delete_achievement']);
Route::post('/delete_all_achievement',[HomeController::class, 'delete_all_achievement']);

Route::get('/testimonials',[HomeController::class, 'testimonials']);
Route::get('/add_testimonials',[HomeController::class, 'add_testimonials']);
Route::post('/store_testimonials',[HomeController::class, 'store_testimonials']);
Route::get('/update_testimonials/{id}',[HomeController::class, 'update_testimonials']);
Route::post('/store_update_testimonials/{id}',[HomeController::class, 'store_update_testimonials']);
Route::get('/delete_testimonials/{id}',[HomeController::class, 'delete_testimonials']);
Route::post('/delete_all_testimonials',[HomeController::class, 'delete_all_testimonials']);

Route::get('/contact_detail',[ContactController::class, 'contact_detail']);
Route::get('/add_contact_detail',[ContactController::class, 'add_contact_detail']);
Route::post('/store_contact_detail',[ContactController::class, 'store_contact_detail']);
Route::get('/update_contact_detail/{id}',[ContactController::class, 'update_contact_detail']);
Route::post('/store_update_contact_detail/{id}',[ContactController::class, 'store_update_contact_detail']);
Route::get('/delete_contact_detail/{id}',[ContactController::class, 'delete_contact_detail']);
Route::post('/delete_all_contact_detail',[ContactController::class, 'delete_all_contact_detail']);


Route::get('/footer_about_us',[Admincontroller::class, 'footer_about_us']);
Route::get('/update_footer_about_us/{id}',[Admincontroller::class, 'update_footer_about_us']);
Route::post('/store_update_footer_about_us/{id}',[Admincontroller::class, 'store_update_footer_about_us']);


Route::get('/our_clients',[HomeController::class, 'our_clients']);
Route::get('/add_clients',[HomeController::class, 'add_clients']);
Route::post('/store_clients',[HomeController::class, 'store_clients']);
Route::get('/delete_clients/{id}',[HomeController::class, 'delete_clients']);
Route::post('/delete_all_clients',[HomeController::class, 'delete_all_clients']);


Route::get('/services',[HomeController::class, 'services']);
Route::get('/add_service',[HomeController::class, 'add_service']);
Route::post('/store_service',[HomeController::class, 'store_service']);
Route::get('/update_service/{id}',[HomeController::class, 'update_service']);
Route::post('/store_update_service/{id}',[HomeController::class, 'store_update_service']);

Route::get('/delete_service/{id}',[HomeController::class, 'delete_service']);


Route::get('/update_service_desc/{id}',[HomeController::class, 'update_service_desc']);
Route::post('/store_update_service_desc/{id}',[HomeController::class, 'store_update_service_desc']);



Route::get('/industries',[HomeController::class, 'industries']);
Route::get('/add_industries',[HomeController::class, 'add_industries']);
Route::post('/store_industries',[HomeController::class, 'store_industries']);
Route::get('/update_industries/{id}',[HomeController::class, 'update_industries']);
Route::post('/store_update_industries/{id}',[HomeController::class, 'store_update_industries']);

Route::get('/delete_industries/{id}',[HomeController::class, 'delete_industries']);

Route::get('/update_industries_desc/{id}',[HomeController::class, 'update_industries_desc']);
Route::post('/store_update_industries_desc/{id}',[HomeController::class, 'store_update_industries_desc']);


Route::get('/our_partners',[HomeController::class, 'our_partners']);
Route::get('/add_partners',[HomeController::class, 'add_partners']);
Route::post('/store_partners',[HomeController::class, 'store_partners']);
Route::get('/delete_partners/{id}',[HomeController::class, 'delete_partners']);
Route::post('/delete_all_partners',[HomeController::class, 'delete_all_partners']);



Route::get('/aboutus_banner',[AboutusController::class, 'aboutus_banner']);
Route::get('/update_banner_image/{id}',[AboutusController::class, 'update_banner_image']);
Route::post('/store_banner_image/{id}',[AboutusController::class, 'store_banner_image']);

Route::get('/aboutus',[AboutusController::class, 'aboutus']);
Route::get('/update_aboutus/{id}',[AboutusController::class, 'update_aboutus']);
Route::post('/store_update_aboutus/{id}',[AboutusController::class, 'store_update_aboutus']);

Route::get('/mission_vision',[AboutusController::class, 'mission_vision']);
Route::get('/update_mission_vision/{id}',[AboutusController::class, 'update_mission_vision']);
Route::post('/store_mission_vision/{id}',[AboutusController::class, 'store_mission_vision']);


Route::get('/solutions',[AboutusController::class, 'solutions']);
Route::get('/update_solutions_desc/{id}',[AboutusController::class, 'update_solutions_desc']);
Route::post('/store_solutions_desc/{id}',[AboutusController::class, 'store_solutions_desc']);


Route::get('/add_solutions/{id}',[AboutusController::class, 'add_solutions']);
Route::post('/store_solutions/{id}',[AboutusController::class, 'store_solutions']);
Route::get('/delete_solutions/{id}',[AboutusController::class, 'delete_solutions']);


Route::get('/aboutus_service',[AboutusController::class, 'aboutus_service']);

Route::get('/update_aboutus_service_description_data/{id}',[AboutusController::class, 'update_aboutus_service_description_data']);
Route::post('/store_update_aboutus_service_description_data/{id}',[AboutusController::class, 'store_update_aboutus_service_description_data']);

Route::get('/add_aboutus_service_data/{id}',[AboutusController::class, 'add_aboutus_service_data']);
Route::post('/store_add_aboutus_service_data/{id}',[AboutusController::class, 'store_add_aboutus_service_data']);

Route::get('/delete_aboutus_service/{id}',[AboutusController::class, 'delete_aboutus_service']);


Route::get('/features',[AboutusController::class, 'features']);
Route::get('/update_features_desc/{id}',[AboutusController::class, 'update_features_desc']);
Route::post('/store_features_desc/{id}',[AboutusController::class, 'store_features_desc']);


Route::get('/add_features/{id}',[AboutusController::class, 'add_features']);
Route::post('/store_features/{id}',[AboutusController::class, 'store_features']);
Route::get('/delete_features/{id}',[AboutusController::class, 'delete_features']);

Route::get('/team',[AboutusController::class, 'team']);
Route::get('/update_team_desc/{id}',[AboutusController::class, 'update_team_desc']);
Route::post('/store_team_desc/{id}',[AboutusController::class, 'store_team_desc']);


Route::get('/add_team/{id}',[AboutusController::class, 'add_team']);
Route::post('/store_team/{id}',[AboutusController::class, 'store_team']);
Route::get('/delete_team/{id}',[AboutusController::class, 'delete_team']);


Route::get('/career_banner',[CareerController::class, 'career_banner']);

Route::get('/career',[CareerController::class, 'career']);
Route::get('/update_career_desc/{id}',[CareerController::class, 'update_career_desc']);
Route::post('/store_career_desc/{id}',[CareerController::class, 'store_career_desc']);


Route::get('/add_career_aboutus/{id}',[CareerController::class, 'add_career_aboutus']);
Route::post('/store_career_aboutus/{id}',[CareerController::class, 'store_career_aboutus']);
Route::get('/delete_career_aboutus/{id}',[CareerController::class, 'delete_career_aboutus']);

Route::get('/employee_opinion',[CareerController::class, 'employee_opinion']);
Route::get('/add_employee_opinion/{id}',[CareerController::class, 'add_employee_opinion']);

Route::post('/store_employee_opinion/{id}',[CareerController::class, 'store_employee_opinion']);

Route::get('/delete_employee_opinion/{id}',[CareerController::class, 'delete_employee_opinion']);




Route::get('/talent_area',[CareerController::class, 'talent_area']);
Route::get('/update_hiring_desc/{id}',[CareerController::class, 'update_hiring_desc']);
Route::post('/store_hiring_desc/{id}',[CareerController::class, 'store_hiring_desc']);


Route::get('/add_vacancy',[CareerController::class, 'add_vacancy']);
Route::post('/store_vacancy',[CareerController::class, 'store_vacancy']);
Route::get('/delete_vacancy/{id}',[CareerController::class, 'delete_vacancy']);
Route::get('/update_vacancy/{id}',[CareerController::class, 'update_vacancy']);


Route::get('/delete_location/{id}',[CareerController::class, 'delete_location']);
Route::get('/delete_industries/{id}',[CareerController::class, 'delete_industries']);
Route::get('/delete_technology/{id}',[CareerController::class, 'delete_technology']);


Route::post('/store_update_vacancy/{id}',[CareerController::class, 'store_update_vacancy']);

Route::get('/view_vacancy/{id}',[CareerController::class, 'view_vacancy']);



Route::get('/hiring_process',[CareerController::class, 'hiring_process']);
Route::get('/update_hiring_process_desc/{id}',[CareerController::class, 'update_hiring_process_desc']);
Route::post('/store_hiring_process_desc/{id}',[CareerController::class, 'store_hiring_process_desc']);

Route::get('/add_hiring_step/{id}',[CareerController::class, 'add_hiring_step']);
Route::post('/store_hiring_step/{id}',[CareerController::class, 'store_hiring_step']);
Route::get('/delete_hiring_step/{id}',[CareerController::class, 'delete_hiring_step']);



Route::get('/industries_detail/{id}',[IndustriesController::class, 'industries_detail']);
Route::get('/update_industry_desc/{id}',[IndustriesController::class, 'update_industry_desc']);
Route::post('/store_industry_desc/{id}',[IndustriesController::class, 'store_industry_desc']);

Route::get('/add_experties/{id}',[IndustriesController::class, 'add_experties']);
Route::post('/store_experties/{id}',[IndustriesController::class, 'store_experties']);

Route::get('/view_industries_experties/{id}',[IndustriesController::class, 'view_industries_experties']);

Route::get('/update_experties/{id}',[IndustriesController::class, 'update_experties']);
Route::post('/store_update_experties/{id}',[IndustriesController::class, 'store_update_experties']);


Route::get('/delete_experties_image/{id}',[IndustriesController::class, 'delete_experties_image']);
Route::get('/update_experties_image/{id}',[IndustriesController::class, 'update_experties_image']);
Route::post('/store_experties_image/{id}',[IndustriesController::class, 'store_experties_image']);
Route::get('/delete_experties/{id}',[IndustriesController::class, 'delete_experties']);

Route::get('/add_segment/{id}',[IndustriesController::class, 'add_segment']);
Route::post('/store_segment/{id}',[IndustriesController::class, 'store_segment']);
Route::get('/update_segment/{id}',[IndustriesController::class, 'update_segment']);
Route::post('/store_update_segment/{id}',[IndustriesController::class, 'store_update_segment']);
Route::get('/delete_segment/{id}',[IndustriesController::class, 'delete_segment']);

Route::get('/servicelist',[ServiceController::class, 'servicelist']);

Route::get('/add_main_service/{id}',[ServiceController::class, 'add_main_service']);
Route::post('/store_main_service/{id}',[ServiceController::class, 'store_main_service']);
Route::get('/delete_main_service/{id}',[ServiceController::class, 'delete_main_service']);

Route::get('/service_type',[ServiceController::class, 'service_type']);

Route::get('/add_service_type/{id}',[ServiceController::class, 'add_service_type']);
Route::post('/store_service_type/{id}',[ServiceController::class, 'store_service_type']);
Route::get('/delete_service_type/{id}',[ServiceController::class, 'delete_service_type']);

Route::get('/sub_service/{id}',[ServiceController::class, 'sub_service']);
Route::get('/add_sub_service/{id}',[ServiceController::class, 'add_sub_service']);
Route::post('/store_sub_service/{id}',[ServiceController::class, 'store_sub_service']);
Route::get('/delete_sub_service/{id}',[ServiceController::class, 'delete_sub_service']);
Route::get('/update_sub_service_data/{id}',[ServiceController::class, 'update_sub_service_data']);
Route::post('/store_update_sub_service_data/{id}',[ServiceController::class, 'store_update_sub_service_data']);


Route::get('/add_sub_service_description/{id}',[ServiceController::class, 'add_sub_service_description']);
Route::post('/store_sub_service_description/{id}',[ServiceController::class, 'store_sub_service_description']);
Route::get('/update_sub_service_description_data/{id}',[ServiceController::class, 'update_sub_service_description_data']);
Route::post('/store_update_sub_service_description_data/{id}',[ServiceController::class, 'store_update_sub_service_description_data']);



Route::get('/case_studies',[CaseStudiesController::class, 'case_studies']);
Route::get('/add_case_studies/{id}',[CaseStudiesController::class, 'add_case_studies']);
Route::post('/store_case_studies/{id}',[CaseStudiesController::class, 'store_case_studies']);
Route::get('/delete_case_studies/{id}',[CaseStudiesController::class, 'delete_case_studies']);
Route::post('/delete_all_case_studies',[CaseStudiesController::class, 'delete_all_case_studies']);



Route::get('/case_management',[CaseStudiesController::class, 'case_management']);
Route::get('/add_case_management/{id}',[CaseStudiesController::class, 'add_case_management']);
Route::post('/store_case_management/{id}',[CaseStudiesController::class, 'store_case_management']);
Route::get('/delete_case_management/{id}',[CaseStudiesController::class, 'delete_case_management']);
Route::post('/delete_all_case_management',[CaseStudiesController::class, 'delete_all_case_management']);



Route::get('/case_project',[CaseStudiesController::class, 'case_project']);
Route::get('/add_case_project/{id}',[CaseStudiesController::class, 'add_case_project']);
Route::post('/store_case_project/{id}',[CaseStudiesController::class, 'store_case_project']);
Route::get('/delete_case_project/{id}',[CaseStudiesController::class, 'delete_case_project']);
Route::post('/delete_all_case_project',[CaseStudiesController::class, 'delete_all_case_project']);


Route::get('/about_blog_detail',[CaseStudiesController::class, 'about_blog_detail']);
Route::get('/add_about_blog_detail/{id}',[CaseStudiesController::class, 'add_about_blog_detail']);
Route::post('/store_about_blog_detail/{id}',[CaseStudiesController::class, 'store_about_blog_detail']);
Route::get('/delete_about_blog_detail/{id}',[CaseStudiesController::class, 'delete_about_blog_detail']);
Route::post('/delete_all_about_blog_detail',[CaseStudiesController::class, 'delete_all_about_blog_detail']);




Route::get('/add_case_management_data/{id}',[CaseStudiesController::class, 'add_case_management_data']);
Route::post('/store_case_management_data/{id}',[CaseStudiesController::class, 'store_case_management_data']);

Route::get('/update_case_management_data/{id}',[CaseStudiesController::class, 'update_case_management_data']);
Route::post('/store_update_case_management_data/{id}',[CaseStudiesController::class, 'store_update_case_management_data']);


Route::get('/view_case_detail/{id}',[CaseStudiesController::class, 'view_case_detail']);

Route::get('/view_blog_detail/{id}',[CaseStudiesController::class, 'view_blog_detail']);





Route::get('/add_more_cs_banner/{id}',[CaseStudiesController::class, 'add_more_cs_banner']);

Route::get('/add_more_cs_banner_data/{id}',[CaseStudiesController::class, 'add_more_cs_banner_data']);
Route::post('/store_add_more_cs_banner_data/{id}',[CaseStudiesController::class, 'store_add_more_cs_banner_data']);



Route::get('/add_more_cs_banner_list/{id}',[CaseStudiesController::class, 'add_more_cs_banner_list']);

Route::get('/add_more_cs_banner_list_data/{id}',[CaseStudiesController::class, 'add_more_cs_banner_list_data']);
Route::post('/store_add_more_cs_banner_list_data/{id}',[CaseStudiesController::class, 'store_add_more_cs_banner_list_data']);

Route::get('/delete_cs_banner_list/{id}',[CaseStudiesController::class, 'delete_cs_banner_list']);




Route::get('/add_more_cs_challenge/{id}',[CaseStudiesController::class, 'add_more_cs_challenge']);

Route::get('/add_section',[CaseStudiesController::class, 'add_section']);
Route::get('/remove_section',[CaseStudiesController::class, 'remove_section']);


Route::get('/add_more_cs_challenge_data/{id}',[CaseStudiesController::class, 'add_more_cs_challenge_data']);
Route::post('/store_add_more_cs_challenge_data/{id}',[CaseStudiesController::class, 'store_add_more_cs_challenge_data']);

Route::get('/delete_add_more_cs_challenge/{id}',[CaseStudiesController::class, 'delete_add_more_cs_challenge']);




Route::get('/add_more_cs_expertise/{id}',[CaseStudiesController::class, 'add_more_cs_expertise']);

Route::get('/add_more_cs_expertise_data/{id}',[CaseStudiesController::class, 'add_more_cs_expertise_data']);
Route::post('/store_add_more_cs_expertise_data/{id}',[CaseStudiesController::class, 'store_add_more_cs_expertise_data']);

Route::get('/delete_cs_expertise/{id}',[CaseStudiesController::class, 'delete_cs_expertise']);



Route::get('/add_more_cs_solution/{id}',[CaseStudiesController::class, 'add_more_cs_solution']);

Route::get('/add_more_cs_solution_data/{id}',[CaseStudiesController::class, 'add_more_cs_solution_data']);
Route::post('/store_add_more_cs_solution_data/{id}',[CaseStudiesController::class, 'store_add_more_cs_solution_data']);



Route::get('/add_more_cs_inner_detail/{id}',[CaseStudiesController::class, 'add_more_cs_inner_detail']);

Route::get('/add_more_cs_inner_detail_data/{id}',[CaseStudiesController::class, 'add_more_cs_inner_detail_data']);
Route::post('/store_add_more_cs_inner_detail_data/{id}',[CaseStudiesController::class, 'store_add_more_cs_inner_detail_data']);

Route::get('/update_add_more_cs_inner_detail_data/{id}',[CaseStudiesController::class, 'update_add_more_cs_inner_detail_data']);
Route::post('/store_update_add_more_cs_inner_detail_data/{id}',[CaseStudiesController::class, 'store_update_add_more_cs_inner_detail_data']);

Route::get('/delete_add_more_cs_inner_detail/{id}',[CaseStudiesController::class, 'delete_add_more_cs_inner_detail']);


Route::get('/add_more_cs_view_inner_detail/{id}',[CaseStudiesController::class, 'add_more_cs_view_inner_detail']);

Route::get('/add_more_cs_view_inner_detail_data/{id}',[CaseStudiesController::class, 'add_more_cs_view_inner_detail_data']);
Route::post('/store_add_more_cs_view_inner_detail_data/{id}',[CaseStudiesController::class, 'store_add_more_cs_view_inner_detail_data']);


Route::get('/delete_add_more_cs_view_inner_detail_data/{id}',[CaseStudiesController::class, 'delete_add_more_cs_view_inner_detail_data']);





Route::get('/add_more_cs_result/{id}',[CaseStudiesController::class, 'add_more_cs_result']);

Route::get('/add_more_cs_result_data/{id}',[CaseStudiesController::class, 'add_more_cs_result_data']);
Route::post('/store_add_more_cs_result_data/{id}',[CaseStudiesController::class, 'store_add_more_cs_result_data']);

Route::get('/delete_add_more_cs_result/{id}',[CaseStudiesController::class, 'delete_add_more_cs_result']);





Route::get('/admin_detail',[Admincontroller::class, 'admin_detail']);

Route::get('/add_admin_detail_data/{id}',[Admincontroller::class, 'add_admin_detail_data']);
Route::post('/store_add_admin_detail_data/{id}',[Admincontroller::class, 'store_add_admin_detail_data']);

Route::get('/delete_admin_detail/{id}',[Admincontroller::class, 'delete_admin_detail']);



Route::get('/solution_team',[SolutionController::class, 'solution_team']);

Route::get('/add_solution_team_data/{id}',[SolutionController::class, 'add_solution_team_data']);
Route::post('/store_add_solution_team_data/{id}',[SolutionController::class, 'store_add_solution_team_data']);

Route::get('/delete_solution_team/{id}',[SolutionController::class, 'delete_solution_team']);




Route::get('/solution_service',[SolutionController::class, 'solution_service']);

Route::get('/update_solution_service_description_data/{id}',[SolutionController::class, 'update_solution_service_description_data']);
Route::post('/store_update_solution_service_description_data/{id}',[SolutionController::class, 'store_update_solution_service_description_data']);

Route::get('/add_solution_service_data/{id}',[SolutionController::class, 'add_solution_service_data']);
Route::post('/store_add_solution_service_data/{id}',[SolutionController::class, 'store_add_solution_service_data']);

Route::get('/delete_solution_service/{id}',[SolutionController::class, 'delete_solution_service']);




Route::get('/solution_choose',[SolutionController::class, 'solution_choose']);

Route::get('/update_solution_choose_description_data/{id}',[SolutionController::class, 'update_solution_choose_description_data']);
Route::post('/store_update_solution_choose_description_data/{id}',[SolutionController::class, 'store_update_solution_choose_description_data']);

Route::get('/add_solution_choose_data/{id}',[SolutionController::class, 'add_solution_choose_data']);
Route::post('/store_add_solution_choose_data/{id}',[SolutionController::class, 'store_add_solution_choose_data']);

Route::get('/delete_solution_choose/{id}',[SolutionController::class, 'delete_solution_choose']);







/*    new_Route        new_Route        new_Route        new_Route        new_Route        new_Route        new_Route        */



Route::get('/home_about',[HomeController::class, 'home_about']);

Route::get('/update_home_about_description_data/{id}',[HomeController::class, 'update_home_about_description_data']);
Route::post('/store_update_home_about_description_data/{id}',[HomeController::class, 'store_update_home_about_description_data']);

Route::get('/add_home_about_data/{id}',[HomeController::class, 'add_home_about_data']);
Route::post('/store_add_home_about_data/{id}',[HomeController::class, 'store_add_home_about_data']);

Route::get('/delete_home_about/{id}',[HomeController::class, 'delete_home_about']);




Route::get('/home_insight',[HomeController::class, 'home_insight']);

Route::get('/add_home_insight_data/{id}',[HomeController::class, 'add_home_insight_data']);
Route::post('/store_add_home_insight_data/{id}',[HomeController::class, 'store_add_home_insight_data']);

Route::get('/delete_home_insight/{id}',[HomeController::class, 'delete_home_insight']);







 }); 

