<?php

namespace App\Http\Controllers\Bot;

use Illuminate\View\View;
use App\Models\Bot\Webhook;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Bot\WebhookRequest;
use App\Repositories\Bot\WebhookRepository;
use App\Http\DataTables\Bot\WebhookDatatable;

class WebhookController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $this->middleware('webhook.index');
        return view('pages.webhook.index');
    }

    /**
     * @return JsonResponse
     */
    public function datatable(WebhookDatatable $scamDatatable) :JsonResponse
    {
        $this->middleware('webhook.index');
        return $scamDatatable->ajax();
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $this->middleware('webhook.create');

        return view('pages.webhook.create');
    }

    /**
     * @return RedirectResponse
     */
    public function store(WebhookRequest $request): RedirectResponse
    {
        $this->middleware('webhook.create');

        $webhook = DB::transaction(function () use ($request) {
            /** @var WebhookRepository */
            $webhookRepository = app()->make(WebhookRepository::class);
            return $webhookRepository->store($request->request->all());
        });

        session()->flash('success', 'Successfully created webhook: ' . $webhook->name);

        return redirect()->route('webhook.index');
    }

    /**
     * @param Webhook $webhook
     * @return View
     */
    public function edit(Webhook $webhook): View
    {
        $this->middleware('webhook.edit');

        return view('pages.webhook.edit', compact('webhook'));
    }

    /**
     * @param Webhook $webhook
     * @return RedirectResponse
     */
    public function update(WebhookRequest $request, Webhook $webhook): RedirectResponse
    {
        $this->middleware('webhook.edit');

        $webhook = DB::transaction(function () use ($request, $webhook) {
            /** @var WebhookRepository */
            $webhookRepository = app()->make(WebhookRepository::class);
            return $webhookRepository->update($webhook, $request->request->all());
        });


        session()->flash('success', 'Successfully updated webhook: ' . $webhook->name);

        return redirect()->route('webhook.index');
    }

    /**
     * @param Webhook $webhook
     * @return View
     */
    public function delete(Webhook $webhook): View
    {
        $this->middleware('webhook.delete');
        return view('pages.webhook.modal.delete', compact('webhook'));
    }

    /**
     * @param Webhook $webhook
     * @return JsonResponse
     */
    public function destroy(Webhook $webhook): JsonResponse
    {
        $this->middleware('webhook.delete');

        DB::transaction(function () use ($webhook) {
            /** @var WebhookRepository */
            $webhookRepository = app()->make(WebhookRepository::class);
            $webhookRepository->destroy($webhook);
        });

        session()->flash('success', 'Deleted webhook successfully');

        return response()->json([
            'actions' => [
                [
                    'name' => 'reloadPage',
                ],
            ],
        ]);
    }
}
