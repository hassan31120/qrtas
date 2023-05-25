<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NotiController extends Controller
{
    public function push(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            // 'gender' => 'required'
        ]);

        $noti = $request->all();

        // if (isset($noti['from'], $noti['to'])) {
        //     $from = $noti['from'];
        //     $to = $noti['to'];
        // }

        // if ($noti['gender'] == 1) {
        //     $users = User::all();
        // } elseif ($noti['gender'] == 2) {
        //     if (isset($from, $to)) {
        //         $users = User::where('gender', 'male')->whereBetween('real_age', [$from, $to])->get();
        //     } else {
        //         $users = User::where('gender', 'male')->get();
        //     }
        // } elseif ($noti['gender'] == 3) {
        //     if (isset($from, $to)) {
        //         $users = User::where('gender', 'female')->whereBetween('real_age', [$from, $to])->get();
        //     } else {
        //         $users = User::where('gender', 'female')->get();
        //     }
        // } else {
        //     $users = User::all();
        // }

        $users = User::all();

        if ($request->hasFile('noti_image')) {
            $file = $request->file('noti_image');
            $filepath = 'storage/images/noti/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $noti['noti_image'] = $filename;
            foreach ($users as $user) {
                $user->noti_image = $filename;
                $user->save();
            }
        }

        $SERVER_API_KEY = 'AAAAYbxWuYk:APA91bGBUZvOaCjr86UMG5aNkNCDaJ6CdVeBzHc6Ylv1OZoVK8q3Sj1ZYpinpBcUhR2C9msHK-wqykBd2hhAdDhJhqwQdnoO1wYoe7pZNPP7lKHeoNGKK9i9nffA9XbptskVlAK5Wt9O';

        $token = [];
        foreach ($users as $user) {
            // $token_1 = $user->push_token;
            array_push($token, $user->push_token);
        }

        if (isset($noti['noti_image'])) {
            $noti['noti_image'] = $noti['noti_image'];
        } else {
            $noti['noti_image'] = "";
        }

        $data = [

            "registration_ids" =>
            $token,

            "notification" => [

                "title" => $noti['title'],

                "body" => $noti['body'],

                "sound" => "default", // required for sound on ios

                "image" => asset($noti['noti_image'])

            ],

            "data" => [

                "click_action" => "FLUTTER_NOTIFICATION_CLICK"

            ],

        ];


        $dataString = json_encode($data);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);


        $response = curl_exec($ch);

        return response()->json(['success' => true, 'msg' => 'notification has been sent successfully'], 200);
    }
}
