<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\About;
use App\Enums\PageStatusEnum;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::where('status', PageStatusEnum::PUBLISHED)->firstOrFail();
        $teamMembers = TeamMember::active()->ordered()->get();
        
        return view('about.index', compact('about', 'teamMembers'));
    }
}
