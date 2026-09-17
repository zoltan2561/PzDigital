<?php

namespace App\Support;

use Illuminate\Support\Collection;

class MarketingCatalog
{
    public function products(): Collection
    {
        return $this->publishedCollection('products');
    }

    public function projects(): Collection
    {
        return $this->publishedCollection('projects');
    }

    public function featuredProducts(int $limit = 3): Collection
    {
        return $this->products()
            ->filter(fn (array $product): bool => (bool) ($product['featured_on_home'] ?? false))
            ->take($limit);
    }

    public function featuredProjects(int $limit = 3): Collection
    {
        return $this->projects()
            ->filter(fn (array $project): bool => (bool) ($project['featured_on_home'] ?? false))
            ->take($limit);
    }

    public function homepageProjects(int $limit = 3): Collection
    {
        $projects = $this->projects()
            ->filter(fn (array $project): bool => (bool) ($project['featured_on_home'] ?? false));

        if ($projects->isEmpty()) {
            return collect();
        }

        $preferredSlug = (string) config('pzdigital.featured_project_slug', '');
        $primary = $projects->get($preferredSlug) ?? $projects->first();

        return collect([$primary['slug'] => $primary])
            ->merge($projects->except($primary['slug']))
            ->take($limit);
    }

    public function inquiryInterests(): Collection
    {
        return collect(config('pzdigital.inquiry_interests', []));
    }

    public function relatedProjects(array $product): Collection
    {
        $projects = $this->projects();

        return collect($product['related_projects'] ?? [])
            ->map(function (array $relationship) use ($projects): ?array {
                $project = $projects->get($relationship['project_slug']);

                return $project ? [...$project, 'relationship' => $relationship['relationship']] : null;
            })
            ->filter()
            ->values();
    }

    private function publishedCollection(string $key): Collection
    {
        return collect(config("pzdigital.$key", []))
            ->filter(fn (array $item): bool => ($item['publication_status'] ?? null) === 'published'
                && (bool) ($item['content_approved'] ?? false))
            ->sortBy('sort_order');
    }
}
