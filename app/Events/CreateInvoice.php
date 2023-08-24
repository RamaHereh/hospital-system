<?php

namespace App\Events;

use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateInvoice implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $patient;
    public $invoiceId;
    public $doctorId;
    public $message;
    public $createdAt;


    public function __construct($data)
    {
        $patient = Patient::find($data['patient_id']);
        $this->patient = $patient->name;
        $this->doctorId = $data['doctor_id'];
        $this->invoiceId = $data['invoice_id'];
        $this->message = "كشف جديد : ";
        $this->createdAt =date('Y-m-d H:i:s');
    }


    public function broadcastOn()
    {
        return new PrivateChannel('create-invoice.'.$this->doctorId);
    }

    public function broadcastAs()
    {
        return 'create-invoice';
    }
}
