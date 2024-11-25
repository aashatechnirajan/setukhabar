<?php


namespace App\Http\Controllers;


use App\Models\Ad;


use App\Models\Post;
use App\Models\Display;
use App\Models\Favicon;
use App\Models\Gallery;
use App\Models\Section;
use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function processPosts($posts)
    {
        foreach ($posts as $post) {
            $images = json_decode($post->image);


            $firstImagePath = isset($images[0]) ? asset('' . $images[0]) : '';
            $post->firstImagePath = $firstImagePath;
            $post->truncatedTitle = Str::substr($post->title, 0, 200);
        }
    }


    public function index(Request $request)
    {
        // navbar
        $posts = Post::latest()->get()->take(4);
        $images = Gallery::latest()->get()->take(4);
        $categories = Category::all();
        // $adspop = Ad::latest()->first();
       
        $homeadspop = Display::where('title', 'Home Front')->first();
        $homeads = $homeadspop ? $homeadspop->getAds()->latest('id')->first() : null;






        $afternavAdSection = Display::where('title', 'After Navbar Section')->first();
        $afterNavAd = $afternavAdSection ? $afternavAdSection->getAds()->latest('id')->first() : null;
        $bottomSection = Display::where('title', 'Bottom Section')->first();
        $bottomAd = Ad::whereHas('getDisplays', function ($q) use ($bottomSection) {
            $q->where('display_id', $bottomSection->id);
        })->latest()->take(1)->get();
        $afterBreakingNewsSection = Display::where('title', 'After Breaking News Section')->first();
        $afterBreakingAd = $afterBreakingNewsSection ? $afterBreakingNewsSection->getAds()->latest('id')->first() : null;
        $afterMainNewsSection = Display::where('title', 'After Main News Section')->first();
        $afterMainAd = $afterMainNewsSection ? $afterMainNewsSection->getAds()->latest('id')->first() : null;
        $afterStrangeWorldSection = Display::where('title', 'After Strange World Section')->first();
        $afterStrangeWorldAd = $afterStrangeWorldSection ? $afterStrangeWorldSection->getAds()->latest('id')->first() : null;


        // FIRST SECTION NEWS (SKIP the breaking news and cover image section)


        // MIDDLE PART------------------------------------------------------------------------------------
        $firstColumnTwo = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->where('category_id', 1);
            })->orderBy('created_at', 'desc')->latest()->take(1)->get();
        $this->processPosts($firstColumnTwo);




        // RIGHT SIDE -----------------------------------------------------------------------------------------
        $firstColumnOne = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->whereIn('category_id', [1]);
            })
            ->whereNotIn('id', $firstColumnTwo->pluck('id'))
            ->orderBy('created_at', 'desc')->latest()
            ->get()->take(3);
        $this->processPosts($firstColumnOne);


        // LEFT SIDE-----------------------------------------------------------------------------------
        $mainNewsIds = $firstColumnTwo->pluck('id')->toArray();
        $collectedNewsOneIds = $firstColumnOne->pluck('id')->toArray();


        $excludedIds = array_merge($mainNewsIds, $collectedNewsOneIds);


        $firstColumnThree = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->whereIn('category_id', [1]);
            })
            ->whereNotIn('id', $excludedIds)
            ->orderBy('created_at', 'desc')
            ->latest()
            ->take(3)
            ->get();


        $this->processPosts($firstColumnThree);


        //SECOND SECTION NEWS
        // -------------------------------------------------------------------------------------------------
        // -------------------------------------------------------------------------------------------------




        // LEFT SIDE----------------------------------------------------------------------------------------
        $secondColumnOne = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->where('category_id', 2);
            })->orderBy('created_at', 'desc')->latest()->take(1)->get();


        $this->processPosts($secondColumnOne);
        // END OF LEFT SIDE-----------------------------------------------------------------------------------


        // MIDDLE PART-----------------------------------------------------------------------------------
        $secondColumnTwo = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->whereIn('category_id', [2]);
            })
            ->whereNotIn('id', $secondColumnOne->pluck('id'))
            ->orderBy('created_at', 'desc')->latest()
            ->get()->take(3);


        $this->processPosts($secondColumnTwo);


        // RIGHT SIDE-----------------------------------------------------------------------------------
        $secondColumnThree = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->where('category_id', 3);
            })->orderBy('created_at', 'desc')->latest()->take(3)->get();


        $this->processPosts($secondColumnThree);




        //THIRD SECTION NEWS


        // LEFT SIDE---------------------------------------------------------------------------------------
        $thirdRow = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->where('category_id', 4);
            })->orderBy('created_at', 'desc')->latest()->take(6)->get();


        $this->processPosts($thirdRow);








        //FOURTH SECTION NEWS






        // LEFT SIDE---------------------------------------------------------------------------------------
        $fourthRow = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->where('category_id', 5);
            })->orderBy('created_at', 'desc')->latest()->take(4)->get();
        $this->processPosts($fourthRow);


        // ADS SECTION
        $entertainmentAdSection = Display::where('title', 'Entertainment Section Left Side')->first();


        $entertainmentAd = $entertainmentAdSection ? $entertainmentAdSection->getAds()->latest('id')->first() : null;




        //FIFTH SECTION NEWS


        // LEFT SIDE---------------------------------------------------------------------------------------
        $fifthRow = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->where('category_id', 6);
            })->orderBy('created_at', 'desc')->latest()->take(6)->get();


        //SIXTH SECTION NEWS


        // LEFT SIDE---------------------------------------------------------------------------------------
        $sixthColumnOne = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->where('category_id', 7);
            })->orderBy('created_at', 'desc')->latest()->take(3)->get();


        $this->processPosts($sixthColumnOne);


        // MIDDLE PART---------------------------------------------------------------------------------------


        $sixthColumnTwo = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->whereIn('category_id', [7]);
            })
            ->whereNotIn('id', $sixthColumnOne->pluck('id'))
            ->orderBy('created_at', 'desc')->latest()
            ->get()->take(1);


        $this->processPosts($sixthColumnTwo);




        // ADS SECTION
        $economicAdSection = Display::where('title', 'Economic Section Right Side')->first();
        $economicAd = $economicAdSection ? $economicAdSection->getAds()->latest('id')->first() : null;






        //SEVENTH SECTION NEWS


        // SLIDER---------------------------------------------------------------------------------------
        $seventhRowOne = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->where('category_id', 8);
            })->orderBy('created_at', 'desc')->latest()->take(8)->get();


        $this->processPosts($seventhRowOne);


        //EIGHTH SECTION NEWS
        // CAROUSEL-----------------------------------------------------------------------------------------


        $eighthRow = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->where('category_id', 9);
            })
            ->orderBy('created_at', 'desc')->latest()->take(6)->get();
        $this->processPosts($eighthRow);


        // CAROUSEL END--------------------------------------------------------------------------------------
        // ADS SECTION
        $SportsAdSection = Display::where('title', 'Sports Section Right Side')->first();
        $sportsAd = $SportsAdSection ? $SportsAdSection->getAds()->latest('id')->first() : null;




        //NINTH SECTION NEWS




        // LEFT SIDE---------------------------------------------------------------------------------------
        $ninthColumnOne = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->where('category_id', 9);
            })
            ->whereNotIn('id', $eighthRow->pluck('id'))
            ->orderBy('created_at', 'desc')->latest()->take(6)->get();
        $this->processPosts($ninthColumnOne);


        $allothers = Post::with(['getCategories' => function ($query) {
            $query->latest();
        }])
            ->whereHas('getCategories', function ($query) {
                $query->where('category_id', '>=', 11);
            })->orderBy('created_at', 'desc')->latest()->take(6)->get();


        //END OF TENTH SECTION NEWS


        // photo feature


        // coverimage
        $coversection = Section::where('title', 'Lead News')->first();
        $coverimages = Post::whereHas('getSections', function ($q) use ($coversection) {
            $q->where('section_id', $coversection->id);
        })->latest()->get()->take(7);
        $this->processPosts($coverimages);


        // BREAKING NEWS SECTION
        $sitesetting = SiteSetting::first();


        $breakingsection = Section::where('title', 'Breaking News')->first();
        $breakingNews = Post::whereHas('getSections', function ($q) use ($breakingsection) {
            $q->where('section_id', $breakingsection->id);
        })->latest()->get()->take(7);


        $this->processPosts($breakingNews);


        $mukhyasection = Section::where('title', 'Mukhya Samachar')->first();
        $mukhyaNews = Post::whereHas('getSections', function ($q) use ($mukhyasection) {
            $q->where('section_id', $mukhyasection->id);
        })->latest()->get()->take(6);
        $relatedCats = Category::where('id', '>=', 12)->get();
        $postsByCategory = [];
        foreach ($relatedCats as $category) {
            $postsByCategory[$category->id] = $category->getPosts()->orderBy('created_at', 'desc')->take(9)->get();
        }


        $this->processPosts($relatedCats);
        $trendingPosts = Post::orderBy('views', 'desc')->take(4)->get();
        $this->processPosts($trendingPosts);


        $sharedPosts = Post::orderBy('shares', 'desc')->take(4)->get();
        $this->processPosts($sharedPosts);


        $relatedPosts = Post::orderByRaw('LENGTH(tags) - LENGTH(REPLACE(tags, ",", "")) + 1 DESC')
            ->limit(4)
            ->get();
        $this->processPosts($relatedPosts);


        $posts = Post::all();
        $uniqueTags = [];


        foreach ($posts as $post) {
            $tags = explode(',', $post->tags);
            $uniqueTags = array_merge($uniqueTags, $tags);
        }


        $uniqueTags = array_unique($uniqueTags);


        foreach ($posts as $rowOne) {
            $images = json_decode($rowOne->image);


            $firstImagePath = isset($images[0]) ? asset('' . $images[0]) : '';
            $rowOne->firstImagePath = $firstImagePath;
            $rowOne->truncatedTitle = Str::substr($rowOne->title, 0, 200);
        }


        $id = $request->id;
        // Fetch the post based on $id using the Post model
        $po= Post::find($id);






        return view('portal.index', [
            'breakingNews' => $breakingNews,
            'mukhyaNews' => $mukhyaNews,
            'entertainmentAd' => $entertainmentAd,
            'economicAd' => $economicAd,
            'sportsAd' => $sportsAd,
            'afterNavAd' => $afterNavAd,
            'afterMainAd' => $afterMainAd,
            'afterStrangeWorldAd' => $afterStrangeWorldAd,
            'posts' => $posts,
            'post' => $post,
            'sitesetting' => $sitesetting,
            'categories' => $categories,
            'firstColumnTwo' => $firstColumnTwo,
            'firstColumnOne' => $firstColumnOne,
            'firstColumnThree' => $firstColumnThree,
            'secondColumnOne' => $secondColumnOne,
            'coverimages' => $coverimages,
            'secondColumnTwo' => $secondColumnTwo,
            'secondColumnThree' => $secondColumnThree,
            'thirdRow' => $thirdRow,
            'fourthRow' => $fourthRow,
            'fifthRow' => $fifthRow,
            'sixthColumnOne' => $sixthColumnOne,
            'sixthColumnTwo' => $sixthColumnTwo,
            'seventhRowOne' => $seventhRowOne,
            'eighthRow' => $eighthRow,
            'ninthColumnOne' => $ninthColumnOne,
            'relatedPosts' => $relatedPosts,
            'allothers' => $allothers,
            'relatedCats' => $relatedCats,
            'postsByCategory' => $postsByCategory,
            'trendingPosts' => $trendingPosts,
            'sharedPosts' => $sharedPosts,
            'relatedPosts' => $relatedPosts,
            'uniqueTags' => $uniqueTags,
   
            'homeads' => $homeads,

            'afterBreakingAd' => $afterBreakingAd,
            'bottomAd' => $bottomAd,
            'images' => $images,
            'po' => $po,


        ]);
    }
}



