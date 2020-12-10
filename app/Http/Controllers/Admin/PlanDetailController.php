<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanDetailRequest;
use App\Models\Plan;
use App\Models\PlanDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlanDetailController extends Controller
{

    /**
     * @var PlanDetail
     */
    private $repository;
    /**
     * @var Plan
     */
    private $plan;

    public function __construct(PlanDetail $planDetail, Plan $plan)
    {

        $this->repository = $planDetail;
        $this->plan = $plan;
    }

    /**
     * Display a listing of the resource.
     *
     * @param String $url
     * @return void
     */
    public function index(String $url)
    {
         if (!$plan = $this->plan->where('url', $url)->first()){
            return redirect()->back();
        }

           $details = $plan->details()->paginate();

        return view('admin.pages.plans.details.index', compact('plan', 'details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param String $url
     * @return void
     */
    public function create(String $url)
    {
        if (!$plan = $this->plan->where('url', $url)->first()){
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create', compact('plan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdatePlanDetailRequest $request
     * @param String $url
     * @return Response
     */
    public function store(StoreUpdatePlanDetailRequest $request, String $url)
    {
        if (!$plan = $this->plan->where('url', $url)->first()){
            return redirect()->back();
        }

        $plan->details()->create($request->all());

        return redirect()->route('plans.details.index', $plan->url);
    }

    /**
     * Display the specified resource.
     *
     * @param String $url
     * @param int $id
     * @return void
     */
    public function show(String $url, int $id)
    {
        $plan = $this->plan->where('url', $url)->first();
        $detail = $this->repository->find($id);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.show', compact('plan', 'detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $url
     * @param int $id
     * @return void
     */
    public function edit(String $url, int $id)
    {
        $plan = $this->plan->where('url', $url)->first();
        $detail = $this->repository->find($id);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit', compact('plan', 'detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdatePlanDetailRequest $request
     * @param String $url
     * @param int $id
     * @return void
     */
    public function update(StoreUpdatePlanDetailRequest $request, String $url, int $id)
    {
        $plan = $this->plan->where('url', $url)->first();
        $detail = $this->repository->find($id);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->update($request->all());

        return redirect()->route('plans.details.index', $plan->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param String $url
     * @param int $id
     * @return void
     */
    public function destroy(String $url, int $id)
    {
        $plan = $this->plan->where('url', $url)->first();
        $detail = $this->repository->find($id);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->delete();

        return redirect()
            ->route('plans.details.index', $plan->url)
            ->with('success', 'Registro deletado com sucesso!');
    }
}
