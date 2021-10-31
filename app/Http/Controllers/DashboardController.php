<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\TransactionInt;
use App\Models\TransactionOut;
use Illuminate\Support\Facades\DB;
use App\User;

class DashboardController extends Controller
{
/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){
        $totalEmploye = DB::table('employe')->where('status',1)->count();
        $totalUser = DB::table('users')->where('status',1)->count();
        $totalCaisse  = DB::table('total_caisses')->SUM('total_caisse');
        $totalTransactionInt = DB::table('transaction_ints')->count();
        $totalTransactionOut = DB::table('transaction_outs')->count();

        $users = User::where('status',1)->take(6)->get();

        $employeRandom = Employe::where('status',1)->get();
        $employeRandomArray = [];
        foreach($employeRandom as $employe){
            $employeRandomArray[] = $employe;
        }
        shuffle($employeRandomArray);
        $employeRandom = $employeRandomArray[0];

        $tansactionAll     = [];
        $transactionIntAll = TransactionInt::orderByDesc('created_at')->take(3)->get();
        $transactionOutAll = TransactionOut::orderByDesc('created_at')->take(3)->get();
        foreach($transactionIntAll as $transaction){
            $tansactionAll[] = $transaction;
        }
        foreach($transactionOutAll as $transaction){
            $tansactionAll[] = $transaction;
        }
        shuffle($tansactionAll);
        $classNameInt = TransactionInt::class;

        $employeAll   = Employe::where('status',1)->orderByDesc('created_at')->take(4)->get();

        $transactionIntAll = TransactionInt::orderByDesc('created_at')->take(2)->get();
        $transactionOutAll = TransactionOut::orderByDesc('created_at')->take(3)->get();

        return view('index' , compact('users','totalUser','employeAll','totalEmploye','totalCaisse','totalTransactionInt','totalTransactionOut','employeRandom','tansactionAll','classNameInt','transactionIntAll','transactionOutAll'));
    }
}

