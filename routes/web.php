<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\MemberClassController;

Route::middleware("auth")->group(function () {
    // Classroom Route
    Route::get("/", [ClassroomController::class, "index"])->name("home");
    Route::get("/create", [ClassroomController::class, "create"])->name("createClass");
    Route::post("/create", [ClassroomController::class, "store"])->name("storeClass");
    Route::post("/join", [ClassroomController::class, "joinClass"])->name("joinClass");

    Route::middleware("joined")->prefix("class/{id}")->group(function () {
        // Classroom Ensure
        Route::get("/", [ClassroomController::class, "show"])->name("detailClass");
        Route::delete("/out", [ClassroomController::class, "out"])->name("outClass");

        // Member Management
        Route::get("/member", [MemberClassController::class, "index"])->name("memberClass");

        // Assignment
        Route::get("/assignment", [AssignmentController::class, "assignmentClass"])->name("assignmentClass");

        // Post 
        Route::get("/post/{id_post}", [PostController::class, "show"])->name("detailPost");
        Route::get('/post/{id_file}/download', [PostController::class, 'download'])->name('fileDownload');

        // Submission
        Route::post("/post/{id_post}/submission", [SubmissionController::class, "store"])->name("storeSubmission");
    });

    Route::middleware("author")->prefix("class/{id}")->group(function () {
        // Classroom Setting
        Route::get("/setting", [ClassroomController::class, "setting"])->name("setting");
        Route::put("/setting", [ClassroomController::class, "updateSetting"])->name("updateSetting");

        // Material Management
        Route::get("/material/create", [PostController::class, "createMaterial"])->name("createMaterial");
        Route::post("/material/create", [PostController::class, "storeMaterial"])->name("storeMaterial");
        Route::get("/material/{id_post}/edit", [PostController::class, "editMaterial"])->name("editMaterial");
        Route::put("/material/{id_post}", [PostController::class, "updateMaterial"])->name("updateMaterial");

        // Post 
        Route::delete('/file/{id_file}', [PostController::class, 'deletePostFile'])->name('deletePostFile');
        Route::delete('/post/{id_post}', [PostController::class, 'deletePost'])->name('deletePost');

        // Assignment Management
        Route::get("/assignment/create", [PostController::class, "createAssignment"])->name("createAssignment");
        Route::post("/assignment/create", [PostController::class, "storeAssignment"])->name("storeAssignment");
        Route::get("/assignment/{id_post}/edit", [PostController::class, "editAssignment"])->name("editAssignment");
        Route::put("/assignment/{id_post}", [PostController::class, "updateAssignment"])->name("updateAssignment");

        // Assesment
        Route::get("/assesment/{id_post}", [SubmissionController::class, "index"])->name("assesments");
        Route::get("/assesment/{id_submission}/detail", [SubmissionController::class, "show"])->name("submissionDetail");
        Route::put("/assesment/{id_submission}", [SubmissionController::class, "update"])->name("signAssesment");
        Route::get('/submission/{id_file}/download', [SubmissionController::class, 'download'])->name('submissionDownload');

        // Information
        Route::post("/information", [ClassroomController::class, "storeInformation"])->name("createInformation");
        Route::put("/information/{id_post}", [ClassroomController::class, "updateInformation"])->name("updateInformation");

        // Member Management
        Route::delete("/member/{id_user}", [MemberClassController::class, "destroy"])->name("bannedMember");
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
