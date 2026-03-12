<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyProfileImageToBlob extends Migration
{
    public function up()
    {
        $fields = [
            'profile_image' => [
                'type' => 'LONGBLOB',
                'null' => true,
            ],
        ];
        $this->forge->modifyColumn('users', $fields);
    }

    public function down()
    {
        $fields = [
            'profile_image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ];
        $this->forge->modifyColumn('users', $fields);
    }
}
