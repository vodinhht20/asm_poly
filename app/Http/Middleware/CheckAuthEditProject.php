<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CheckAuthEditProject
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::where('email',Auth::user()->email)->first();
        $userNameMail = explode("@fpt.edu.vn",Auth::user()->email)[0];
        $products = Product::where([['create_by',$user->id],['token',$request->token]])
                            ->orWhere([['teacher',$userNameMail],['token',$request->token]])
                            ->first();
        if ($products) {
            return $next($request);
        } else {
            return redirect()->route('error-403');
        }
    }
}
