<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Stylist;


class ClientController extends Controller
{
    public function index()
    {
        return response()->json(Client::orderBy('inicio', 'DESC')
            ->with('appointments.stylist', 'appointments.service')
            ->get());
    }

    // get single client
    public function show($email)
    {
        return response()
            ->json(Client::where('email', $email)
                ->with('appointments.stylist', 'appointments.service')
                ->orderByDesc('inicio', 'DESC')
                ->get());
    }

    public function showStylist($stylist)
    {
        return response()
            ->json(Client::where('stylist', $stylist)
            //    ->with('appointments.stylist', 'appointments.service')
                ->orderByDesc('inicio', 'DESC')
                ->get());
    }
    // get single client para ver servicio cada uno se busca por stylista
    public function showall($idservicio)
    {
        return response()
            ->json(Client::where('service', $idservicio)
                // ->with('appointments.stylist')
                ->orderBy('inicio', 'DESC')
                ->get());
    }

    // get single client para ver servicio cada uno
    public function showallID($id)
    {
        return response()
            ->json(Client::where('id', $id)
                //              ->with('appointments.stylist')
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
