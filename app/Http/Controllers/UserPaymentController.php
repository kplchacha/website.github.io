<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UserPaymentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var User */
        $currentUser = $request->user();

        $payments = $currentUser->rentPayments()->paginate(16);

        return view('user.payments', compact('payments'));
    }

    /**
     * Prints the payment history
     */
    public function print(Request $request)
    {
        /** @var User */
        $currentUser = $request->user();

        $payments = $currentUser->rentPayments;

        $pdf = App::make('dompdf.wrapper');

        $pdf = $pdf->loadView('pdf.payments', compact('payments'));

        return $pdf->download('payments.pdf');
    }
}
