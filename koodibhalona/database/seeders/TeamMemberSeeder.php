<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'Sai Jay Shankar B.C.',
                'role' => 'Founder & President',
                'description' => 'Master of Art, Advocate, Legal Consultant, Social Worker, Environmentalist, Actor, Director, Producer, and Artist. State level winner in clay modelling, mimicry, and drawing.',
                'photo_path' => null,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Vice President',
                'role' => 'Vice President',
                'description' => 'Supporting the trust initiatives and community development programs.',
                'photo_path' => null,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Secretary',
                'role' => 'Secretary',
                'description' => 'Managing administrative affairs and coordinating trust activities.',
                'photo_path' => null,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Treasurer',
                'role' => 'Treasurer',
                'description' => 'Overseeing financial management and fund allocation for trust programs.',
                'photo_path' => null,
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($teamMembers as $member) {
            TeamMember::create($member);
        }
    }
}
