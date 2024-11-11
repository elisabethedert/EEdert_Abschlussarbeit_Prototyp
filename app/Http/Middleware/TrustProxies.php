<?php
 
namespace App\Http\Middleware;
 
use Illuminate\Http\Request;
use Inertia\Middleware;
 
class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies = '*';

}
