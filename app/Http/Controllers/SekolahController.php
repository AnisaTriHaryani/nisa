<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Exceptions\Handler;
use App\Sekolah;

class SekolahController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function show(Request $request) {
        $sekolah = Sekolah::get();
        // Inisisasi Variable
        $message = "";

        // Jika Siswa Nya Lebih Dari Kosong;
        if ($sekolah->count() > 0) {
            // Set Ulang Variable $message;
            $message = "Berhasil Mengambil Data Siswa.";
        } else {
            // Set Ulang Variable $message;
            $message = "Data Kosong.";
        }

        $result = array(
            "message" => $message,
            "data" => $sekolah
        );

        return response()->json($result);
    
    }
    public function store(Request $request) {

        // Memvalidasi Field Yang Masuk.
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:siswa',
            'password' => 'required|min:6'
        ]);

        $insert = Sekolah::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $result = array(
            'message' => 'Data Siswa Berhasil di Simpan.',
            'data' => $insert
        );

        return response()->json($result);
    }

    public function update(Request $request, $id){
        $sekolah = Sekolah::find($id);

        $result = ["Message" => "Data tidak ditemukan"];

        if ($sekolah) {
            $sekolah->name = $request->name;
            $sekolah->password = $request->password;

            $sekolah->save();

            $result = array([
                'message' => 'Data berhasil di update',
                'data' => $sekolah
            ]);
            return response()->json($result);
            }
        return response()->json($result);
        
        }
        public function delete(Request $request, $id){
            $sekolah = Sekolah::find($id);
    
            $result = ["Message" => "Data tidak ditemukan"];
    
            if ($sekolah) {
                $sekolah->name = $request->name;
                $sekolah->password = $request->password;
    
                $sekolah->delete();
    
                $result = array([
                    'message' => 'Data berhasil di hapus',
                    'data' => $sekolah
                ]);
                return response()->json($result);
                }
            return response()->json($result);
    }
}