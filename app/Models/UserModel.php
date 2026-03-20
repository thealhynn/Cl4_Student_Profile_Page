<?php

// app/Models/UserModel.php  (UPDATED for RBAC Activity)

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useTimestamps  = true;
    protected $useSoftDeletes = false;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';

    protected $allowedFields = [
        'fullname', 'username', 'password',
        'role',             // FK int to roles.id
        'student_id', 'course', 'year_level', 'section',
        'phone', 'address', 'profile_image',
    ];

    protected $returnType = 'array';

    // ── Validation (registration only) ───────────────────────
    protected $validationRules = [
        'fullname' => 'required|min_length[2]|max_length[100]',
        'username' => 'required|valid_email|is_unique[users.username]',
        'password' => 'required|min_length[8]',
    ];

    // ── Custom methods ────────────────────────────────────────

    public function findByEmail(string $email): ?array
    {
        return $this->where('username', $email)->first();
    }

    /**
     * Return a user with their role name joined in.
     * Uses a raw query join so we get role.name alongside user data.
     *
     * @param int $id  User ID
     */
    public function findWithRole(int $id): ?array
    {
        return $this->db->table('users u')
            ->select('u.*, r.name AS role_name, r.label AS role_label')
            ->join('roles r', 'r.id = u.role', 'left')
            ->where('u.id', $id)
            ->get()
            ->getRowArray();
    }

    /**
     * Return all users with their role label joined in.
     * Used by the Teacher/Admin student management page.
     */
    public function getAllWithRoles(): array
    {
        return $this->db->table('users u')
            ->select('u.id, u.fullname AS name, u.username AS email, u.student_id, u.course,
                      u.year_level, u.section, u.created_at,
                      r.name AS role_name, r.label AS role_label')
            ->join('roles r', 'r.id = u.role', 'left')
            ->orderBy('u.fullname', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function updateProfile(int $userId, array $data): bool
    {
        return $this->update($userId, $data);
    }
}
