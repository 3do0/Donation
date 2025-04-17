<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OrganizationCase;
use Illuminate\Http\Request;

class CaseController extends Controller
{
    public function index()
{
    $cases = OrganizationCase::with('organization_user.organization', 'comments')
        ->where('status', 'in_progress')
        ->get([
            'id',
            'case_name',
            'organization_user_id',
            'case_photo',
            'case_type',
            'beneficiaries_count',
            'description',
            'visitors_count',
            'currency',
            'target_amount',
            'raised_amount',
            'end_date',
            'created_at',
            'status',
        ])->map(function ($case) {
            $ratings = $case->comments->pluck('rating')->filter();
            $averageRating = $ratings->count() > 0 ? round($ratings->avg(), 2) : 0;

            return [
                'id' => $case->id,
                'organization_name' => $case->organization_user->organization->name ?? 'غير معروف',
                'case_name' => $case->case_name,
                'case_photo' => asset('storage/' . $case->case_photo),
                'case_type' => $case->case_type,
                'beneficiaries_count' => $case->beneficiaries_count,
                'description' => $case->description,
                'visitors_count' => $case->visitors_count,
                'currency' => $case->currency,
                'target_amount' => (double) $case->target_amount,
                'raised_amount' => (double) $case->raised_amount,
                'remaining_amount' => $case->target_amount - $case->raised_amount,
                'end_date' => $case->end_date->format('Y-m-d'),
                'created_date' => $case->created_at->format('Y-m-d'),
                'status' => $case->status,
                'average_rating' => $averageRating,
                'comments' => $case->comments->map(function ($comment) {
                    return [
                        'donor_name' => $comment->donor->name,
                        'donor_avatar' => asset('storage/' . $comment->donor->avatar),
                        'rating' => $comment->rating,
                        'comment' => $comment->comment,
                        'craeted_at' => $comment->created_at->diffForHumans(),
                    ];
                }),
            ];
        });

    return response()->json([
        'success' => true,
        'data' => $cases
    ]);
}

}
