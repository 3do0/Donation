<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OrganizationProject;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = OrganizationProject::with('organization_user.organization', 'comments')
            ->where('status', 'in_progress')
            ->get([
                'id',
                'project_name',
                'organization_user_id',
                'project_photo',
                'project_type',
                'beneficiaries_count',
                'description',
                'location',
                'visitors_count',
                'contact_number',
                'whatsapp_number',
                'end_date',
                'created_at',
                'status',
            ])->map(function ($project) {
                $ratings = $project->comments->pluck('rating')->filter();
                $averageRating = $ratings->count() > 0 ? round($ratings->avg(), 2) : 0;
    
                return [
                    'id' => $project->id,
                    'organization_name' => $project->organization_user->organization->name ?? 'غير معروف',
                    'project_name' => $project->project_name,
                    'project_photo' => asset('storage/' . $project->project_photo),
                    'project_type' => $project->project_type,
                    'beneficiaries_count' => $project->beneficiaries_count,
                    'description' => $project->description,
                    'location' => $project->location,
                    'visitors_count' => $project->visitors_count,
                    'contact_number' => $project->contact_number,
                    'whatsapp_number' => $project->whatsapp_number,
                    'end_date' => $project->end_date->format('Y-m-d'),
                    'created_date' => $project->created_at->format('Y-m-d'),
                    'status' => $project->status,
                    'average_rating' => $averageRating,
                    'comments' => $project->comments->map(function ($comment) {
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
            'data' => $projects
        ]);
    }
    
}
