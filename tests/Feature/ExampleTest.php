<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Dapil;
use App\Models\Korcam;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic test example.
     */
    /** @test */

    // public function it_can_insert_1000_items()
    // {
    //     $itemsData = [];

    //     for ($i = 1; $i <= 1000; $i++) {
    //         $itemsData[] = [
    //             'nama_dapil' => 'contoh ' . $i,
    //             'wilayah' => 'bogor ' . $i,
    //             'keterangan' => 'testing ' . $i,
    //         ];
    //     }

    //     Dapil::insert($itemsData);

    //     $this->assertEquals(1000, Dapil::count());
    // }

    public function korcams()
    {
        $itemsData = [];

        for ($i = 1; $i <= 1000; $i++) {
            $itemsData[] = [
                'nama_koordinator'=> 'contoh ' . $i,
                'phone' => '123 ' . $i,
                'nik' => '73284 ' . $i,
                'nokk' => '74328452 ' . $i,
                'kabkota_id' => '2 ' . $i,
                'tgl_lahir' => '12/03/12 ' . $i,
                'alamat' => 'contoh ' . $i,
                'rt' => '1 ' . $i,
                'rw' => '2 ' . $i,
                'kelurahan_id' => '1 ' . $i,
                'status' => '1 ' . $i,
                'keterangan' => 'contoh ' . $i,
                // 'user_id'   => 'contoh ' . $i,
                'kelurahan_id' => '1 ' . $i,
                'tpsrw_id' => '1 ' . $i,
            ];
        }

        Korcam::insert($itemsData);

        $this->assertEquals(1000, Korcam::count());
    }
}
