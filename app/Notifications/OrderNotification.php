<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Mail\Markdown;

class OrderNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $productDetails = collect($this->order->orderDetails)->map(function ($product) {
            return sprintf('%s - amount: %s - price: %s <br>', $product->title, $product->quantity, $product->new_price);
        })->implode('');

        return (new MailMessage)
            ->subject('New order received')
            ->greeting('Hello!')
            ->line('A new order has been received with the following details:')
            ->line('Order ID: ' . $this->order->id)
            ->line('Customer name: ' . $this->order->users->name)
            ->line('Product details: ')
            ->line(Markdown::parse($productDetails))
            ->line('Shipping expenses: ' . $this->order->address->cities->price)
            ->line('Total price: ' . $this->order->grandTotal)
            ->line('Thank you , that was the new order');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
