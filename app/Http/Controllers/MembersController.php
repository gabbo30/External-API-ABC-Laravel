<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MembersController extends Controller
{
    public $api_key;
    public $api_password;
    public $club_id = '3754';

    public function __construct()
    {
        // Definir las credenciales de la API
        $this->api_key = '882d6106';
        $this->api_password = 'b43f09a91bf1bc7b5b33dfb9651ddf19';
    }

    public function members()
    {
        $url = "https://api.abcfinancial.com/rest/{$this->club_id}/members/";

        $response = Http::withHeaders([
            'app_id' => $this->api_key,
            'app_key' => $this->api_password,
            'Accept' => 'application/json',
        ])->get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'Error en la solicitud a la API'], 500);
        }

        $data = $response->json();

        if ($data === null || json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Error al decodificar la respuesta JSON'], 500);
        }

        return response()->json($data);
    }
}
