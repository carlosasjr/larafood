<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfilesController extends Controller
{

    /**
     * @var Plan
     */
    private $plan;
    /**
     * @var Profile
     */
    private $profile;

    public function __construct(Plan $plan, Profile $profile)
    {

        $this->plan = $plan;
        $this->profile = $profile;
    }

    /**
     * Display a listing of the resource.
     *
     * @param String $url
     * @return void
     */
    public function index(String $url)
    {
        if (!$plan = $this->plan->where('url', $url)->first()) {
            return redirect()->back();
        }

        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.index', compact('plan', 'profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $url)
    {
        if (!$plan = $this->plan->where('url', $url)->first()) {
            return redirect()->back();
        }


        $profiles = $plan->profilesAvailable();


        return view('admin.pages.plans.profiles.create', compact('plan', 'profiles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param String $url
     * @return void
     */
    public function store(Request $request, String $url)
    {
        if (!$plan = $this->plan->where('url', $url)->first()) {
            return redirect()->back();
        }


        if (!$request->profiles || count($request->profiles) == 0) {
            return redirect()->back()
                ->with('info', 'Selecione ao menos um perfil');
        }

        $plan->profiles()->attach($request->profiles);

        return redirect()->route('plans.profiles.index', $url);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param String $url
     * @param int $profileId
     * @return void
     */
    public function destroy(String $url, int $profileId)
    {
        $plan = $this->plan->where('url', $url)->first();
        $profile = $this->profile->find($profileId);


        if (!$plan || !$profile) {
            return redirect()->back();
        }

        $plan->profiles()->detach($profile);


        return redirect()->back();
    }

    public function createSearch(Request $request, string $url)
    {
        if (!$plan = $this->plan->where('url', $url)->first()) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $profiles = $plan->profilesAvailable($request->filter);

        return view('admin.pages.plans.profiles.create', compact('plan', 'profiles', 'filters'));
    }
}
