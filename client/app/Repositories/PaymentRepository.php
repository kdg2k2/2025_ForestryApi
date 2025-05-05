<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{
    public function store(array $request)
    {
        return Payment::create($request);
    }

    public function findByVnpTxnRef(string $vnp_TxnRef)
    {
        return Payment::where('vnp_TxnRef', $vnp_TxnRef)->first();
    }

    public function update(array $request)
    {
        $record = Payment::find($request['id']);
        $record->update($request);
        return $record;
    }
}
