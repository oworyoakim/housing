<?php
namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'room_create',
            ],
            [
                'id'    => 18,
                'title' => 'room_edit',
            ],
            [
                'id'    => 19,
                'title' => 'room_show',
            ],
            [
                'id'    => 20,
                'title' => 'room_delete',
            ],
            [
                'id'    => 21,
                'title' => 'room_access',
            ],
            [
                'id'    => 22,
                'title' => 'bed_type_create',
            ],
            [
                'id'    => 23,
                'title' => 'bed_type_edit',
            ],
            [
                'id'    => 24,
                'title' => 'bed_type_show',
            ],
            [
                'id'    => 25,
                'title' => 'bed_type_delete',
            ],
            [
                'id'    => 26,
                'title' => 'bed_type_access',
            ],
            [
                'id'    => 27,
                'title' => 'bed_create',
            ],
            [
                'id'    => 28,
                'title' => 'bed_edit',
            ],
            [
                'id'    => 29,
                'title' => 'bed_show',
            ],
            [
                'id'    => 30,
                'title' => 'bed_delete',
            ],
            [
                'id'    => 31,
                'title' => 'bed_access',
            ],
            [
                'id'    => 32,
                'title' => 'amenity_create',
            ],
            [
                'id'    => 33,
                'title' => 'amenity_edit',
            ],
            [
                'id'    => 34,
                'title' => 'amenity_show',
            ],
            [
                'id'    => 35,
                'title' => 'amenity_delete',
            ],
            [
                'id'    => 36,
                'title' => 'amenity_access',
            ],
            [
                'id'    => 37,
                'title' => 'room_amenity_create',
            ],
            [
                'id'    => 38,
                'title' => 'room_amenity_edit',
            ],
            [
                'id'    => 39,
                'title' => 'room_amenity_show',
            ],
            [
                'id'    => 40,
                'title' => 'room_amenity_delete',
            ],
            [
                'id'    => 41,
                'title' => 'room_amenity_access',
            ],
            [
                'id'    => 42,
                'title' => 'booking_create',
            ],
            [
                'id'    => 43,
                'title' => 'booking_edit',
            ],
            [
                'id'    => 44,
                'title' => 'booking_show',
            ],
            [
                'id'    => 45,
                'title' => 'booking_delete',
            ],
            [
                'id'    => 46,
                'title' => 'booking_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
