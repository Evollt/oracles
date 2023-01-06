<?php

namespace App\Http\Controllers\Bot;

use Illuminate\View\View;
use App\Models\Setting\Color;
use App\Models\Bot\ScamStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Bot\ScamStatusRequest;
use App\Repositories\Bot\ScamStatusRepository;
use App\Http\DataTables\Bot\ScamStatusDatatable;

class ScamStatusController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $this->middleware('scam-status.index');
        return view('pages.scam-status.index');
    }

    /**
     * @return JsonResponse
     */
    public function datatable(ScamStatusDatatable $scamDatatable) :JsonResponse
    {
        $this->middleware('scam-status.index');
        return $scamDatatable->ajax();
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $this->middleware('scam-status.create');

        $colors = Color::get()->pluck('name', 'id');

        return view('pages.scam-status.create', compact('colors'));
    }

    /**
     * @return RedirectResponse
     */
    public function store(ScamStatusRequest $request): RedirectResponse
    {
        $this->middleware('scam-status.create');

        $scamStatus = DB::transaction(function () use ($request) {
            /** @var ScamStatusRepository */
            $scamStatusRepository = app()->make(ScamStatusRepository::class);
            return $scamStatusRepository->store($request->request->all());
        });

        session()->flash('success', 'Successfully created scam status: ' . $scamStatus->name);

        return redirect()->route('scam-status.index');
    }

    /**
     * @param ScamStatus $scamStatus
     * @return View
     */
    public function edit(ScamStatus $scamStatus): View
    {
        $this->middleware('scam-status.edit');

        $colors = Color::get()->pluck('name', 'id');

        return view('pages.scam-status.edit', compact('scamStatus', 'colors'));
    }

    /**
     * @param ScamStatus $scamStatus
     * @return RedirectResponse
     */
    public function update(ScamStatusRequest $request, ScamStatus $scamStatus): RedirectResponse
    {
        $this->middleware('scam-status.edit');

        $scamStatus = DB::transaction(function () use ($request, $scamStatus) {
            /** @var ScamStatusRepository */
            $scamStatusRepository = app()->make(ScamStatusRepository::class);
            return $scamStatusRepository->update($scamStatus, $request->request->all());
        });


        session()->flash('success', 'Successfully updated scam status: ' . $scamStatus->name);

        return redirect()->route('scam-status.index');
    }

    /**
     * @param ScamStatus $scamStatus
     * @return View
     */
    public function delete(ScamStatus $scamStatus): View
    {
        $this->middleware('scam-status.delete');
        return view('pages.scam-status.modal.delete', compact('scamStatus'));
    }

    /**
     * @param ScamStatus $scamStatus
     * @return JsonResponse
     */
    public function destroy(ScamStatus $scamStatus): JsonResponse
    {
        $this->middleware('scam-status.delete');

        DB::transaction(function () use ($scamStatus) {
            /** @var ScamStatusRepository */
            $scamStatusRepository = app()->make(ScamStatusRepository::class);
            $scamStatusRepository->destroy($scamStatus);
        });

        session()->flash('success', 'Deleted scam status successfully');

        return response()->json([
            'actions' => [
                [
                    'name' => 'reloadPage',
                ],
            ],
        ]);
    }
}
