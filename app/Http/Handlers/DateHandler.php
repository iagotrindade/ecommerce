<?php

namespace App\Http\Handlers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DateHandler
{
    public static function getCurrentDate() {
        $months = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro'
        ];

        $currentDate = \Carbon\Carbon::now();

        // Extrai informações da data
        $day = $currentDate->format('d');
        $monthNumber = $currentDate->format('n');
        $year = $currentDate->format('Y');
        $hour = $currentDate->format('H:i');

        $month = $months[$monthNumber];

        return "$day de $month de $year - $hour";
    }
}
