<?php
namespace Phppot;

use Phppot\Config;
require FCPATH.'/vendor/autoload.php';
use Vimeo\Vimeo;
use Vimeo\Exceptions\VimeoUploadException;

class VideoService
{

    private $videoURL = "";

    private $vimeoClient;

    function __construct($url)
    {
        $this->videoURL = $url;
        //$this->vimeoClient = new Vimeo(Config::CLIENT_ID, Config::CLIENT_SECRET, Config::ACCESS_TOKEN);
        $this->vimeoClient = new Vimeo("6fcf4423afd5ed4e8bb3a24cecba4f4994f54f16", "8s4ZU+FkIitVWMk8ZZoVGCs6yzzV+c98gzWk2Bf5nlQiL4kWH68DbgCrNmKlN7ansc5wDsR54mYBN22/H3DJKs6IBI+mqrUYwDL4L+WDhfb7dKRntXoJp5u4ngkXFRV0", "62442fc761e43f2691ee43e043ad644f");
    }

    function validateVideo()
    {
        $valid = false;
        if (! empty($this->videoURL)) {
            $file_extension = pathinfo($_FILES["video_file"]["name"], PATHINFO_EXTENSION);
            if ((in_array(strtoupper($file_extension), Config::ATTACHMENT_TYPE))) {
                $valid = true;
            }
        }

        return $valid;
    }

    function uploadVideo()
    {
        $file_name = $this->videoURL;
        try {
            $uri = $this->vimeoClient->upload($file_name, array(
                'name' => 'Video' . time()
            ));

            $video_data = $this->vimeoClient->request($uri);

            if ($video_data['status'] == 200) {
                $output = array(
                    "type" => "success",
                    "link" => $video_data['body']['link']
                );
            }
        } catch (VimeoUploadException $e) {
            $error = 'Error uploading ' . $file_name . "\n";
            $error .= 'Server reported: ' . $e->getMessage() . "\n";
            $output = array(
                "type" => "error",
                "error_message" => $error
            );
        } catch (VimeoRequestException $e) {
            $error = 'There was an error making the request.' . "\n";
            $error .= 'Server reported: ' . $e->getMessage() . "\n";
            $output = array(
                "type" => "error",
                "error_message" => $error
            );
        }

        $response = json_encode($output);
        return $response;
    }
}