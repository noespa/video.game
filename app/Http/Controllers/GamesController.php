<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $before = Carbon::now()->subMonths(12)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;
        $current = Carbon::now()->timestamp;

        $popularGames = Http::withHeaders(config('services.igdb'))->withBody(
            "fields name, cover.url, first_release_date, platforms.abbreviation, rating, total_rating_count, slug;
            where (rating != null)
            & platforms = (48, 49, 130,6)
            & first_release_date >= {$before}
            & first_release_date < {$after}
            & cover != null
            & total_rating_count > 5;
            sort total_rating_count desc;
            limit 12;",
            'text/plain'
        )->post('https://api.igdb.com/v4/games/')
        ->json();

        $recentlyReviewed = Http::withHeaders(config('services.igdb'))->withBody(
            "fields name, cover.url, first_release_date, platforms.abbreviation, rating, total_rating_count, slug, summary;
            where (rating != null)
            & platforms = (48, 49, 130,6)
            & first_release_date >= {$before}
            & first_release_date < {$current}
            & cover != null
            & total_rating_count > 5;
            sort total_rating_count desc;
            limit 3;",
            'text/plain'
        )->post('https://api.igdb.com/v4/games/')
        ->json();

        $mostAnticipated = Http::withHeaders(config('services.igdb'))->withBody(
            "fields name, cover.url, first_release_date, platforms.abbreviation, rating, total_rating_count, slug, summary, release_dates;
            where (rating != null)
            & platforms = (48, 49, 130,6)
            & release_dates >= {$current}
            & release_dates < {$afterFourMonths}
            & cover != null
            & total_rating_count > 5;
            sort total_rating_count desc;
            limit 4;",
            'text/plain'
        )->post('https://api.igdb.com/v4/games/')
        ->json();
        
        $comingSoon = Http::withHeaders(config('services.igdb'))->withBody(
            "fields name, cover.url, first_release_date, platforms.abbreviation, rating, total_rating_count, slug, summary;
            where (rating != null)
            & platforms = (48, 49, 130,6)
            & release_date >= {$current}
            & cover != null
            & total_rating_count > 5;
            sort total_rating_count desc;
            limit 4;",
            'text/plain'
        )->post('https://api.igdb.com/v4/games/')
        ->json();

        dump($popularGames);
        dump($recentlyReviewed);
        dump($mostAnticipated);
        dump($comingSoon);

        return view('index', [
            'popularGames' => $popularGames,
            'recentlyReviewed' => $recentlyReviewed,
            'mostAnticipated' => $mostAnticipated,
            'comingSoon' => $comingSoon,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
