<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\MemberClass;
use App\Models\Post;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $classrooms = Classroom::with("user")->withCount("members")->where("user_id", $user_id)
            ->orWhereHas("members", function ($q) use ($user_id) {
                $q->where("user_id", $user_id);
            })
            ->get();
        return view("home.index", compact("classrooms"));
    }

    public function create()
    {
        return view("classroom.create");
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            "name" => "required",
            "description" => "required"
        ]);

        try {
            $validation["user_id"] = Auth::user()->id;
            $validation["code"] = $this->getRandomString(6);
            $validation["color"] = $this->getRandomColor();

            Classroom::create($validation);
            return redirect()->route("home");
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $userId = Auth::user()->id;
        $isAuthor = $userId === Classroom::find($id)->user_id;
        $classroom = Classroom::where("id", $id)->first();
        $posts = Post::with("user")->where("classroom_id", $id)->orderBy("id", "DESC")->get();
        return view("classroom.index", compact("classroom", "posts", "id", "isAuthor"));
    }

    public function joinClass(Request $request)
    {
        $validation = $request->validate([
            "code" => "required"
        ]);

        $user = Auth::user();
        $classroom = Classroom::where("code", $request->code)->first();

        if ($classroom) {
            $alreadyJoined = MemberClass::where('user_id', Auth::id())
                ->where('classroom_id', $classroom->id)
                ->exists();
            if (!$alreadyJoined) {
                MemberClass::create([
                    "user_id" => Auth::id(),
                    "classroom_id" => $classroom->id
                ]);
                $this->generatePendingSubmissions($classroom, $user);
                return redirect()->back();
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function storeInformation(Request $request, $id)
    {
        $validation = $request->validate([
            "content" => "required"
        ]);

        try {
            $validation["user_id"] = Auth::user()->id;
            $validation["classroom_id"] = $id;
            $validation["type"] = "information";
            Post::create($validation);
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function updateInformation(Request $request, $id)
    {
        $validation = $request->validate([
            "content" => "required"
        ]);

        try {
            $validation["user_id"] = Auth::user()->id;
            $validation["classroom_id"] = $id;
            $validation["type"] = "information";
            Post::find($id)->update($validation);
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function setting($id)
    {
        $classroom = Classroom::where("id", $id)->first();
        return view("classroom.setting", compact("classroom", "id"));
    }

    public function updateSetting(Request $request, $id)
    {
        $validation = $request->validate([
            "name" => "required",
            "description" => "required"
        ]);

        try {
            Classroom::find($id)->update($validation);
            return redirect()->route("home");
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    protected function getRandomString($n)
    {
        return bin2hex(random_bytes($n / 2));
    }

    protected function getRandomColor()
    {
        $colors = ["bg-soft-green", "bg-soft-red", "bg-soft-blue", "bg-soft-orange", "bg-soft-purple"];
        return $colors[array_rand($colors)];
    }

    private function generatePendingSubmissions(Classroom $classRoom, $user)
    {
        $now = now();

        $assignments = $classRoom->posts()
            ->where("type", "assignment")
            ->where("due", ">", $now)
            ->get();

        foreach ($assignments as $assignment) {
            $exists = Submission::where('post_id', $assignment->id)
                ->where('user_id', $user->id)
                ->exists();

            if (!$exists) {
                Submission::create([
                    "post_id" => $assignment->id,
                    "user_id" => $user->id,
                    "status"  => "pending",
                    "score"   => 0
                ]);
            }
        }
    }
}
