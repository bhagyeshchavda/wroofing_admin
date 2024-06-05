<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\MailSetting;

class MailConfigMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Fetch the mail configuration settings from the database
        $mailSettings = MailSetting::where('name', 'mail_settings')->select('value')->first();
        $mailSettings = json_decode($mailSettings['value']);

        // Update the Laravel configuration

        Config::set('mail.mailers.driver', 'smtp');
        Config::set('mail.mailers.smtp.host', 'smtp.gmail.com');
        Config::set('mail.mailers.smtp.port', 587);
        Config::set('mail.mailers.smtp.username', $mailSettings->mail_username);
        Config::set('mail.mailers.smtp.password', $mailSettings->mail_password);
        Config::set('mail.from.address', $mailSettings->from_address);
        Config::set('mail.from.name', $mailSettings->from_name);
        // Add other configuration fields here
        // dd(Config::get('mail'));
        return $next($request);
    }
}
