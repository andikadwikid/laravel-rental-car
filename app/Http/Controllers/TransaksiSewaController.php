<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\TransaksiSewa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransaksiSewaController extends Controller
{
    public function pinjam_index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('transaksi_sewas')
                ->select(
                    'transaksi_sewas.id',
                    'transaksi_sewas.tgl_mulai',
                    'transaksi_sewas.tgl_selesai',
                    'transaksi_sewas.tgl_kembali',
                    'users.name as user',
                    'mobils.no_plat',
                    'mobils.tarif',
                    'merks.nama as merk',
                    'model_mobils.nama as model'
                )
                ->join('mobils', 'mobils.id', '=', 'transaksi_sewas.kendaraan_id')
                ->join('users', 'users.id', '=', 'transaksi_sewas.user_id')
                ->join('merks', 'merks.id', '=', 'mobils.merk')
                ->join('model_mobils', 'model_mobils.id', '=', 'mobils.model')
                ->where(function ($query) {
                    $query->whereNull('transaksi_sewas.tgl_kembali');
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="flex gap-2">';
                    $btn .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Batal</a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->filter(function ($query) use ($request) {
                    if (!empty($request->get('search'))) {
                        $search = $request->get('search');
                        $query
                            ->orWhere('merk', 'LIKE', "%$search%")
                            ->orWhere('model', 'LIKE', "%$search%")
                            ->orWhere('no_plat', 'LIKE', "%$search%")
                            ->where(function ($query) {
                                $query->whereNull('transaksi_sewas.tgl_kembali');
                            });
                    }
                })
                ->make(true);
        }
        return view('sewa_mobil.pinjam_mobil');
    }

    public function getDataKendaraan()
    {
        $mobils = DB::table('mobils')
            ->select('mobils.id', 'merks.nama as merk', 'model_mobils.nama as model', 'mobils.tarif', 'mobils.no_plat')
            ->join('merks', 'merks.id', '=', 'mobils.merk')
            ->join('model_mobils', 'model_mobils.id', '=', 'mobils.model')
            ->whereNotIn('mobils.id', function ($query) {
                $query->select('kendaraan_id')
                    ->from('transaksi_sewas')
                    ->orWhereNull('transaksi_sewas.tgl_kembali');
            })
            ->get();

        return response()->json($mobils);
    }

    public function retur_mobil(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('transaksi_sewas')
                ->select(
                    'transaksi_sewas.id',
                    'transaksi_sewas.tgl_mulai',
                    'transaksi_sewas.tgl_selesai',
                    'transaksi_sewas.tgl_kembali',
                    'users.name as user',
                    'mobils.no_plat',
                    'mobils.tarif',
                    'merks.nama as merk',
                    'model_mobils.nama as model'
                )
                ->join('mobils', 'mobils.id', '=', 'transaksi_sewas.kendaraan_id')
                ->join('users', 'users.id', '=', 'transaksi_sewas.user_id')
                ->join('merks', 'merks.id', '=', 'mobils.merk')
                ->join('model_mobils', 'model_mobils.id', '=', 'mobils.model')
                ->where(function ($query) {
                    $query->whereNull('transaksi_sewas.tgl_kembali');
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="flex gap-2">';
                    $btn .= '<a href="javascript:void(0)" class="update btn btn-success btn-sm" data-id="' . $row->id . '">Kembalikan</a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->filter(function ($query) use ($request) {
                    if (!empty($request->get('search'))) {
                        $search = $request->get('search');
                        $query
                            ->orWhere('merks.nama', 'LIKE', "%$search%")
                            ->orWhere('model_mobils.nama', 'LIKE', "%$search%")
                            ->orWhere('mobils.no_plat', 'LIKE', "%$search%");
                    }
                })
                ->make(true);
        }

        return view('sewa_mobil.kembalikan_mobil');
    }

    public function retur_mobil_history(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('transaksi_sewas')
                ->select(
                    'transaksi_sewas.id',
                    'transaksi_sewas.tgl_mulai',
                    'transaksi_sewas.tgl_selesai',
                    'transaksi_sewas.tgl_kembali',
                    'users.name as user',
                    'mobils.no_plat',
                    'mobils.tarif',
                    'merks.nama as merk',
                    'model_mobils.nama as model'
                )
                ->join('mobils', 'mobils.id', '=', 'transaksi_sewas.kendaraan_id')
                ->join('users', 'users.id', '=', 'transaksi_sewas.user_id')
                ->join('merks', 'merks.id', '=', 'mobils.merk')
                ->join('model_mobils', 'model_mobils.id', '=', 'mobils.model')
                ->where(function ($query) {
                    $query->whereNotNull('transaksi_sewas.tgl_kembali');
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="flex gap-2">';
                    $btn .= '<a href="javascript:void(0)" class="update btn btn-success btn-sm" data-id="' . $row->id . '">Kembalikan</a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->filter(function ($query) use ($request) {
                    if (!empty($request->get('search'))) {
                        $search = $request->get('search');
                        $query
                            ->orWhere('merk', 'LIKE', "%$search%")
                            ->orWhere('model', 'LIKE', "%$search%")
                            ->orWhere('no_plat', 'LIKE', "%$search%")
                            ->where(function ($query) {
                                $query->whereNotNull('transaksi_sewas.tgl_kembali');
                            });
                    }
                })
                ->make(true);
        }

        return view('sewa_mobil.kembalikan_mobil');
    }

    public function getTarif($id)
    {
        $data = Mobil::where('id', $id)->first();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $startDate = Carbon::parse($request->tgl_mulai);
        $endDate = Carbon::parse($request->tgl_selesai);
        $numberOfDays = $endDate->diffInDays($startDate);

        TransaksiSewa::create([
            'kendaraan_id' => $request->kendaraan,
            'user_id' => auth()->user()->id,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'total_tagihan' => $numberOfDays * $request->tarif
        ]);

        return response()->json(['success' => 'Data Berhasil Disimpan !']);
    }

    public function kembalikan_mobil($id)
    {
        $sewa = TransaksiSewa::where('id', $id)->where('tgl_kembali', null);
        if ($sewa->exists()) {
            $sewa->update([
                'tgl_kembali' => Carbon::now()
            ]);
            return response()->json(['success' => 'Mobil Berhasil Dikembalikan !']);
        } else {
            return response()->json(['success' => 'Tidak bisa dikembalikan !']);
        }
    }

    public function destroy($id)
    {
        $sewa = TransaksiSewa::where('id', $id)->where('tgl_kembali', null);
        if ($sewa->exists()) {
            $sewa->delete();
            return response()->json(['success' => 'Data Berhasil Dihapus !']);
        } else {
            return response()->json(['success' => 'Tidak bisa dibatalkan !']);
        }
    }
}
