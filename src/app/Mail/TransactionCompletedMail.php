<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Item;
use App\Models\User;

class TransactionCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    public $seller;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Item $item, User $seller)
    {
        $this->item = $item;
        $this->seller = $seller;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('【お知らせ】取引が完了しました')
                    ->view('emails.transaction_completed');
    }
}
