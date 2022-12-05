<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(Client::orderBy('email', 'ASC')->with('appointments.stylist', 'appointments.service')->get());
    }

    // get single client
    public function show1($email)
    {
        return response()
            ->json(Client::where('email', $email)
                ->with('appointments.stylist', 'appointments.service')
                ->orderByDesc('email', 'DESC')
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
