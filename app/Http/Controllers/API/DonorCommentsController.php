<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DonorFeedback;
use App\Models\OrganizationCase;
use App\Models\OrganizationProject;
// use App\Models\OrganizationProject;
use Illuminate\Http\Request;

class DonorCommentsController extends Controller
{
    public function caseCommentsStore(Request $request)
    {
        $request->validate([
            'case_id' => 'required|exists:organization_cases,id',
            'comment' => 'required|string|max:1000',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $donor = auth()->guard('donor')->user();

        $case = OrganizationCase::findOrFail($request->case_id);

        $feedback = DonorFeedback::create([
            'donor_id' => $donor->id,
            'feedbackable_id' => $case->id,
            'feedbackable_type' => OrganizationCase::class,
            'comment' => $request->comment,
            'rating' => $request->rating ?? null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم إرسال التعليق بنجاح',
            'data' => $feedback
        ], 201);
    }

    public function projectCommentsStore(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:organization_projects,id',
            'comment' => 'required|string|max:500',
            'rating' => 'nullable|integer|max:5',
        ]);

        $donor = auth()->guard('donor')->user();
        $feedback = DonorFeedback::create([
            'donor_id' => $donor->id,
            'feedbackable_id' => $request->project_id,
            'feedbackable_type' => OrganizationProject::class,
            'comment' => $request->comment,
            'rating' => $request->rating ?? null,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم إرسال التعليق بنجاح',
            'data' => $feedback
        ], 201);
    }
}
