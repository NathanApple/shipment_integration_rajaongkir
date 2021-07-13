<?php

namespace App\Http\Controllers;
// use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    public function daftar_provinsi(){

        $daftarProvinsi = Http::withHeaders([
            'key' =>  env("RAJAONGKIR_API_KEY", "0")
        ])->
        get('https://api.rajaongkir.com/starter/province');

        return $daftarProvinsi->json();
    }

    public function daftar_kota(Request $request){

        $province = $request->input('province');

        $daftarkota = Http::withHeaders([
            'key' =>  env("RAJAONGKIR_API_KEY", "0")
        ])->
        get('https://api.rajaongkir.com/starter/city', [
            'province' => $province,
        ]);

        return $daftarkota->json();
    }

    public function check_harga(Request $request){
    
        $post_params = [
            'origin' => $request->input('origin'),
            'destination' => $request->input('destination'),
            'weight' => $request->input('weight'),
            'courier' => $request->input('courier'),
        ];

        $daftarkota = Http::withHeaders([
            'key' =>  env("RAJAONGKIR_API_KEY", "0")
        ])->
        post('https://api.rajaongkir.com/starter/cost', $post_params);

        return $daftarkota->json();

    }

}
