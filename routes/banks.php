<?php

use Farsh4d\Bank\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('bank')->name('bank.')->group(function () {
    Route::get('/{bank}/avatar', function (int $bank) {
        return Bank::where('inn', $bank)->getAvatar();
    })->name('avatar.show');

    Route::get('/search/{query}', function ($query) {
        $b = Bank::resolve($query);
        return $b ?? response('', 404);
    })->name('search');
});
