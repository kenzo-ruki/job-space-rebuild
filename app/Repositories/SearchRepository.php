<?php

namespace App\Repositories;

use App\Models\SavedSearch;

class SearchRepository
{
    public function getSearchLink(SavedSearch $search)
    {
        $category = $search->category;
        $subCategory = $search->sub_category;
        $location = $search->location;
        $keywords = $search->keywords;

        if ($category && $subCategory && $location && $keywords) {
            return route('jobs.sub_category_location_keyword', ['category' => $category, 'sub_category' => $subCategory, 'location' => $location, 'keywords' => $keywords]);
        } elseif ($category && $subCategory && $location) {
            return route('jobs.sub_category_location', ['category' => $category, 'sub_category' => $subCategory, 'location' => $location]);
        } elseif ($category && $subCategory && $keywords) {
            return route('jobs.sub_category_keyword', ['category' => $category, 'sub_category' => $subCategory, 'keywords' => $keywords]);
        } elseif ($category && $subCategory) {
            return route('jobs.sub_category', ['category' => $category, 'sub_category' => $subCategory]);
        } elseif ($category && $location && $keywords) {
            return route('jobs.category_location_keyword', ['category' => $category, 'location' => $location, 'keywords' => $keywords]);
        } elseif ($category && $location) {
            return route('jobs.category_location', ['category' => $category, 'location' => $location]);
        } elseif ($category && $keywords) {
            return route('jobs.category_keyword', ['category' => $category, 'keywords' => $keywords]);
        } elseif ($category) {
            return route('jobs.category', ['category' => $category]);
        } elseif ($location && $keywords) {
            return route('jobs.location_keyword', ['location' => $location, 'keywords' => $keywords]);
        } elseif ($location) {
            return route('jobs.location', ['location' => $location]);
        } elseif ($keywords) {
            return route('jobs.keywords', ['keywords' => $keywords]);
        } else {
            return route('jobs');
        }
    }
}
