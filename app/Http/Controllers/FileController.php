<?php

namespace App\Http\Controllers;

use App\Models\File;
use Google_Service_Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Google_Client;
use Google_Service_YouTube;
use Google_Exception;

class FileController extends Controller
{
    public function store(Request $request)
    {
        // Validate the uploaded file
        $validatedData = $request->validate([
            'file' => 'required|file',
            'type' => 'required|in:' . implode(',', array_keys(config('file.types'))),
        ]);

        // Get the uploaded file
        $uploadedFile = $validatedData['file'];

        // Determine the file type
        $fileType = $validatedData['type'];

        // Retrieve the file configuration
        $fileConfig = config('file.types.' . $fileType);

        // Generate a unique file name
        $fileName = uniqid() . '_' . $uploadedFile->getClientOriginalName();

        // Determine the public storage path
        $storagePath = public_path($fileConfig['local_path']);

        // Move the file to the public storage directory
        $uploadedFile->move($storagePath, $fileName);

        // Create a new file record in the database
        $file = new File();
        $file->name = $uploadedFile->getClientOriginalName();
        $file->local_path = $fileConfig['local_path'] . '/' . $fileName;
        $file->type = $fileType;
        $file->save();

        // Return the response with the created file data
        return response()->json([
            'message' => 'File uploaded successfully',
            'data' => $file,
        ]);
    }
    public function downloadVideosFromPlaylist()
    {
        // Set your API credentials and other configurations
        $apiKey = 'AIzaSyAHbvMI8fsaLL0XHQWUfYPge243nn-49U0';

        // Set your API credentials and other configurations
        $client = new Google_Client();
        $client->setDeveloperKey($apiKey);
        $client->addScope(Google_Service_YouTube::YOUTUBE_READONLY);

        // Create a new YouTube service
        $youtube = new Google_Service_YouTube($client);
        // Playlist URL of the YouTube playlist you want to download videos from
        $url = 'https://youtube.com/playlist?list=PLDzeHZWIZsTryvtXdMr6rPh4IDexB5NIA';

        $parts = parse_url($url);
        if (isset($parts['query'])) {
            parse_str($parts['query'], $query);
            if (isset($query['list'])) {
                $playlistId = $query['list'];

                try {
                    // Retrieve the playlist items from the specified playlist
                    $playlistItems = $youtube->playlistItems->listPlaylistItems('snippet', ['playlistId' => $playlistId]);

                    // Iterate through each video in the playlist
                    foreach ($playlistItems as $playlistItem) {
                        // Get the video ID
                        $videoId = $playlistItem->snippet->resourceId->videoId;

                        // Construct the download URL for the video
                        $downloadUrl = "https://www.youtube.com/watch?v={$videoId}";

                        // Log the download process
                        echo "Downloading video: $downloadUrl\n";

                        // Implement your code to download the video using the $downloadUrl
                        // For example, you can use libraries like youtube-dl or implement your own solution
                        // Here's an example using youtube-dl library:
                        exec("youtube-dl -o '/home/danish/Documents/%(title)s.%(ext)s' $downloadUrl", $output, $returnCode);

                        if ($returnCode === 0) {
                            // Video downloaded successfully
                            echo "Video downloaded: " . implode("\n", $output) . "\n";
                        } else {
                            // Error occurred during download
                            echo "Error downloading video: " . implode("\n", $output) . "\n";
                        }


                        // Log the success message
                        echo "Video downloaded successfully!\n";

                        // Remember to handle any error scenarios and adjust the download process as needed
                    }

                    return 'Videos downloaded successfully!';
                } catch (Google_Service_Exception $e) {
                    return 'An error occurred: ' . $e->getMessage();
                } catch (Google_Exception $e) {
                    return 'An error occurred: ' . $e->getMessage();
                }
            } else {
                return 'Invalid YouTube playlist URL: Playlist ID not found.';
            }
        } else {
            return 'Invalid YouTube playlist URL: Query string not found.';
        }
    }

}
