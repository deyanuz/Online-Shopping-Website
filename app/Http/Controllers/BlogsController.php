<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class BlogsController extends Controller
{
    public function index(Request $request,$query)
    {
        $apiKey = 'a0f93a75b93b4b27a6b2d59ae7e430ab'; // Replace with your NewsAPI.org API key
        //$query = 'anime'; // Your search query
        $perPage = 10;

        try {
            $response = Http::get("https://newsapi.org/v2/everything", [
                'q' => $query,
                'apiKey' => $apiKey,
                'pageSize' => $perPage,
                'page' => $request->query('page', 1)
            ]);

            $data = $response->json();

            // Extract articles from the response
            $articles = $data['articles'];
            $paginator = \Illuminate\Pagination\Paginator::resolveCurrentPage('page') ?: 1;
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                $articles,
                $data['totalResults'],
                $perPage,
                $paginator,
                ['path' => $request->url()]
            );
            //dd($articles);

            // Pass the paginator to the view
            return view('frontend.blogs', ['articles' => $paginator]);
        } catch (\Exception $e) {
            // Handle errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
