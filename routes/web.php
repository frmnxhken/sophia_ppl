<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\MemberClassController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    // Classroom Route
    Route::get("/", [ClassroomController::class, "index"])->name("home");
    Route::get("/create", [ClassroomController::class, "create"])->name("createClass");
    Route::post("/create", [ClassroomController::class, "store"])->name("storeClass");
    Route::post("/join", [ClassroomController::class, "joinClass"])->name("joinClass");

    // Classroom Ensure
    Route::middleware("joined")->group(function () {
        Route::get("/class/{id}", [ClassroomController::class, "show"])->name("detailClass");
        Route::delete("/class/{id}/out", [ClassroomController::class, "out"])->name("outClass");

        // Member Management
        Route::get("/class/{id}/member", [MemberClassController::class, "index"])->name("memberClass");

        // Assignment
        Route::get("/class/{id}/assignment", [AssignmentController::class, "assignmentClass"])->name("assignmentClass");

        // Post 
        Route::get("/class/{id}/post/{id_post}", [PostController::class, "show"])->name("detailPost");
        Route::get('/class/{id}/post/{id_file}/download', [PostController::class, 'download'])->name('fileDownload');

        // Submission
        Route::post("/class/{id}/post/{id_post}/submission", [SubmissionController::class, "store"])->name("storeSubmission");
    });

    Route::middleware("author")->group(function () {
        // Classroom Setting
        Route::get("/class/{id}/setting", [ClassroomController::class, "setting"])->name("setting");
        Route::put("/class/{id}/setting", [ClassroomController::class, "updateSetting"])->name("updateSetting");

        // Material Management
        Route::get("/class/{id}/material/create", [PostController::class, "createMaterial"])->name("createMaterial");
        Route::post("/class/{id}/material/create", [PostController::class, "storeMaterial"])->name("storeMaterial");
        Route::get("/class/{id}/material/{id_post}/edit", [PostController::class, "editMaterial"])->name("editMaterial");
        Route::put("/class/{id}/material/{id_post}", [PostController::class, "updateMaterial"])->name("updateMaterial");

        // Post 
        Route::delete('/class/{id}/file/{id_file}', [PostController::class, 'deletePostFile'])->name('deletePostFile');
        Route::delete('/class/{id}/post/{id_post}', [PostController::class, 'deletePost'])->name('deletePost');

        // Assignment Management
        Route::get("/class/{id}/assignment/create", [PostController::class, "createAssignment"])->name("createAssignment");
        Route::post("/class/{id}/assignment/create", [PostController::class, "storeAssignment"])->name("storeAssignment");
        Route::get("/class/{id}/assignment/{id_post}/edit", [PostController::class, "editAssignment"])->name("editAssignment");
        Route::put("/class/{id}/assignment/{id_post}", [PostController::class, "updateAssignment"])->name("updateAssignment");

        // Assesment
        Route::get("/class/{id}/assesment/{id_post}", [SubmissionController::class, "index"])->name("assesments");
        Route::get("/class/{id}/assesment/{id_submission}/detail", [SubmissionController::class, "show"])->name("submissionDetail");
        Route::put("/class/{id}/assesment/{id_submission}", [SubmissionController::class, "update"])->name("signAssesment");
        Route::get('/class/{id}/submission/{id_file}/download', [SubmissionController::class, 'download'])->name('submissionDownload');

        // Information
        Route::post("/class/{id}/information", [ClassroomController::class, "storeInformation"])->name("createInformation");
        Route::put("/class/{id}/information/{id_post}", [ClassroomController::class, "updateInformation"])->name("updateInformation");

        // Member Management
        Route::delete("/class/{id}/member/{id_user}", [MemberClassController::class, "destroy"])->name("bannedMember");
    });

    // Profile Route
    Route::prefix("/profile")->group(function () {
        Route::get("/", [UserController::class, "index"])->name("profile");
        Route::put("/", [UserController::class, "updateProfile"])->name("updateProfile");
        Route::get("/password", [UserController::class, "changePassword"])->name("changePassword");
        Route::put("/password", [UserController::class, "updatePassword"])->name("updatePassword");
    });

    Route::post("/logout", [AuthController::class, "logout"])->name("logout");
});

// Authentication Route
Route::middleware("guest")->group(function () {
    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::post("/login", [AuthController::class, "authentication"])->name("authentication");
    Route::get("/register", [AuthController::class, "register"]);
    Route::post("/register", [AuthController::class, "store"])->name("register");
});
