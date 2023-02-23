<?php

namespace App\Http\Controllers\Api;

use App\Helpers\General;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class EmailTesterController extends Controller
{
    public function testEmail()
    {
        General::setMailConfig();
        $parseValues = ['USERNAME' => 'Rajan', "PASSWORD" => '125488963'];
        $template_header = DB::table('email_template')->where('template_code', 'template_header')->value('body');
        $template_footer = DB::table('email_template')->where('template_code', 'template_footer')->value('body');

        $email = DB::table('email_template')->where('template_code', 'user_registration')->first();
        $templateContent = $email->body;
        if (!empty($parseValues)) {
            foreach ($parseValues as $name => $value) {
                $parseName = $name;
                $parseValue = $value;
                $templateContent = str_replace("[$parseName]", $parseValue, $templateContent);
            }

            $html = $template_header . $templateContent . $template_footer;

            \Mail::send([], [], function ($message) use ($html) {
                $message->to('rajan.acharya08@gmail.com')
                    ->subject('Test Email')
                    ->setBody($html, 'text/html');
            });

            echo ('Mail sent');
        }
    }

    public function test()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://apilayer.net/api/live?access_key=d82ff69c899c3750b025612cdf4e919d& currencies=NPR&source=USD&format=1');
        $response = $request->getBody()->getContents();
        $data = json_decode($response);

        dd($data, $data->success, $data->quotes, $data->quotes->USDNPR);
    }


    public function removeImage()
    {
        $images = DB::table('product')->select(DB::raw("DISTINCT(image)"))->where('is_publish', 'N')->whereNotNull('image')->get();
        // $file = public_path("uploads/product_image/$images->image");
        // dd($images,file_exists($file));
        $remaining_images = array();
        if (!empty($images)) {
            foreach ($images as $key => $image) {
                if (file_exists(public_path("uploads/product_image/$image->image"))) {
                    unlink(public_path("uploads/product_image/$image->image"));
                    if (file_exists(public_path("uploads/product_image/thumbnail/$image->image"))) {
                        unlink(public_path("uploads/product_image/thumbnail/$image->image"));
                    }
                } else {
                    $remaining_images[] = $image->image;
                }
            }
        }
        dd("Could Not Remove:", $remaining_images);
    }

    // public function renameFile()
    // {
    //     $directory = url("/uploads/carpet-bg");
    //     if ($handle = opendir($directory)) { 
    //         while (false !== ($fileName = readdir($handle))) {
    //             $dd = explode('.', $fileName);
    //             $full_name = explode('-',$dd[0]);
    //             $fname= $full_name[0];
    //             $newfile = $fname.'.'.$dd[1];
    //             rename($directory . $fileName, $directory.$newfile);
    //         }
    //         closedir($handle);
    //     }

    // }

}