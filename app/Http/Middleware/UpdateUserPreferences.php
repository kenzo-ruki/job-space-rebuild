<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;

class UpdateUserPreferences
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $searchFormData = session('search_form_data', false);
        if ($searchFormData) {
            // Assuming the search data is an associative array with 'keywords', 'locations', and 'categories' keys
            $keywords = $searchFormData['keywords'] ?? '';
            $location = $searchFormData['location'] ?? '';
            $category = $searchFormData['category'] ?? '';

            // Get the user and their preferences
            $user = Auth::user();

            if ($user === null) {
                // Stop execution and return from the function
                return $next($request);
            }

            $preferences = $user->jobPreference ?? new UserPreference(['user_id' => $user->id]);

            // Unserialize existing preferences
            $existingKeywords = $preferences->keywords ? unserialize($preferences->keywords) : [];
            $existingLocations = $preferences->locations ? unserialize($preferences->locations) : [];
            $existingCategories = $preferences->categories ? unserialize($preferences->categories) : [];

            // Merge existing and new preferences
            if (!in_array($keywords, $existingKeywords)) {
                $existingKeywords[] = $keywords;
            }

            if (!in_array($location, $existingLocations)) {
                $existingLocations[] = $location;
            }

            if (!in_array($category, $existingCategories)) {
                $existingCategories[] = $category;
            }

            // Serialize and store merged preferences
            $preferences->keywords = serialize($existingKeywords);
            $preferences->locations = serialize($existingLocations);
            $preferences->categories = serialize($existingCategories);
            $preferences->save();
        }

        return $next($request);
    }
}
