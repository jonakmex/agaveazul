<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    public function handle(Login $event)
    {
      $user = $event->user;
      $user->last_login_at = date('Y-m-d H:i:s');
      $user->last_login_ip = $this->request->ip();
      $user->sessions = $user->sessions == null?1:++$user->sessions; 
      $user->save();
    }
}
