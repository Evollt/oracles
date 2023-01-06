<?php

namespace App\Http\Controllers\Bot;

use App\Models\User\User;
use Illuminate\View\View;
use App\Models\Bot\Subscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Bot\SubscriberRequest;
use App\Repositories\Bot\SubscriberRepository;
use App\Http\DataTables\Bot\SubscriberDatatable;

class SubscriberController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $this->middleware('subscriber.index');
        return view('pages.subscriber.index');
    }

    /**
     * @return JsonResponse
     */
    public function datatable(SubscriberDatatable $scamDatatable) :JsonResponse
    {
        $this->middleware('subscriber.index');
        return $scamDatatable->ajax();
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $this->middleware('subscriber.create');

        $users = User::get()->pluck('discord', 'id');

        return view('pages.subscriber.create', compact('users'));
    }

    /**
     * @return RedirectResponse
     */
    public function store(SubscriberRequest $request): RedirectResponse
    {
        $this->middleware('subscriber.create');

        $subscriber = DB::transaction(function () use ($request) {
            /** @var SubscriberRepository */
            $subscriberRepository = app()->make(SubscriberRepository::class);
            return $subscriberRepository->store($request->request->all());
        });

        session()->flash('success', 'Successfully created subscriber: ' . $subscriber->user->name);

        return redirect()->route('subscriber.index');
    }

    /**
     * @param Subscriber $subscriber
     * @return View
     */
    public function edit(Subscriber $subscriber): View
    {
        $this->middleware('subscriber.edit');

        $users = User::get()->pluck('discord', 'id');

        return view('pages.subscriber.edit', compact('subscriber', 'users'));
    }

    /**
     * @param Subscriber $subscriber
     * @return RedirectResponse
     */
    public function update(SubscriberRequest $request, Subscriber $subscriber): RedirectResponse
    {
        $this->middleware('subscriber.edit');

        $subscriber = DB::transaction(function () use ($request, $subscriber) {
            /** @var SubscriberRepository */
            $subscriberRepository = app()->make(SubscriberRepository::class);
            return $subscriberRepository->update($subscriber, $request->request->all());
        });


        session()->flash('success', 'Successfully updated subscriber: ' . $subscriber->user->name);

        return redirect()->route('subscriber.index');
    }

    /**
     * @param Subscriber $subscriber
     * @return View
     */
    public function delete(Subscriber $subscriber): View
    {
        $this->middleware('subscriber.delete');
        return view('pages.subscriber.modal.delete', compact('subscriber'));
    }

    /**
     * @param Subscriber $subscriber
     * @return JsonResponse
     */
    public function destroy(Subscriber $subscriber): JsonResponse
    {
        $this->middleware('subscriber.delete');

        DB::transaction(function () use ($subscriber) {
            /** @var SubscriberRepository */
            $subscriberRepository = app()->make(SubscriberRepository::class);
            $subscriberRepository->destroy($subscriber);
        });

        session()->flash('success', 'Deleted subscriber successfully');

        return response()->json([
            'actions' => [
                [
                    'name' => 'reloadPage',
                ],
            ],
        ]);
    }
}
