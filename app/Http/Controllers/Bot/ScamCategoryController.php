<?php

namespace App\Http\Controllers\Bot;

use Illuminate\View\View;
use App\Models\Setting\Color;
use App\Models\Bot\ScamCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Bot\ScamCategoryRequest;
use App\Repositories\Bot\ScamCategoryRepository;
use App\Http\DataTables\Bot\ScamCategoryDatatable;

class ScamCategoryController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $this->middleware('scam-category.index');
        return view('pages.scam-category.index');
    }

    /**
     * @return JsonResponse
     */
    public function datatable(ScamCategoryDatatable $scamDatatable) :JsonResponse
    {
        $this->middleware('scam-category.index');
        return $scamDatatable->ajax();
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $this->middleware('scam-category.create');

        $colors = Color::get()->pluck('name', 'id');

        return view('pages.scam-category.create', compact('colors'));
    }

    /**
     * @return RedirectResponse
     */
    public function store(ScamCategoryRequest $request): RedirectResponse
    {
        $this->middleware('scam-category.create');

        $scamCategory = DB::transaction(function () use ($request) {
            /** @var ScamCategoryRepository */
            $scamCategoryRepository = app()->make(ScamCategoryRepository::class);
            return $scamCategoryRepository->store($request->request->all());
        });

        session()->flash('success', 'Successfully created scam category: ' . $scamCategory->name);

        return redirect()->route('scam-category.index');
    }

    /**
     * @param ScamCategory $scamCategory
     * @return View
     */
    public function edit(ScamCategory $scamCategory): View
    {
        $this->middleware('scam-category.edit');

        $colors = Color::get()->pluck('name', 'id');

        return view('pages.scam-category.edit', compact('scamCategory', 'colors'));
    }

    /**
     * @param ScamCategory $scamCategory
     * @return RedirectResponse
     */
    public function update(ScamCategoryRequest $request, ScamCategory $scamCategory): RedirectResponse
    {
        $this->middleware('scam-category.edit');

        $scamCategory = DB::transaction(function () use ($request, $scamCategory) {
            /** @var ScamCategoryRepository */
            $scamCategoryRepository = app()->make(ScamCategoryRepository::class);
            return $scamCategoryRepository->update($scamCategory, $request->request->all());
        });


        session()->flash('success', 'Successfully updated scam category: ' . $scamCategory->name);

        return redirect()->route('scam-category.index');
    }

    /**
     * @param ScamCategory $scamCategory
     * @return View
     */
    public function delete(ScamCategory $scamCategory): View
    {
        $this->middleware('scam-category.delete');
        return view('pages.scam-category.modal.delete', compact('scamCategory'));
    }

    /**
     * @param ScamCategory $scamCategory
     * @return JsonResponse
     */
    public function destroy(ScamCategory $scamCategory): JsonResponse
    {
        $this->middleware('scam-category.delete');

        DB::transaction(function () use ($scamCategory) {
            /** @var ScamCategoryRepository */
            $scamCategoryRepository = app()->make(ScamCategoryRepository::class);
            $scamCategoryRepository->destroy($scamCategory);
        });

        session()->flash('success', 'Deleted scam category successfully');

        return response()->json([
            'actions' => [
                [
                    'name' => 'reloadPage',
                ],
            ],
        ]);
    }
}
