<?php

namespace App\Http\Controllers\Api;

use App\Models\User\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\User\Security;
use Illuminate\Http\Response;
use App\Models\Bot\Subscriber;
use App\Models\User\Notification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubcriberRequest;
use App\Models\Bot\Scam;
use App\Models\Bot\ScamCategory;
use App\Models\Bot\ScamStatus;
use App\Repositories\Bot\ScamCategoryRepository;
use App\Repositories\Bot\ScamRepository;
use App\Repositories\Bot\SubscriberRepository;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * @return JsonResponse
     * @OA\Get(
     *      path="/all-scams",
     *      operationId="scam",
     *      tags={"Oracle Discord Bot"},
     *      summary="Get all scams",
     *      description="Get all the scams that are posted by the Oracle team",
     *      security={{ "Bearer":{} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     * )
     */
    public function allScams(): JsonResponse
    {
        $scamStatus = ScamStatus::where(['slug' => 'posted'])->first();
        $scams = Scam::where(['scam_status_id' => $scamStatus->id])->get();

        $array = [];
        foreach($scams as $scam){
            $array[] = [
                'title' => $scam->post_title,
                'text' => $scam->post_text,
                'scam_status' => $scam->scamStatus->name,
                'scam_status' => $scam->scamCategory->name,
            ];
        }

        return new JsonResponse($array);
    }

    /**
     * @param Request $request
     * @return Response
     * @OA\Post(
     *      path="/scam-post",
     *      operationId="scamPost",
     *      tags={"Oracle Discord Bot"},
     *      summary="Submit a scam",
     *      description="Submit a potential scam for the team to check",
     *      security={{ "Bearer":{} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ScamPost")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function scamPost(Request $request): Response
    {
        $data = json_decode($request->getContent());

        if(null === $data || !property_exists($data, 'title') || !property_exists($data, 'text') || !property_exists($data, 'category') || !property_exists($data, 'images')){
            return response('No correct data provided', 400)->header('Content-Type', 'text/plain');
        }

        $scamCategory = ScamCategory::where(['slug' => $data->category])->get()->first();
        if(!$scamCategory instanceof ScamCategory){
            return response('This scam category doesnt exist', 400)->header('Content-Type', 'text/plain');
        }

        $dataArray = [
            'old_title' => $data->title,
            'old_text' => $data->text,
            'images' => $data->images,
            'scam_status_id' => $scamCategory->id,
        ];

        //transact data
        DB::transaction(function () use ($dataArray) {
            /** @var ScamRepository */
            $scamRepository = app()->make(ScamRepository::class);
            $scamRepository->store($dataArray);
        });

        return response('Submitted potential scam successfully', 201);
    }

    /**
     * @param Request $request
     * @return Response
     * @OA\Post(
     *      path="/subscribe",
     *      operationId="subscribe",
     *      tags={"Oracle Discord Bot"},
     *      summary="Subscribe discord user",
     *      description="Subscribes discord user to receive scam posts in DM",
     *      security={{ "Bearer":{} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Subscribe")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function subscribe(Request $request): Response
    {
        $data = json_decode($request->getContent());

        if(null === $data || !property_exists($data, 'discord_id') || !property_exists($data, 'name') || !property_exists($data, 'discriminator') || !property_exists($data, 'subscribe')){
            return response('No correct data provided', 400)
                ->header('Content-Type', 'text/plain');
        }

        $user = User::where(['id' => $data->discord_id])->get()->first();
        if(!$user instanceof User){
            //transact data
            $user = DB::transaction(function () use ($data) {
                $security = new Security();
                $notification = new Notification();
                $security->save();
                $notification->save();
                $user = User::create([
                    'id' => $data->discord_id,
                    'username' => $data->name,
                    'discriminator' => $data->discriminator,
                    'security_id' => $security->id,
                    'notification_id' => $notification->id,
                ]);
                $user->save();
                return $user;
            });
        }

        $subscribe = Subscriber::where(['user_id' => $user->id])->get()->first();
        $dataArray = [
            'user_id' => $user->id,
            'receive_message' => true === $data->subscribe ? 'on' : 'off',
        ];

        //error messages
        if(!empty($errors)){
            $message = implode(', ', $errors);

            return response($message, 400)
                ->header('Content-Type', 'text/plain');
        }

        //transact data
        // DB::transaction(function () use ($dataArray, $subscribe) {
            /** @var SubscriberRepository */
            $subsciberRepository = app()->make(SubscriberRepository::class);
            if(!$subscribe instanceof Subscriber){
                $subsciberRepository->store($dataArray);
            }else{
                $subsciberRepository->update($subscribe, $dataArray);
            }
        // });

        return response((true === $data->subscribe ? 'Subscribed' : 'Unsubscribed') . ' successfully', 201);
    }
}
