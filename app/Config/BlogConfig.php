<?php

declare(strict_types=1);

namespace Sandbox\Config;

use BlogCore\Core\Config;

class BlogConfig extends Config
{
    private string $rootDir;

    public function __construct()
    {
        // Root of the sandbox project (one level above app/)
        $this->rootDir = dirname(__DIR__, 2);
    }

    public function getSiteTitle(): string
    {
        return 'Blog Core Sandbox';
    }

    public function getSiteUrl(): string
    {
        // Override via environment variable for production deployments
        return rtrim((string)getenv('SITE_URL') ?: 'http://localhost:8000', '/');
    }

    public function getPostsDir(): string
    {
        return $this->rootDir . '/posts';
    }

    public function getCategoriesDir(): string
    {
        return $this->rootDir . '/categories';
    }

    public function getStoragePath(): string
    {
        return $this->rootDir . '/storage/blog.sqlite';
    }

    public function getViewsDir(): string
    {
        return $this->rootDir . '/views';
    }

    public function getPublicDir(): string
    {
        return $this->rootDir . '/public';
    }

    public function getStaticPages(): array
    {
        return [
            ['loc' => '/', 'changefreq' => 'daily', 'priority' => '1.0'],
        ];
    }

}
