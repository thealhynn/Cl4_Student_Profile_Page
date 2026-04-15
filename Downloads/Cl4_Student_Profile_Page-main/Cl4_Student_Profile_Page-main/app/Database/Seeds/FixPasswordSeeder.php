<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FixPasswordSeeder extends Seeder
{
    public function run(): void
    {
        $hash = password_hash('Password1', PASSWORD_BCRYPT);

        $emails = [
            'admin@school.edu',
            'teacher@school.edu',
            'student@school.edu',
            'coordinator@school.edu',
        ];

        foreach ($emails as $email) {
            $this->db->table('users')
                ->where('username', $email)
                ->update(['password' => $hash]);
        }

        echo "Passwords updated for demo accounts.\n";
    }
}
