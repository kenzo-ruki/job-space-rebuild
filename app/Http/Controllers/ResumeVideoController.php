<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ResumeVideo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ResumeVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('jobseeker.resume-video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(403);
        }

        try {
            // do NOT allow third party video uploads
            if (false && isset($_POST['video-filename']) && strrpos($_POST['video-filename'], "RecordRTC-") !== 0) {
                throw new \Exception('File name must start with "RecordRTC-"');
            }

            $userId = $request->input('user-id');
            $file_idx = 'video-blob';
            $fileName = $_POST['video-filename'];
            $tempName = $_FILES[$file_idx]['tmp_name'];
            $fileSize = $_FILES[$file_idx]['size'];

            if (empty($fileName) || empty($tempName)) {
                if (empty($tempName)) {
                    throw new \Exception('Invalid temp_name: ' . $tempName);
                }
                throw new \Exception('Invalid file name: ' . $fileName);
            }

            $videoDirectory = date("Ym");
            if (!Storage::exists('public/resumes/'. $videoDirectory)) {
                Storage::makeDirectory('public/resumes/' . $videoDirectory);
            }
            $directoryPath = storage_path('app/public/resumes/' . $videoDirectory);
            $filePath = $directoryPath . '/' . $fileName;
            $filePathName = $videoDirectory . '/' . $fileName;

            // make sure that one can upload only allowed audio/video files
            $allowed = array(
                'webm',
                'wav',
                'mp4',
                'mkv',
                'mp3',
                'ogg',
                'mkv',
            );

            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            if (!$extension || empty($extension) || !in_array($extension, $allowed)) {
                throw new \Exception('Invalid file extension: ' . $extension);
            }

            if (!move_uploaded_file($tempName, $filePath)) {
                if (!empty($_FILES["file"]["error"])) {
                    $listOfErrors = array(
                        '1' => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
                        '2' => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
                        '3' => 'The uploaded file was only partially uploaded.',
                        '4' => 'No file was uploaded.',
                        '6' => 'Missing a temporary folder. Introduced in PHP 5.0.3.',
                        '7' => 'Failed to write file to disk. Introduced in PHP 5.1.0.',
                        '8' => 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.',
                    );
                    $error = $_FILES["file"]["error"];

                    if (!empty($listOfErrors[$error])) {
                        throw new \Exception('There was a problem saving your file: ' . $listOfErrors[$error]);
                    } else {
                        throw new \Exception('There was a problem saving your file: ' . $_FILES["file"]["error"]);
                    }
                } else {
                    throw new \Exception('There was a problem saving your file: ' . $tempName);
                }
                throw new \Exception('There was a problem saving your file');
            }
            $user = User::find($userId);
            $user->update(['video_path' => $filePathName]);
            $videoUrl = route('resume-video.show');
            return response()->json(['status' => 'success', 'message' => $videoUrl], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // Get the recruiter instance associated with the authenticated user
        return view('jobseeker.resume-video.show');
    }

    /**
     * Display the specified resource.
     */
    public function play()
    {
        $user = auth()->user();
        $filePath = public_path('storage/resumes/'. $user->video_path);
        if (file_exists($filePath)) {
            return response()->file($filePath, ['Content-Type' => 'video/webm']);
        } else {
            abort(404, 'Video not found');
        }
    }

    /**
     * Display the specified resource.
     */
    public function watch($user_id)
    {
        $user = User::find($user_id);
        // Get the recruiter instance associated with the authenticated user
        return view('recruiter.resume-video.view', compact('user'));
    }

    /**
     * Display the specified resource.
     */
    public function view($user_id)
    {
        $user = User::find($user_id);
        $filePath = public_path('storage/resumes/'. $user->video_path);
        if (file_exists($filePath)) {
            return response()->file($filePath, ['Content-Type' => 'video/webm']);
        } else {
            abort(404, 'Video not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResumeVideo $resumeVideo)
    {
        //
    }
}
