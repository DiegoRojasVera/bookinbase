<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    // get single post
    public function show($id)
    {
        return response([
            'post' => Appointment::where('id', $id)->withCount('dated_at', 'finish_at')->get()
        ], 200);
    }
}
