<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Exceptions\Handler;
use App\Siswa;
use App\Kelas;
use App\Sekolah;


class SiswaController extends Controller
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
        $siswa = Siswa::get();
        // Inisisasi Variable
        $message = "";

        // Jika Siswa Nya Lebih Dari Kosong;
        if ($siswa->count() > 0) {
            // Set Ulang Variable $message;
            $message = "Berhasil Mengambil Data Siswa.";
        } else {
            // Set Ulang Variable $message;
            $message = "Data Kosong.";
        }

        $result = array(
            "message" => $message,
            "data" => $siswa
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
    
            $insert = Siswa::create([
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
            $siswa = Siswa::find($id);
    
            $result = ["Message" => "Data tidak ditemukan"];
    
            if ($siswa) {
                $siswa->name = $request->name;
                $siswa->password = $request->password;
    
                $siswa->save();
    
                $result = array([
                    'message' => 'Data berhasil di update',
                    'data' => $siswa
                ]);
                return response()->json($result);
                }
            return response()->json($result);
            
            }
            public function delete(Request $request, $id){
                $siswa = Siswa::find($id);
        
                $result = ["Message" => "Data tidak ditemukan"];
        
                if ($siswa) {
                    $siswa->name = $request->name;
                    $siswa->password = $request->password;
        
                    $siswa->delete();
        
                    $result = array([
                        'message' => 'Data berhasil di hapus',
                        'data' => $siswa
                    ]);
                    return response()->json($result);
                    }
                return response()->json($result);
    }
        public function showbykelas(Request $request, $kelas_id){
            $kelas = Kelas::find($kelas_id);
            $siswa = Siswa::where('kelas_id', $kelas_id)->get();

            $data =[];
            $data = $kelas;
            $data['siswa'] = $siswa;
            $result = ['Message' => 'Data berhasil ditemukan'];

            if($siswa) {
               // $siswa->get();
                $result = array([
                    'Message' => 'Data berhasil di temukan',
                    'data' => $siswa
                ]);

                return response()->json($result);
            }
            return response()->json($result);
        

        }
     public function showbysekolah(Request $request, $id)   
     {
         $kelas = Kelas::where('sekolah_id', $id)->get();
         $kelasId = $kelas->pluck('id'); //pluck itu ngambil 
         $siswa = Siswa::whereIn('kelas_id', $kelasId)->get(); // whereIn=didalam  whereNotIn=diluar 
         $result =array(
             'Message' => 'Data berhasil di tampilkan',
             'data' => $siswa

         );
         return response()->json($result);
     }
    public function sortirkelas(Request $request, $id){
        $sekolah = Sekolah::with(['kelas' => function ($q){ $q ->with('siswa');}])->find($id);

        $result = array([
            'Message' => 'Data berhasil di temukan',
            'data' =>$sekolah
        ]);
        return response()->json($result);

    }
 } 
    



