<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListItemController extends Controller
{
    function tampilkan() {
        $item = [
            ['id' => 101, 'tipe' => 'Basic', 'harga' => 100000, 'status' => 'Tidak Tersedia'],
            ['id' => 102, 'tipe' => 'Small Box', 'harga' => 50000, 'status' => 'Tersedia'],
            ['id' => 103, 'tipe' => 'High Cam', 'harga' => 70000, 'status' => 'Tidak Tersedia'],
        ];

        return view('list_item', ['item' => $item]);
    }
}
?>