<?php
/**
 * Created by Larakit.
 * Link: http://github.com/larakit
 * User: Alexey Berdnikov
 * Date: 19.05.17
 * Time: 7:41
 */

namespace Larakit\Google2fa;

class Google2faMiddleware {
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, \Closure $next) {
        $user = \Auth::getUser();
        //если пользователь авторизован и у него установлен секретный код двухфакторной авторизации
        if($user && $user->google2fa_secret){
            
        }
        return $next($request);
    }
    
}