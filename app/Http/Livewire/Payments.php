<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Payment;
use Livewire\Component;
use App\Models\RoomUser;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;

class Payments extends Component
{
    public $amount;
    public $description;
    public $payment_method_id;

    public $paymentId;

    public ?RoomUser $roomUser = null;

    /**
     * Renders the payments components
     */
    public function render()
    {
        return view('livewire.payments', ['paymentMethods' => $this->readPaymentMethods()]);
    }

    /**
     * Define validation rules for the payment fields
     * 
     * @return array of the validation rules
     */
    public function rules()
    {
        return [
            'amount' => ['bail', 'required', 'numeric'],
            'description' => ['nullable'],
            'payment_method_id' => ['bail', 'numeric']
        ];
    }

    /**
     * Retrieves payment methods from the database
     * 
     * @return Collection of all the payment methods
     */
    public function readPaymentMethods()
    {
        return PaymentMethod::all(['id', 'name']);
    }

    /**
     * Persists a payment to the database
     */
    public function createPayment()
    {
        /** @var User */
        $currentUser = Auth::user();
        
        $data = $this->validate();

        $data['tenant_id'] = optional($this->roomUser)->user_id;
        $data['recorder_id'] = $currentUser->id;

        $payment = $this->roomUser->payments()->create($data);

        if($payment){

            $this->emit('hideUpsertPaymentModal');

            $this->reset('amount', 'description', 'payment_method_id');
            
        }

    }

    /**
     * Updates a database payment entry
     */
    public function updatePayment()
    {
        $data = $this->validate();

        /** @var Payment */
        $payment = Payment::find($this->paymentId);

        if(boolval($payment)){

            $payment->update($data);

            $this->emit('hideUpsertPaymentModal');
        }
    }

    /**
     * Deletes a payment entry from the database
     */
    public function deletePayment()
    {
        /** @var Payment */
        $payment = Payment::find($this->paymentId);

        if(boolval($payment)){

            $payment->delete();

            $this->emit('hideDeletePaymentModal');
        }
        
    }


    /**
     * Shows the modal for editing a payment
     * @param Payment $payment to be edited
     */
    public function editPayment(Payment $payment)
    {
        $this->payment_method_id = $payment->payment_method_id;
        $this->amount = $payment->amount;
        $this->description = $payment->description;

        $this->paymentId = $payment->id;

        $this->emit('showUpsertPaymentModal');

    }

    /**
     * Show the modal for deleting a payment
     * 
     * @param Payment $payment
     */
    public function showDeletePaymentModal(Payment $payment)
    {

        $this->paymentId = $payment->id;

        $this->emit('showDeletePaymentModal');
        
    }
}
