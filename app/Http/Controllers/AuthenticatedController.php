<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;


// class AuthenticatedController extends Controller
// {
//     public function index()
//     {
//         $User = User::all();
//         return view('brands.login', ['data_brand' => $User]);
//     }

//     public function login(Request $request)
//     {

//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ]);

//         $user = User::where('email', $request->email)->first();

//         if (!$user || !Hash::check($request->password, $user->password)) {
//             throw ValidationException::withMessages([
//                 'email' => ['The provided credentials are incorrect.'],
//             ]);
//         }

//         return $user->createToken(' User Login ')->plainTextToken;
//     }

//     public function logout(Request $request)
//     {

//         $request->user()->currentAccessToken()->delete();
//     }

//     public function me(Request $request)
//     {

//         return response()->json(Auth::user());
//     }
// }

class AuthenticatedController extends Controller
{
    public function index()
    {
        $User = User::all();
        return view('brands.login', ['data_brand' => $User]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Initialize GuzzleHttp client
        $client = new Client();

        try {
            // Send a POST request to the login endpoint
            $response = $client->post('http://127.0.0.1:8001/api/login', [
                'form_params' => [
                    'email' => $request->email,
                    'password' => $request->password,
                ]
            ]);

            // Check if login is successful (status code 200)
            if ($response->getStatusCode() === 200) {
                // Get token from the response body
                $token = $response->getBody()->getContents();

                // You may store the token in session or wherever needed
                session(['token' => $token]);

                // Redirect to the desired route
                // return Redirect::route('brands.create');
                return redirect()->route('brands.create')->with('success', 'Login successful');
            } else {
                // Handle other status codes if needed
                return response()->json('Login failed', $response->getStatusCode());
            }

        } catch (\Exception $e) {
            // Handle exceptions, e.g., connection errors
            return response()->json($e->getMessage(), 500);
        }
    }




    public function logout(Request $request)
    {
        // Ambil token saat ini dari pengguna yang sedang login
        $token = $request->user()->currentAccessToken();

        // Pastikan token tersedia sebelum mencoba logout
        if ($token) {
            try {
                // Kirim permintaan POST ke endpoint logout menggunakan GuzzleHttp
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token->plainTextToken
                ])->post('http://127.0.0.1:8001/api/logout');

                // Periksa jika permintaan berhasil (status code 200)
                if ($response->successful()) {
                    // Hapus token dari tabel personal_access_tokens
                    $token->delete();

                    // Redirect atau berikan respons sukses
                    return redirect('/login')->with('success', 'Logout berhasil');
                } else {
                    // Tangani kesalahan jika logout gagal
                    return back()->withErrors('Logout gagal. Silakan coba lagi.');
                }
            } catch (\Exception $e) {
                // Tangani kesalahan jika terjadi exception
                return back()->withErrors('Terjadi kesalahan saat melakukan logout. Silakan coba lagi.');
            }
        } else {
            // Token tidak tersedia, tangani kasus ini
            return back()->withErrors('Tidak dapat menemukan token pengguna.');
        }
    }



    public function me(Request $request)
    {
        // Initialize GuzzleHttp client
        $client = new Client();

        try {
            // Send a GET request to the user profile endpoint
            $response = $client->get('http://127.0.0.1:8001/api/me', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->user()->api_token,
                ]
            ]);

            // Check if request is successful (status code 200)
            if ($response->getStatusCode() === 200) {
                // Return user data as JSON response
                return response()->json($response->getBody()->getContents());
            } else {
                // Handle other status codes if needed
                return response()->json('Failed to fetch user data', $response->getStatusCode());
            }
        } catch (\Exception $e) {
            // Handle exceptions, e.g., connection errors
            return response()->json($e->getMessage(), 500);
        }
    }
}

