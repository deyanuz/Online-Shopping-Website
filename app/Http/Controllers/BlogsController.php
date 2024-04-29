<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogsController extends Controller
{
    public function searchIndex(Request $request)
    {
        $apiKey = 'a0f93a75b93b4b27a6b2d59ae7e430ab'; // Replace with your NewsAPI.org API key
        $query = $request->input('query'); // Your search query
        $perPage = 9;

        try {
            $response = Http::get("https://newsapi.org/v2/everything", [
                'q' => $query,
                'apiKey' => $apiKey,
                'pageSize' => $perPage,
                'page' => $request->query('page', 1)
            ]);

            $data = $response->json();
            $articles = collect($data['articles'])->reject(function ($article) {
                return empty ($article['urlToImage']);
            })->values()->all();
            // Extract articles from the response

            $paginator = Paginator::resolveCurrentPage('page') ?: 1;
            $paginator = new LengthAwarePaginator(
                $articles,
                $data['totalResults'],
                $perPage,
                $paginator,
                ['path' => $request->url()]
            );

            $trendingResponse = Http::get("https://newsapi.org/v2/everything", [
                'q' => 'trending', // Set the query to 'trending'
                'apiKey' => $apiKey,
                'pageSize' => 5, // Set the pageSize to 5 to fetch only 5 responses
            ]);

            $trendingData = $trendingResponse->json();
            $trendingArticles = collect($trendingData['articles'])->reject(function ($article) {
                return empty ($article['urlToImage']);
            })->values()->all();

            // Create paginator
            $trendingPaginator = new LengthAwarePaginator(
                $trendingArticles,
                count($trendingArticles),
                5,
                1,
                ['path' => $request->url()]
            );
            //dd($trendingPaginator);
            // Pass the paginator to the view
            return view('frontend.blogs', ['articles' => $paginator, 'query' => $query, 'trendings' => $trendingPaginator, 'searchQuery' => $query]);
        } catch (\Exception $e) {
            // Handle errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function index(Request $request, $query)
    {
        $apiKey = 'a0f93a75b93b4b27a6b2d59ae7e430ab'; // Replace with your NewsAPI.org API key
        //$query = 'anime'; // Your search query
        $perPage = 9;

        try {
            $response = Http::get("https://newsapi.org/v2/everything", [
                'q' => $query,
                'apiKey' => $apiKey,
                'pageSize' => $perPage,
                'page' => $request->query('page', 1)
            ]);

            $data = $response->json();
            $articles = collect($data['articles'])->reject(function ($article) {
                return empty ($article['urlToImage']);
            })->values()->all();
            // Extract articles from the response

            $paginator = Paginator::resolveCurrentPage('page') ?: 1;
            $paginator = new LengthAwarePaginator(
                $articles,
                $data['totalResults'],
                $perPage,
                $paginator,
                ['path' => $request->url()]
            );

            $trendingResponse = Http::get("https://newsapi.org/v2/everything", [
                'q' => 'trending', // Set the query to 'trending'
                'apiKey' => $apiKey,
                'pageSize' => 5, // Set the pageSize to 5 to fetch only 5 responses
            ]);

            $trendingData = $trendingResponse->json();
            $trendingArticles = collect($trendingData['articles'])->reject(function ($article) {
                return empty ($article['urlToImage']);
            })->values()->all();

            // Create paginator
            $trendingPaginator = new LengthAwarePaginator(
                $trendingArticles,
                count($trendingArticles),
                5,
                1,
                ['path' => $request->url()]
            );
            //dd($trendingPaginator);
            // Pass the paginator to the view
            return view('frontend.blogs', ['articles' => $paginator, 'query' => $query, 'trendings' => $trendingPaginator]);
        } catch (\Exception $e) {
            // Handle errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
