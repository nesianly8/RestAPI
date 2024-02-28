<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\BrandResource;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\RequestException;
use App\Http\Resources\BrandDetailResource;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::with('writer:id,username')->get();
        return view('brands.index', ['brands' => $brands]);
        // return response()->json(['data' => $brands], 200);
    }


    public function create()
    {
        $brands = Brand::with('writer:id,username')->get();
        $response = Http::withHeaders([
            'key' => '777404a6bf87b04dc0a7cc99e9ac87c7',
        ])->get('https://api.rajaongkir.com/starter/city');
        $provinces = $response['rajaongkir']['results'];

        $responsecity = Http::withHeaders([
            'key' => '777404a6bf87b04dc0a7cc99e9ac87c7',
        ])->get('https://api.rajaongkir.com/starter/city');
        $cities = $responsecity['rajaongkir']['results'];

        // dd($provinces);
        return view('brands.create', [
            'data_brand' => $brands,
            'provinces' => $provinces,
            'cities' => $cities,
        ]);
    }



    // public function store(Request $request)
    // {
    //     // Data that will be sent to the API
    //     $data = [
    //         'brand' => $request->input('brand'),
    //         'description' => $request->input('description'),
    //         'author' => $request->input('author'),
    //     ];

    //     try {
    //         // Send POST request to the API using Laravel HTTP client
    //         $response = Http::post('http://127.0.0.1:8001/brands-store', $data);

    //         // If the data is successfully created in the API, save it to the local database
    //         if ($response->successful()) {
    //             $brand = Brand::create($request->all());
    //             return redirect()->route('brands.index')->with('success', 'Brand created successfully');
    //         } else {
    //             // If there is an error from the API, handle it here
    //             return redirect()->back()->with('error', 'Failed to create data in API. API Response: ' . $response->body());
    //         }
    //     } catch (\Exception $e) {
    //         // Log exception for debugging
    //         \Log::error('HTTP Request Exception: ' . $e->getMessage());

    //         // Handle exception (e.g., connection error)
    //         return redirect()->back()->with('error', 'HTTP Request Exception: ' . $e->getMessage());
    //     }
    // }

    public function store(Request $request)
    {
        // Data that will be sent to the API
        $data = [
            'brand' => $request->input('brand'),
            'description' => $request->input('description'),
            'author' => $request->input('author'),
        ];

        // Guzzle HTTP client to send a POST request to the API
        $client = new Client();

        try {
            // Send POST request to the API
            $response = $client->post('http://127.0.0.1:8001/api/brands-store', [
                'json' => $data,
            ]);

            // Get the response data from the API
            $responseData = json_decode($response->getBody(), true);
            return response()->json(['$responseData'=> $responseData]);
            // If the data is successfully created in the API, save it to the local database
            if ($response->getStatusCode() == 201) {
                $brand = Brand::create($request->all());
                return response()->json(['msg' => 'Data created', 'data' => $brand], 201);
            } else {
                // If there is an error from the API, handle it here
                return response()->json(['error' => 'Failed to create data in API', 'api_response' => $responseData], $response->getStatusCode());
            }
        } catch (RequestException $e) {
            // Log Guzzle request exception for debugging
            \Log::error('Guzzle Request Exception: ' . $e->getMessage());

            // Handle Guzzle request exception (e.g., connection error)
            return response()->json(['error' => 'Guzzle Request Exception: ' . $e->getMessage()], 500);
        }
    }


    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $authors = User::all(); 
        return view('brands.edit', ['data_brand' => $brand, 'authors' => $authors]);
    }


    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|max:45',
            'description' => 'required',
            'author_id' => 'required|exists:users,id', // Menambahkan validasi untuk author_id
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update($request->all());

        // return new BrandDetailResource($brand->loadMissing('writer:id,username'));
        // Atau, jika ingin merespons dengan JSON
        return response()->json(['msg' => 'Data updated', 'data' => $brand], 200);
    }


    function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return response()->json(['msg' => 'Data deleted'], 200);
    }

    public function show($id)
    {

        $brand = Brand::with('writer:id,username')->findOrFail($id);
        return new BrandDetailResource($brand);
    }

    public function show2($id)
    {

        $brand = Brand::findOrFail($id);
        return new BrandDetailResource($brand);
    }
}
