<?php

namespace Database\Factories;

use App\Models\OrganizationProjectRequest;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrganizationUser;

class OrganizationProjectRequestFactory extends Factory
{
    protected $model = OrganizationProjectRequest::class;

    public function definition(): array
    {
        return [
            'organization_user_id' => OrganizationUser::inRandomOrder()->first()?->id,
            'project_name' => fake('ar_SA')->words(3, true),
            'description' => fake('ar_SA')->paragraph(),
            'project_photo' => 'projectsPhotos/1zfzxGABQcFyZNwHGlgdfplCtFVLn53VnRWCeX3y.jpg',
            'project_file' => 'projectsFiles/0uCmNTnkEIzSzQLdQ9hGuCKCw8Xo6jinGlRBlB2p.pdf',
            'beneficiaries_count' => fake()->numberBetween(10, 200),
            'location' => fake('ar_SA')->address(),
            'contact_number' => '77' . fake()->numberBetween(1000000, 9999999),
            'whatsapp_number' => '77' . fake()->numberBetween(1000000, 9999999),
            'approval_status' => 'pending',
        ];
    }
}
