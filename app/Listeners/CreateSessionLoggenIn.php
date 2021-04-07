<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use App\Profiles;

class CreateSessionLoggenIn
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (Auth::check())
        {
            //echo $event->login.'listenner has been called';
            $id = Auth::user()->id;
            $user = User::with('profiles')->find($id);
            
            if(empty($user->profiles->status_id)){
                $profile = new Profiles();
                $profile->id = $id;
                $profile->status_id = '1';
                $profile->save();

                session::put('status','1');
            }else{
                session::put('status',$user->profiles->status_id);
            }  
            session::put('fullname',$user->name);       
        }
    }
}
