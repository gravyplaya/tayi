<?php

namespace App\Stats;

use App\Models\Folder;
use App\Models\History;
use App\Models\Project;
use DB;

class CostsService
{
    private $year;
    private $month;

    public function __construct(int $year = null, int $month = null)
    {
        $this->year = $year;
        $this->month = $month;
    }


    public function total_tokens_used_this_month()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth = $date->subMonth()->format('m');

        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = $total_words[0]['data'];
        return $total;
    }

    public function total_tokens_used_past_month()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth = $date->subMonth()->format('m');

        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->whereMonth('created_at', $pastMonth)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = $total_words[0]['data'];
        return $total;
    }


    public function total_project_this_month()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth = $date->subMonth()->format('m');

        $total_words = Project::whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = count($total_words);
        return $total;
    }

    public function total_project_past_month()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth = $date->subMonth()->format('m');

        $total_words = Project::whereMonth('created_at', $pastMonth)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = count($total_words);
        return $total;
    }

    public function total_folder_this_month()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth = $date->subMonth()->format('m');

        $total_words = Folder::whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = count($total_words);
        return $total;
    }

    public function total_folder_past_month()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth = $date->subMonth()->format('m');

        $total_words = Folder::whereMonth('created_at', $pastMonth)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = count($total_words);
        return $total;
    }

    public function getTotalDavinciPastMonth()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth = $date->subMonth()->format('m');

        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->where('model', 'text-davinci-003')
            ->whereMonth('created_at', $pastMonth)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = ($total_words[0]['data'] / 1000) * 0.02;
        return $total;
    }


    public function getTotalDavinciCostCurrentMonth()
    {
        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->where('model', 'text-davinci-003')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = ($total_words[0]['data'] / 1000) * 0.02;
        return $total;
    }


    public function getTotalDavinciCostCurrentYear()
    {
        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->where('model', 'text-davinci-003')
            ->whereYear('created_at', $this->year)
            ->get();

        $total = ($total_words[0]['data'] / 1000) * 0.02;
        return $total;
    }


    public function getTotalCuriePastMonth()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth = $date->subMonth()->format('m');

        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->where('model', 'text-curie-001')
            ->whereMonth('created_at', $pastMonth)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = ($total_words[0]['data'] / 1000) * 0.002;
        return $total;
    }


    public function getTotalCurieCostCurrentMonth()
    {
        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->where('model', 'text-curie-001')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = ($total_words[0]['data'] / 1000) * 0.002;
        return $total;
    }


    public function getTotalCurieCostCurrentYear()
    {
        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->where('model', 'text-curie-001')
            ->whereYear('created_at', $this->year)
            ->get();

        $total = ($total_words[0]['data'] / 1000) * 0.002;
        return $total;
    }


    public function getTotalBabbagePastMonth()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth = $date->subMonth()->format('m');

        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->where('model', 'text-babbage-001')
            ->whereMonth('created_at', $pastMonth)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = ($total_words[0]['data'] / 1000) * 0.0005;
        return $total;
    }


    public function getTotalBabbageCostCurrentMonth()
    {
        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->where('model', 'text-babbage-001')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = ($total_words[0]['data'] / 1000) * 0.0005;
        return $total;
    }


    public function getTotalBabbageCostCurrentYear()
    {
        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->where('model', 'text-babbage-001')
            ->whereYear('created_at', $this->year)
            ->get();

        $total = ($total_words[0]['data'] / 1000) * 0.0005;
        return $total;
    }


    public function getTotalAdaPastMonth()
    {
        $date = \Carbon\Carbon::now();
        $pastMonth = $date->subMonth()->format('m');

        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->where('model', 'text-ada-001')
            ->whereMonth('created_at', $pastMonth)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = ($total_words[0]['data'] / 1000) * 0.0004;
        return $total;
    }


    public function getTotalAdaCostCurrentMonth()
    {
        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->where('model', 'text-ada-001')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get();

        $total = ($total_words[0]['data'] / 1000) * 0.0004;
        return $total;
    }


    public function getTotalAdaCostCurrentYear()
    {
        $total_words = History::select(DB::raw("sum(token_used) as data"))
            ->where('model', 'text-ada-001')
            ->whereYear('created_at', $this->year)
            ->get();

        $total = ($total_words[0]['data'] / 1000) * 0.0004;
        return $total;
    }

}
