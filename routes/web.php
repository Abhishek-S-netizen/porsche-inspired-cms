    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\CarController;
    use App\Http\Controllers\VariantController;
    use App\Http\Controllers\Admin\AdminCarController;
    use App\Http\Controllers\Admin\AdminVariantController;
    use App\Http\Controllers\Admin\AdminSpecsController;
    use App\Http\Controllers\Admin\AdminPageController;

    Route::prefix("admin")->middleware("auth")->group(function () {
        Route::get("/dashboard",[AdminPageController::class,"showAdminDashboard"]);
        Route::post("/logout",[AdminPageController::class,"logout"])->name("admin.logout");

        Route::post("/create-car",[AdminCarController::class,"addCar"])->name("admin.addcar");

        Route::get("/edit-model/{car:slug}",[AdminPageController::class,"showEditModelPage"])->name("admin.edit.model");
        
        Route::get("/edit-variant/{car:slug}/{variant:slug}",[AdminPageController::class,"showEditVariantPage"])->name("admin.edit.variant");

        Route::post("/edit-admin-model",[AdminCarController::class,"editModel"])->name("admin.editcar");

        Route::post("/edit-admin-variant",[AdminVariantController::class,"editVariant"])->name("admin.editvariant");

        Route::post("/delete-admin-variant",[AdminVariantController::class,"deleteVariant"])->name("admin.deletevariant");

        Route::post("/delete-admin-model",[AdminCarController::class,"deleteModel"])->name("admin.deletemodel");

        Route::post("/create-variant",[AdminVariantController::class,"addVariant"])->name("admin.addvariant");

        Route::get("/{car:slug}/{variant:slug}/add-highlights",[AdminPageController::class,"showHighlightsPage"])->name("admin.highlightspage");

        Route::get("/{car:slug}/{variant:slug}/add-engine-details",[AdminPageController::class,"showEngineDetailsPage"])->name("admin.enginedetailspage");

        Route::post("/add-admin-highlights",[AdminVariantController::class, "addHighlights"])->name("admin.add.highlights");

        Route::post("/edit-admin-highlights",[AdminVariantController::class,"editHighlights"])->name("admin.edit.highlights");

        Route::post("/delete-admin-highlights",[AdminVariantController::class,"deleteHighlights"])->name("admin.delete.highlights");

        Route::post("/add-admin-engine-details",[AdminVariantController::class,"addEngineDetails"])->name("admin.add.enginedetails");

        Route::post("/edit-admin-engine-details",[AdminVariantController::class,"editEngineDetails"])->name("admin.edit.enginedetails");

        Route::post("/delet-admin-engine-details",[AdminVariantController::class,"deleteEngineDetails"])->name("admin.delete.enginedetails");
        
        Route::post("/add-user",[AdminPageController::class,"addAdmin"])->name("add.user");
        
        Route::post("/update-password",[AdminPageController::class,"editPassword"])->name("update.password");

        Route::get("/users",[AdminPageController::class,"showAllUsers"])->name("show.users");
        Route::get("/add-user",[AdminPageController::class,"showAddUserPage"]);
        Route::get("/update-password",[AdminPageController::class,"showUpdatePasswordPage"]);
    });

    // Demo
    Route::get("/variant/911",[HomeController::class,"show911VariantPage"]);
    // Demo

    Route::get("/login",[HomeController::class,"showLoginPage"])->name("login");
    Route::post("/login-admin",[AdminPageController::class,"verifyAdmin"])->name("login.admin");

    Route::get("/",[HomeController::class,"showLandingPage"])->name("home");
    Route::get("/models/{car:slug}",[CarController::class,"showModels"])->name("cars.show");
    Route::get("/models/{car:slug}/{variant:slug}",[VariantController::class,"showVariantPage"])->name("variant.page");

