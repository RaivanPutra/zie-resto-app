<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu;
use App\Models\Stok;
use App\Models\Transaksi;

class HomeController extends Controller 
{
    public function home(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $start_date = $request->input('tanggal');
        $end_date = $request->input('tanggal');

        $today = '2024-04-26';

        if (!$tanggal || $tanggal == $today) {
            $transactionToday = Transaksi::whereDate('tanggal', $today)->get();
            $transaksi = $transactionToday->count();
        } else{
            $transactionToday =[];
        }

        // Mengambil data menu berdasarkan tanggal
        $menuQuery = Menu::query();
        if ($tanggal) {
            $menuQuery->whereDate('created_at', $tanggal);
        }

        // Mengambil menu terjual paling sering
        $menu_terjualQuery = DB::table('detail_transaksi')
            ->select('menu_id', DB::raw('SUM(jumlah) as total_terjual'))
            ->groupBy('menu_id')
            ->orderByDesc('total_terjual')
            ->limit(5);

        if ($tanggal) {
            $menu_terjualQuery->join('transaksi', 'detail_transaksi.transaksi_id', '=', 'transaksi.id')
                ->whereDate('transaksi.tanggal', $tanggal);
        }

        $menu_terjual = $menu_terjualQuery->get();

        $menusTerjual = [];
        foreach ($menu_terjual as $item) {
            $menu = Menu::find($item->menu_id);
            if ($menu) {
                $menusTerjual[] = [
                    'name' => $menu->nama_menu, 
                    'total_terjual' => $item->total_terjual
                ];
            }
        }

        // Mengambil data transaksi 
        $transactions = Transaksi::selectRaw('DATE(tanggal) as date, SUM(total_harga) as total_harga')
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            return $query->whereBetween('tanggal', [$start_date, $end_date]);
        })
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        // Filter transaksi berdasarkan tanggal
        $transaksis = Transaksi::query();
        if ($tanggal) {
            $transaksis->whereDate('tanggal', $tanggal);
        }
        $countTransaksi = $transaksis->count();

        // Ambil total pendapatan dari tabel Transaksi
        $totalPendapatan = $transaksis->sum('total_harga');

        // Ambil total stok yang ada dari tabel Menu
        // $jumlahStok = Stok::sum('jumlah');
        $stok = Stok::query();
        if ($tanggal) {
            $stok->whereDate('created_at', $tanggal);
        }
        $countStok = $stok->count();

        $totalStok = $stok->sum('jumlah');

        // Mendapatkan user yang sedang login
        $user = Auth::user();
        $name = $user->name;
        $level = $user->level;

        // Mendefinisikan peta nilai untuk level pengguna
        $levelLabels = [
            1 => 'Admin',
            2 => 'Kasir',
            3 => 'Owner'
        ];
        
        // Menentukan label berdasarkan level pengguna
        $userLevel = $levelLabels[$level] ?? 'Unknown';

        $lastCount = 0;

        return view('dashboard.home', [
            'title' => 'Home',
            'name' => $name,
            'level' => $userLevel,
            'jumlahTransaksi' => $countTransaksi,
            'jumlahPendapatan' => $totalPendapatan,
            'jumlahStok' => $totalStok,
            'tanggal' => $tanggal,
            'menus' => $menusTerjual,
            'lastCount' => $lastCount,
            'menusTerjual' => $menusTerjual,
            'transactions' => $transactions,
            'transactionToday' => $transaksi,
        ]);
    }

    public function about(){
        return view('dashboard.about', ['title' => 'About']);
    }

    public function contact(){
        return view('dashboard.contact', ['title' => 'Contact Us']);
    }

    public function dataPenjualan($lastCount)
    {
        if ($lastCount == 0) {
            $data = Transaksi::select(
                'tanggal',
                DB::raw('SUM(subtotal) as total_bayar'),
                DB::raw('COUNT(id) as jml_transaksi')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();
        } else {
            $data = Transaksi::select(
                'tanggal',
                DB::raw('SUM(subtotal) as total_bayar'),
                DB::raw('COUNT(id) as jml_transaksi')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->skip($lastCount)
            ->take(10) // Ambil 10 data berikutnya
            ->get();
        }
        
        return response()->json($data);
    }
}
