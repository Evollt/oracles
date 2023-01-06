<?php

namespace App\Http\Controllers\Setting;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Setting\Color;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Setting\ColorRequest;
use App\Repositories\Setting\ColorRepository;
use App\Http\DataTables\Setting\ColorDataTable;

class ColorController extends Controller
{
    public function index(): View
    {
        $this->middleware('color.index');
        return view('pages.color.index');
    }

        /**
     * @return JsonResponse
     */
    public function datatable(ColorDataTable $colorDatatable) :JsonResponse
    {
        $this->middleware('color.index');
        return $colorDatatable->ajax();
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $this->middleware('color.create');

        return view('pages.color.create');
    }

    /**
     * @return RedirectResponse
     */
    public function store(ColorRequest $request): RedirectResponse
    {
        $this->middleware('color.create');

        $color = DB::transaction(function () use ($request) {
            /** @var ColorRepository */
            $colorRepository = app()->make(ColorRepository::class);
            return $colorRepository->store($request->request->all());
        });

        session()->flash('success', 'Successfully created color: ' . $color->name);

        return redirect()->route('color.index');
    }

    /**
     * @param Color $color
     * @return View
     */
    public function edit(Color $color): View
    {
        $this->middleware('color.edit');

        return view('pages.color.edit', compact('color'));
    }

    /**
     * @param Color $color
     * @return RedirectResponse
     */
    public function update(ColorRequest $request, Color $color): RedirectResponse
    {
        $this->middleware('color.edit');

        $color = DB::transaction(function () use ($request, $color) {
            /** @var ColorRepository */
            $colorRepository = app()->make(ColorRepository::class);
            return $colorRepository->update($color, $request->request->all());
        });


        session()->flash('success', 'Successfully updated color: ' . $color->name);

        return redirect()->route('color.index');
    }

    /**
     * @param Color $color
     * @return View
     */
    public function delete(Color $color): View
    {
        $this->middleware('color.delete');
        return view('pages.color.modal.delete', compact('color'));
    }

    /**
     * @param Color $color
     * @return JsonResponse
     */
    public function destroy(Color $color): JsonResponse
    {
        $this->middleware('color.delete');

        DB::transaction(function () use ($color) {
            /** @var ColorRepository */
            $colorRepository = app()->make(ColorRepository::class);
            $colorRepository->destroy($color);
        });

        session()->flash('success', 'Deleted color successfully');

        return response()->json([
            'actions' => [
                [
                    'name' => 'reloadPage',
                ],
            ],
        ]);
    }
}
