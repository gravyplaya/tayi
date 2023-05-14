<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Stats\CostsService;
use App\Stats\RegistrationService;
use App\Stats\TransactionsService;
use App\Stats\UserRegistrationMonthlyService;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Orhanerday\OpenAi\OpenAi;

class DashboardController extends Controller
{
    function index(Request $request)
    {


        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 days'));
        $seventh_day = date('Y-m-d', strtotime('-6 days'));
        $eighth_day = date('Y-m-d', strtotime('-7 days'));
        $dateRange = CarbonPeriod::create($seventh_day, $today);
        $dateRange2 = CarbonPeriod::create($eighth_day, $yesterday);

        $days1 = [];
        $value1 = [];
        $value2 = [];

        $d = json_encode($dateRange->toArray());
        $k = json_decode($d);
        $count = count($k);
        foreach ($k as $dd) {
            $date1[] = date('d F Y', strtotime($dd));
            $gs = date('Y-m-d', strtotime($dd));
            $check = DB::table('users')->whereDate('created_at', $gs)->count();
            $value1[] = $check;

            $check22 = DB::table('transactions')->whereDate('created_at', $gs)->sum('amount');
            $value22[] = $check22;
        }

        $d2 = json_encode($dateRange2->toArray());
        $k2 = json_decode($d2);
        foreach ($k2 as $dd2) {
            $date1[] = date('d F Y', strtotime($dd2));
            $gs2 = date('Y-m-d', strtotime($dd2));
            $check2 = DB::table('users')->whereDate('created_at', $gs2)->count();
            $value2[] = $check2;

            $check23 = DB::table('transactions')->whereDate('created_at', $gs2)->sum('amount');
            $value23[] = $check23;
        }
        $ncgraph = array('value' => $value1, 'date' => $date1, 'date1' => $date1, 'value2' => $value2, 'value3' => $value22, 'value4' => $value23);
        $ncgv = $ncgraph['value'];
        $ncgv2 = $ncgraph['value2'];
        $ncgd = $ncgraph['date1'];
        $today = date('d F Y');
        $ncgt = $ncgraph['value3'];


        $data1 = date('Y-m-d');
        $data2 = date('Y-m-d', strtotime('-1 days'));
        $data3 = date('Y-m-d', strtotime('-2 days'));
        $data4 = date('Y-m-d', strtotime('-3 days'));
        $data5 = date('Y-m-d', strtotime('-4 days'));
        $data6 = date('Y-m-d', strtotime('-5 days'));
        $data7 = date('Y-m-d', strtotime('-6 days'));
        $open_ai_key = getenv('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);

        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));

        $transaction = new TransactionsService($year, $month);

        $cost = new CostsService($year, $month);
        $registration = new RegistrationService($year, $month);
        $user_registration = new UserRegistrationMonthlyService($month);

        $total_data_monthly = [
            'new_users_current_month' => $registration->getNewUsersCurrentMonth(),
            'new_users_past_month' => $registration->getNewUsersPastMonth(),
            'new_subscribers_current_month' => $registration->getNewSubscribersCurrentMonth(),
            'new_subscribers_past_month' => $registration->getNewSubscribersPastMonth(),
            'income_current_month' => $transaction->getTotalTransactionssCurrentMonth(),
            'income_past_month' => $transaction->getTotalTransactionssPastMonth(),
            'spending_current_month' => $cost->getTotalAdaCostCurrentMonth() + $cost->getTotalBabbageCostCurrentMonth() + $cost->getTotalCurieCostCurrentMonth() + $cost->getTotalDavinciCostCurrentMonth(),
            'spending_past_month' => $cost->getTotalAdaPastMonth() + $cost->getTotalBabbagePastMonth() + $cost->getTotalCuriePastMonth() + $cost->getTotalDavinciPastMonth(),
            'transactions_current_month' => $transaction->getTotalTransactionsCurrentMonth(),
            'transactions_past_month' => $transaction->getTotalTransactionsPastMonth(),
            'total_words_current_month' => $cost->total_tokens_used_this_month(),
            'total_words_past_month' => $cost->total_tokens_used_past_month(),
            'total_projects_current_month' => $cost->total_project_this_month(),
            'total_projects_past_month' => $cost->total_project_past_month(),
            'total_folders_current_month' => $cost->total_folder_this_month(),
            'total_folders_past_month' => $cost->total_folder_past_month(),
            'images_current_month' => $transaction->getTotalImagesCurrentMonth(),
            'images_past_month' => $transaction->getTotalImagesPastMonth(),
        ];

        $total_data_yearly = [
            'total_new_users' => $registration->getNewUsersCurrentYear(),
            'total_new_subscribers' => $registration->getNewSubscribersCurrentYear(),
            'total_income' => $transaction->getTotalTransactionsCurrentYear(),
            'total_spending' => $cost->getTotalBabbageCostCurrentYear() + $cost->getTotalAdaCostCurrentYear() + $cost->getTotalCurieCostCurrentYear() + $cost->getTotalDavinciCostCurrentYear(),
            'transactions_generated' => $transaction->getTotalTransactionssCurrentYear(),
        ];

        $chart_data['total_new_users'] = json_encode($registration->getAllUsers());
        $chart_data['monthly_new_users'] = json_encode($user_registration->getRegisteredUsers());
        $chart_data['total_income'] = json_encode($transaction->getTransactions());

        $percentage['users_current'] = json_encode($registration->getNewUsersCurrentMonth());
        $percentage['users_past'] = json_encode($registration->getNewUsersPastMonth());
        $percentage['subscribers_current'] = json_encode($registration->getNewSubscribersCurrentMonth());
        $percentage['subscribers_past'] = json_encode($registration->getNewSubscribersPastMonth());
        $percentage['income_current'] = json_encode($transaction->getTotalTransactionssCurrentMonth());
        $percentage['income_past'] = json_encode($transaction->getTotalTransactionssPastMonth());
        $percentage['spending_current'] = json_encode($cost->getTotalAdaCostCurrentMonth() + $cost->getTotalBabbageCostCurrentMonth() + $cost->getTotalCurieCostCurrentMonth() + $cost->getTotalDavinciCostCurrentMonth());
        $percentage['spending_past'] = json_encode($cost->getTotalAdaPastMonth() + $cost->getTotalBabbagePastMonth() + $cost->getTotalCuriePastMonth() + $cost->getTotalDavinciPastMonth());
        $percentage['transactions_current'] = json_encode($transaction->getTotalTransactionsCurrentMonth());
        $percentage['transactions_past'] = json_encode($transaction->getTotalTransactionsPastMonth());

        $result = User::latest()->take(5)->get();


        $transaction = User::select('users.id', 'users.email', 'users.name', 'users.image', 'transactions.*')->join('transactions', 'transactions.user_id', '=', 'users.id')->orderBy('transactions.created_at', 'DESC')->take(5)->get();


        return view('admin.dashboard', compact('total_data_monthly', 'total_data_yearly', 'chart_data', 'percentage', 'result', 'transaction', 'ncgv', 'ncgd', 'ncgv2', 'ncgt'));

    }


}
