<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\SubmissionFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function index($id, $id_post)
    {
        $submissions = Submission::with("user")->where("post_id", $id_post)
            ->whereIn('status', ['done', 'graded'])->get();
        return view("assesment.index", compact("submissions", "id"));
    }

    public function show($id, $id_submission)
    {
        $submission = Submission::with('user', 'files')
            ->where('id', $id_submission)
            ->firstOrFail();
        return view("assesment.detail", compact("submission", "id"));
    }

    public function store(Request $request, $id, $id_post)
    {
        $request->validate([
            "files" => "required",
            "files.*" => "file|max:10240"
        ]);

        $userId = Auth::user()->id;

        $submission = Submission::where("post_id", $id_post)
            ->where("user_id", $userId)->first();

        $submission->status = "done";
        $submission->save();
        $this->uploadSubmissionFiles($request, $submission);
        return redirect()->back()->with(["success" => "Tugas berhasil dikumpulkan!"]);
    }

    public function update(Request $request, $id, $id_submission)
    {
        $validation = $request->validate([
            "score" => "required"
        ]);

        $validation["status"] = "graded";
        Submission::where("id", $id_submission)->update($validation);
        return redirect()->back();
    }

    private function uploadSubmissionFiles(Request $request, Submission $submission)
    {
        $uploadedFiles = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('submission_files');

                $submissionFile = SubmissionFile::create([
                    'submission_id' => $submission->id,
                    'user_id' => Auth::user()->id,
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getSize(),
                ]);

                $uploadedFiles[] = [
                    'name' => $submissionFile->original_name,
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => round($file->getSize() / 1024 / 1024, 2),
                ];
            }
        }

        return $uploadedFiles;
    }

    public function download($id, $id_file)
    {
        $file = SubmissionFile::findOrFail($id_file);
        $filePath = storage_path('app/private/' . $file->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath, $file->original_name);
    }
}
