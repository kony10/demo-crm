<?php

use App\Http\Resources\TodayTaskResource;
use App\Http\Resources\UpcomingResource;
use App\Models\Today;
use App\Models\Upcoming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ** UPcoming Tasks *//


// Fetch All Upcoming tasks 
Route::get("/upcoming", function(){
    $upcoming = Upcoming::all();
    return UpcomingResource::Collection($upcoming);
});

// Add new Tasks 
Route::post("/upcoming", function(Request $request){
    return Upcoming::create([
        'title' => $request->title,
        'taskId' => $request->taskId,
        'waiting' => $request->waiting
    ]);
});

// Delete Upcoming Task
Route::delete("/upcoming/{taskId}" , function($taskId){
    DB::table('upcomings')->where('taskId', $taskId)->delete();
    
    return 204;
});

// ** TOday Tasks *//

//get all Today task

Route::get("/dailytask", function(){
    $dailytask = Today::all();
    return TodayTaskResource::Collection($dailytask);
});


// Add new Today task
Route::post("/dailytask", function(Request $request){
    return Today::create([
        'id' => $request->id,   
        'title' => $request->title,   
        'taskId' => $request->taskId,   
    ]);
});

// Update today task

Route::put('/dailytask/{taskId}', function(Request $request, $taskId){
    $complateTodayTask = [ "completed" => $request->completed ];
    DB::table('todays')->where('taskId', $taskId)->update($complateTodayTask);

   return 204;

});


// Delete today task
Route::delete("/dailytask/{taskId}", function($taskId){
    DB::table('todays')->where('taskId', $taskId)->delete();

    return 204;
});


