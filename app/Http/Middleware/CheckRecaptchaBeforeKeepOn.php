<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CheckRecaptchaBeforeKeepOn
{
    public function handle(Request $request, Closure $next)
    {
        if ('testing' === App::environment()) {
            return $next($request);
        }

        if(!$request->has('g-recaptcha-response')) {
            throw new \InvalidArgumentException('Re captcha parameter was not found');
        }

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query([
                    'secret' => env('GOOGLE_RE_CAPTCHA_SECRET'),
                    'response' => $request->get('g-recaptcha-response')
                ])
            ]
        ];
        $context  = stream_context_create($options);
        $response = json_decode(file_get_contents(env('GOOGLE_RE_CAPTCHA_URL'), false, $context), true);

        if($response['success'] === false){
            throw new \InvalidArgumentException($response['error-codes'][0]);
        }

        return $next($request);
    }
}
