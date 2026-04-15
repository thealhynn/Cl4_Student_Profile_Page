<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

// Custom RBAC filters
use App\Filters\AuthFilter;
use App\Filters\StudentFilter;
use App\Filters\TeacherFilter;
use App\Filters\AdminFilter;
use App\Filters\ApiAuthFilter;

class Filters extends BaseFilters
{
    public array $aliases = [
        // CI4 built-in filters
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,

        // Custom RBAC filters
        'auth'     => AuthFilter::class,
        'student'  => StudentFilter::class,
        'teacher'  => TeacherFilter::class,
        'admin'    => AdminFilter::class,

        // API Bearer-token filter
        'api_auth' => ApiAuthFilter::class,
    ];

    public array $required = [
        'before' => [
            'pagecache',
        ],
        'after' => [
            'pagecache',
            'performance',
            'toolbar',
        ],
    ];

    public array $globals = [
        'before' => [],
        'after'  => [],
    ];

    public array $methods = [];
    public array $filters = [];
}
