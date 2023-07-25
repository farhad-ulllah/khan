<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductCreated extends Notification implements ShouldQueue
{
    use Queueable;
    private  $productAdded;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($productAdded)
    {
        $this->productAdded=$productAdded;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->line($this->productAdded->name)
        //             ->action('Go To Website For More Detail', url('/http:localhost/Ecommerce_project'))
        //             ->line('Thank you !');   
        //      ->attach('/path/to/file', [
        //     'as' => 'name.pdf',
        //     'mime' => 'application/pdf',
        // ]);

        $detail=$this->productAdded;
                    return (new MailMessage)
                    ->subject('Softlee Latest Product')
                    ->view('email',compact('detail'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
