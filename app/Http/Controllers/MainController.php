<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\StoryModel;
use App\ProfileModel;
use App\TagModel;
use App\FollowModel;
use App\BookmarkModel;

class MainController extends Controller
{
    function index()
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        $profile = FollowModel::GetAllFollowing($id);
        $timelinesStory = StoryModel::TimelinesStory(7, $profile, Auth::id());
        $newStory = StoryModel::AllStory(7, 0);
        $featuredStory = StoryModel::AllStory(25, 0);
        $popularStory = StoryModel::PopularStory(5, 0);
        $trendingStory = StoryModel::MostViewsStory(7, 0);
        $topTags = TagModel::TopTags();
        return view('home.index', [
            'title' => 'Official Site',
            'path' => 'home',
            'timelinesStory' => $timelinesStory,
            'newStory' => $newStory,
            'featuredStory' => $featuredStory,
            'popularStory' => $popularStory,
            'trendingStory' => $trendingStory,
            'topTags' => $topTags
        ]);
    }
    function collections()
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagAllStory(10);
        $topTags = TagModel::TopTags();
        $allTags = TagModel::AllTags();
        $topUsers = ProfileModel::TopUsers($id, 7);
    	return view('collections.index', [
            'title' => 'Collections',
            'path' => 'collections',
            'topStory' => $topStory,
            'topTags' => $topTags,
            'allTags' => $allTags,
            'topUsers' => $topUsers
        ]);
    }
    function collectionsId($ctr)
    {
    	return view('others.index', ['title' => 'Collections', 'path' => 'collections']);
    }
    function tagsId($ctr)
    {
        $topStory = StoryModel::PagTagStory($ctr, 12);
        return view('others.index', [
            'title' => $ctr,
            'path' => 'none',
            'topStory' => $topStory
        ]);
    }
    function timelines()
    {
        $id = Auth::id();
        $profile = FollowModel::GetAllFollowing($id);
        $topStory = StoryModel::PagTimelinesStory(10, $profile, Auth::id());
        return view('others.index', [
            'title' => 'Timelines',
            'path' => 'timelines',
            'topStory' => $topStory
        ]);
    }
    function popular()
    {
        $topStory = StoryModel::PagPopularStory(10);
    	return view('others.index', [
            'title' => 'Popular',
            'path' => 'popular',
            'topStory' => $topStory
        ]);
    }
    function compose()
    {
        return view('compose.index', ['title' => 'New Story', 'path' => 'compose']);
    }
    function fresh()
    {
        $topStory = StoryModel::PagAllStory(10);
        return view('others.index', [
            'title' => 'Fresh',
            'path' => 'fresh',
            'topStory' => $topStory
        ]);
    }
    function trending()
    {
        $topStory = StoryModel::PagTrendingStory(10);
        return view('others.index', [
            'title' => 'Trending',
            'path' => 'trending',
            'topStory' => $topStory
        ]);
    }
    function search($ctr)
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagSearchStory($ctr, 10);
        $topUsers = ProfileModel::SearchUsers($ctr, $id);
        $topTags = TagModel::SearchTags($ctr);
        return view('search.index', [
            'title' => $ctr,
            'path' => 'home-search',
            'topStory' => $topStory,
            'topUsers' => $topUsers,
            'topTags' => $topTags
        ]);
    }
    function login()
    {
        return view('sign.in', ['title' => 'Login', 'path' => 'none']);
    }
    function signup()
    {
        return view('sign.up', ['title' => 'Signup', 'path' => 'none']);
    }
}
