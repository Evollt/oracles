<?php

namespace App\Http\Controllers\Bot;

use App\Models\Bot\Scam;
use Illuminate\View\View;
use App\Models\Bot\Webhook;
use Illuminate\Http\Request;
use App\Models\Bot\Subscriber;
use App\Models\Bot\ScamCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Bot\ScamRequest;
use App\Repositories\Bot\ScamRepository;
use App\Http\DataTables\Bot\ScamDatatable;
use App\Models\Bot\ScamStatus;

class ScamController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $this->middleware('scam.index');
        return view('pages.scam.index');
    }

    /**
     * @return JsonResponse
     */
    public function datatable(ScamDatatable $scamDatatable) :JsonResponse
    {
        $this->middleware('scam.index');
        return $scamDatatable->ajax();
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $this->middleware('scam.create');

        $scamCategories = ScamCategory::get()->pluck('name', 'id');

        return view('pages.scam.create', compact('scamCategories'));
    }

    /**
     * @return RedirectResponse
     */
    public function store(ScamRequest $request): RedirectResponse
    {
        $this->middleware('scam.create');

        $scam = DB::transaction(function () use ($request) {
            /** @var ScamRepository */
            $scamRepository = app()->make(ScamRepository::class);
            return $scamRepository->store($request->request->all());
        });

        session()->flash('success', 'Successfully created scam: ' . $scam->old_title);

        return redirect()->route('scam.index');
    }

    /**
     * @param Scam $scam
     * @return View
     */
    public function edit(Scam $scam): View
    {
        $this->middleware('scam.edit');

        $scamCategories = ScamCategory::get()->pluck('name', 'id');

        return view('pages.scam.edit', compact('scam', 'scamCategories'));
    }

    /**
     * @param Scam $scam
     * @return RedirectResponse
     */
    public function update(ScamRequest $request, Scam $scam): RedirectResponse
    {
        $this->middleware('scam.edit');

        $scam = DB::transaction(function () use ($request, $scam) {
            /** @var ScamRepository */
            $scamRepository = app()->make(ScamRepository::class);
            return $scamRepository->update($scam, $request->request->all());
        });


        session()->flash('success', 'Successfully updated scam: ' . $scam->old_title);

        return redirect()->route('scam.index');
    }

    /**
     * @param Scam $scam
     * @return View
     */
    public function delete(Scam $scam): View
    {
        $this->middleware('scam.delete');
        return view('pages.scam.modal.delete', compact('scam'));
    }

    /**
     * @param Scam $scam
     * @return JsonResponse
     */
    public function destroy(Scam $scam): JsonResponse
    {
        $this->middleware('scam.delete');

        DB::transaction(function () use ($scam) {
            /** @var ScamRepository */
            $scamRepository = app()->make(ScamRepository::class);
            $scamRepository->destroy($scam);
        });

        session()->flash('success', 'Deleted scam successfully');

        return response()->json([
            'actions' => [
                [
                    'name' => 'reloadPage',
                ],
            ],
        ]);
    }

    /**
     * @param Scam $scam
     * @return View
     */
    public function status(Scam $scam): View
    {
        $this->middleware('scam.status');

        $scamStatuses = ScamStatus::get()->pluck('name', 'id');

        return view('pages.scam.modal.status', compact('scam', 'scamStatuses'));
    }

    /**
     * @param Scam $scam
     * @return JsonResponse
     */
    public function statusUpdate(Request $request, Scam $scam): JsonResponse
    {
        $this->middleware('scam.status');

        DB::transaction(function () use ($scam, $request) {
            /** @var ScamRepository */
            $scamRepository = app()->make(ScamRepository::class);
            $scamRepository->update($scam, $request->request->all());
        });

        session()->flash('success', 'Updated scam status successfully');

        return response()->json([
            'actions' => [
                [
                    'name' => 'reloadPage',
                ],
            ],
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function discordPost(Request $request, Scam $scam): RedirectResponse
    {
        $this->middleware('scam.post');

        if(null === $scam->post_title && null === $scam->post_text){
            session()->flash('error', 'Not ready to submit a message yet');
            return redirect()->route('scam.edit', $scam);
        }

        $webhooks = Webhook::get();
        $subscribers = Subscriber::where(['receive_message' => true])->get();

        $embed = [
            'title' => $scam->post_title,
            'description' => $scam->post_text,
            'color' => '7506394',
        ];

        if(null !== $scam->post_image){
            $embed['image'] = ['url' => $scam->post_image];
        }

        foreach($webhooks as $webhook){
            Http::post($webhook->url, [
                'embeds' => [
                    $embed,
                ],
            ]);
        }

        foreach($subscribers as $subscriber){
            $newDM = $this->makeRequest('/users/@me/channels', array("recipient_id" => $subscriber->user->id));
            if(isset($newDM["id"])) {
                $newMessage = $this->makeRequest("/channels/".$newDM["id"]."/messages", [
                    'embeds' =>
                    [
                        [
                            'title' => $scam->post_title,
                            'description' => $scam->post_text,
                            'color' => '7506394',
                        ]
                    ],
                ]);
            }
        }

        $scamStatus = ScamStatus::where(['slug' => 'posted'])->get()->first();
        $scam->scam_status_id = $scamStatus->id;
        $scam->save();

        session()->flash('success', 'Successfully posted scam in discords');

        return redirect()->route('scam.index');
    }

    public function makeRequest($endpoint, $data) {
        # Set endpoint
        $url = "https://discord.com/api/".$endpoint."";

        # Encode data, as Discord requires you to send json data.
        $data = json_encode($data);

        # Initialize new curl request
        $ch = curl_init();
        $f = fopen('request.txt', 'w');

        # Set headers, data etc..
        curl_setopt_array($ch, array(
            CURLOPT_URL            => $url,
            CURLOPT_HTTPHEADER     => array(
                'Authorization: Bot ' . env('DISCORD_BOT_TOKEN'),
                "Content-Type: application/json",
                "Accept: application/json"
            ),
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_VERBOSE        => 1,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_STDERR         => $f,
        ));

        $request = curl_exec($ch);
        curl_close($ch);
        return json_decode($request, true);
    }
}
