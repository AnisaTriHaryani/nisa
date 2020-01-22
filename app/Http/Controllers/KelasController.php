<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Exceptions\Handler;
use App\Kelas;

class KelasController extends Controller
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
        $kelas = Kelas::get();
        // Inisisasi Variable
        $message = "";

        // Jika Siswa Nya Lebih Dari Kosong;
        if ($kelas->count() > 0) {
            // Set Ulang Variable $message;
            $message = "Berhasil Mengambil Data Siswa.";
        } else {
            // Set Ulang Variable $message;
            $message = "Data Kosong.";
        }

        $result = array(
            "message" => $message,
            "data" => $kelas
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

        $insert = Kelas::create([
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
        $kelas = Kelas::find($id);

        $result = ["Message" => "Data tidak ditemukan"];

        if ($kelas) {
            $kelas->name = $request->name;
            $kelas->password = $request->password;

            $kelas->save();

            $result = array([
                'message' => 'Data berhasil di update',
                'data' => $kelas
            ]);
            return response()->json($result);
            }
        return response()->json($result);
        
        }
        public function delete(Request $request, $id){
            $kelas = Kelas::find($id);
    
            $result = ["Message" => "Data tidak ditemukan"];
    
            if ($kelas) {
                $kelas->name = $request->name;
                $kelas->password = $request->password;
    
                $kelas->delete();
    
                $result = array([
                    'message' => 'Data berhasil di hapus',
                    'data' => $kelas
                ]);
                return response()->json($result);
                }
            return response()->json($result);
    }
}