<?php

//  Routes
////////////////////////////////////////////////////////////////////////////////

// Application Routes

// Load Main View (Single-view Application)
Route::get('/', 'AppController@main');

// Add a Ledger Entry
Route::post('/', 'AppController@add');

// Delete Last Ledger Entry
Route::post('/delete_last', 'AppController@delete_last');

// Clear / Delete All Ledger Entries
Route::post('/delete_all', 'AppController@delete_all');


// Error Handling

// Catch-all GET urls, redirect to Main View
Route::get('/{any?}', function(){
    return redirect('/');
});
