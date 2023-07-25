<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Newslatter;
use App\Notifications\ProductCreated;
use Illuminate\Support\Facades\Notification;
class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
         $users=Newslatter::all();

        // Newslatter::chunk(1,function($users) use ($product){
        // $receipients=$users->pluck('news_latter_email');
        try{
            foreach($users as $user)
            {
                $email=$user->news_latter_email;
                Notification::route('mail',$email)->notify(new ProductCreated($product));
            }
        }
        catch(\Exception $e){
            dd($ex);
        }
   
       
        // });
       
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
