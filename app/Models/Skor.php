<?php

namespace App\Models;

use App\Traits\IDGenerator;
use Illuminate\Database\Eloquent\Model;

class Skor extends Model
{
    // Trait ini digunakan untuk generate ID otomatis
    use IDGenerator;

    protected $table = 'skor';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    static function hasilKlasemen($klubID)
    {
        $skor = Skor::where('klub_1', $klubID)->orWhere('klub_2', $klubID)->get();
        $totalMenang = 0;
        $totalKalah = 0;
        $totalSeri = 0;
        $totalGoalMenang = 0;
        $totalGoalKalah = 0;
        $poinTotal = 0;

        foreach ($skor as $s) {
            if ($s->klub_1 == $klubID) {
                // di klub 1
                if ($s->skor_klub_1 > $s->skor_klub_2) {
                    // menang
                    $totalMenang++;
                    $totalGoalMenang += $s->skor_klub_1;
                    $poinTotal += 3;
                } elseif ($s->skor_klub_1 < $s->skor_klub_2) {
                    // kalah
                    $totalKalah++;
                    $totalGoalKalah += $s->skor_klub_1;
                } else {
                    // seri
                    $totalSeri++;
                    $poinTotal += 1;
                }
            }

            if ($s->klub_2 == $klubID) {
                // di klub 2
                if ($s->skor_klub_1 < $s->skor_klub_2) {
                    // menang
                    $totalMenang++;
                    $totalGoalMenang += $s->skor_klub_2;
                    $poinTotal += 3;
                } elseif ($s->skor_klub_1 > $s->skor_klub_2) {
                    // kalah
                    $totalKalah++;
                    $totalGoalKalah += $s->skor_klub_2;
                } else {
                    // seri
                    $totalSeri++;
                    $poinTotal += 1;
                }
            }
        }

        return [
            'totalMain' => \count(Skor::where('klub_1', $klubID)->orWhere('klub_2', $klubID)->get()),
            'totalMenang' => $totalMenang,
            'totalKalah' => $totalKalah,
            'totalSeri' => $totalSeri,
            'totalGoalKalah' => $totalGoalKalah,
            'totalGoalMenang' => $totalGoalMenang,
            'poinTotal' => $poinTotal,
        ];
    }

    static function sortKlasemenByPoinTotal($klasemenArray)
    {
        usort($klasemenArray, function ($a, $b) {
            return $b['poinTotal'] - $a['poinTotal'];
        });

        return $klasemenArray;
    }
}
