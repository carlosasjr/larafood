<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    /**
     * @var Plan
     */
    private $repository;

    public function __construct(Plan $plan)
    {

        $this->repository = $plan;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $plans = $this->repository->paginate(15);

        return view('admin.pages.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.pages.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdatePlanRequest $request
     * @return Response
     */
    public function store(StoreUpdatePlanRequest $request)
    {
        $dataForm = $request->all();
        $dataForm['url'] = Str::kebab($dataForm['name']);

        $this->repository->create($dataForm);

        return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param String $url
     * @return Response
     */
    public function show(String $url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
             return redirect()->back();

        return view('admin.pages.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param String $url
     * @return void
     */
    public function edit(String $url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        return view('admin.pages.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdatePlanRequest $request
     * @param String $url
     * @return void
     */
    public function update(StoreUpdatePlanRequest $request, String $url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        $plan->update($request->all());

        return redirect()->route('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param String $url
     * @return Response
     */
    public function destroy(String $url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        $plan->delete();

        return redirect()->route('plans.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index', compact('plans', 'filters'));
    }
}
