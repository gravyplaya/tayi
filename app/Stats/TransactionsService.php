<?php

namespace App\Stats;

use App\Models\History;
use App\Models\Transaction;
use DB;

class TransactionsService
{
    private $year;
    private $month;

    public function __construct(int $year, int $month)
    {
        $this->year = $year;
        $this->month = $month;
    }


    public function getTransactions()
    {
        $payments = Transaction::select(DB::raw("sum(amount) as data"), DB::raw("MONTH(created_at) month"))
            ->whereYear('created_at', $this->year)
            ->where('status', 'success')
            ->groupBy('month')
            ->orderBy('month')
            ->get()->toArray();

        $data = [];

        for ($i = 1; $i <= 12; $i++) {
            $data[$i] = 0;
        }

        foreach ($payments as $row) {
            $month = $row['month'];
            $data[$month] = intval($row['data']);
        }

        return $data;
    }


    public function getTotalTransactionssCurrentYear()
    {
        $payments = Transaction::select(DB::raw("sum(amount) as data"))
            ->whereYear('created_at', $this->year)
            ->where('status', 'success')
            ->get();

        return $payments;
    }


    public function getTotalTransactionssCurrentMonth()
    {
        $payments = Transaction::select(DB::raw("sum(amount) as data"))
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->where('status', 'success')
            ->get();

        return $payments;
    }


    public function getTotalTransactionssPastMonth()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth = $date->subMonth()->format('m');

        $payments = Transaction::select(DB::raw("sum(amount) as data"))
            ->whereMonth('created_at', $pastMonth)
            ->whereYear('created_at', $this->year)
            ->where('status', 'success')
            ->get();

        return $payments;
    }


    public function getTotalTransactionsCurrentMonth()
    {
        $payments = Transaction::select(DB::raw("count(id) as data"))
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->where('status', 'success')
            ->get();

        return $payments;
    }


    public function getTotalTransactionsPastMonth()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth = $date->subMonth()->format('m');

        $payments = Transaction::select(DB::raw("count(id) as data"))
            ->whereMonth('created_at', $pastMonth)
            ->whereYear('created_at', $this->year)
            ->where('status', 'success')
            ->get();

        return $payments;
    }


    public function getTotalTransactionsCurrentYear()
    {
        $payments = Transaction::select(DB::raw("count(id) as data"))
            ->whereYear('created_at', $this->year)
            ->where('status', 'success')
            ->get();

        return $payments;
    }

    public function getTotalImagesCurrentMonth()
    {
        $total_images = History::whereYear('created_at', $this->year)
            ->where('image', '!=', NULL)
            ->count();

        return $total_images;
    }

    public function getTotalImagesPastMonth()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth = $date->subMonth()->format('m');


        $total_images = History::whereMonth('created_at', $pastMonth)
            ->whereYear('created_at', $this->year)
            ->where('image', '!=', NULL)
            ->count();

        return $total_images;
    }

}
