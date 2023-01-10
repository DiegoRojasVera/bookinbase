<?php

namespace App\Http\Controllers;

use App\Models\Client;


class ClientController extends Controller
{
    public function index()
    {
        return response()->json(Client::orderBy('inicio', 'DESC')
            ->with('appointments.stylist', 'appointments.service')
            ->get());
    }

    // get single client
    public function show1($email)
    {
        return response()
            ->json(Client::where('email', $email)
                ->with('appointments.stylist', 'appointments.service')
                ->orderByDesc('inicio', 'DESC')
                ->get());
    }




    //delete post
    public function destroy($id)
    {
        $client = Client::find($id);


        // $client->comments()->delete();
        // $client->likes()->delete();
        $client->delete();

        return response([
            'message' => 'Client deleted.'
        ], 200);
    }
}
