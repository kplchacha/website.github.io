<?php

namespace App\Http\Livewire;

use App\Models\PaymentMethod;
use Illuminate\Validation\Rule;
use Livewire\Component;

class PaymentMethods extends Component
{

    public $name;
    public $paymentMethodId;

    /**
     * Renders the full page component of payment-methods
     */
    public function render()
    {
        return view('livewire.payment-methods', [
            'paymentMethods' => $this->readPaymentMethods()
        ]);
    }

    /**
     * Return the Payment method validation rules   
     * 
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['bail', 'required', 'max:255', Rule::unique('payment_methods')->ignore($this->paymentMethodId)]
        ];
    }

    /**
     * Creates a payment method in the database
     */
    public function createPaymentMethod()
    {
        $data = $this->validate();

        $paymentMethod = PaymentMethod::create($data);

        if ($paymentMethod) {

            $this->emit('hideUpsertPaymentMethodModal');

        }
    }

    /**
     * Gets all payment methods from the database
     * 
     * @return array of the payment methods from the database
     */
    public function readPaymentMethods()
    {
        return PaymentMethod::all(['id', 'name']);
    }

    /**
     * Updates a database payment method entry
     */
    public function updatePaymentMethod()
    {
        $data = $this->validate();

        $paymentMethod = PaymentMethod::find($this->paymentMethodId);

        if (boolval($paymentMethod)) {

            $paymentMethod->update($data);

            $this->reset();

            $this->emit('hideUpsertPaymentMethodModal');
        }
    }

    /**
     * Delete a payment method entry from the database
     */
    public function deletePaymentMethod()
    {
        $paymentMethod = PaymentMethod::find($this->paymentMethodId);

        if (boolval($paymentMethod)) {
            
            $paymentMethod->delete();

            $this->reset();

            $this->emit('hideDeletePaymentMethodModal');
        }
        
    }

    /**
     * Shows the modal for editing a payment method
     */
    public function editPaymentMethod(PaymentMethod $paymentMethod)
    {
        $this->paymentMethodId = $paymentMethod->id;
        $this->name = $paymentMethod->name;

        $this->emit('showUpsertPaymentMethodModal');
    }

    /**
     * Show the modal for delete a payment method
     */
    public function showDeleteModal(PaymentMethod $paymentMethod)
    {
        $this->paymentMethodId = $paymentMethod->id;
        $this->name = $paymentMethod->name;

        $this->emit('showDeletePaymentMethodModal');
    }
}
