<?php
return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'     => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'room'           => [
        'title'          => 'Rooms',
        'title_singular' => 'Room',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => 'The room name',
            'user'               => 'User',
            'user_helper'        => 'The user that created the room',
            'description'        => 'Description',
            'description_helper' => 'The description of the room',
            'thumbnails'         => 'Thumbnails',
            'thumbnails_helper'  => 'The room showcase pictures',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'published'          => 'Published',
            'published_helper'   => 'Whether the room is published for public viewing',
        ],
    ],
    'bedType'        => [
        'title'          => 'Bed Types',
        'title_singular' => 'Bed Type',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => 'The name of the bed type',
            'capacity'          => 'Capacity',
            'capacity_helper'   => 'The capacity of the bed type',
            'user'              => 'User',
            'user_helper'       => 'The user that created the bed type',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'bed'            => [
        'title'          => 'Beds',
        'title_singular' => 'Bed',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'bed_type'              => 'Bed Type',
            'bed_type_helper'       => 'The bed type',
            'room'                  => 'Room',
            'room_helper'           => 'The room containing the bed',
            'number_of_beds'        => 'Number Of Beds',
            'number_of_beds_helper' => 'The number of beds in the room',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'amenity'        => [
        'title'          => 'Amenities',
        'title_singular' => 'Amenity',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => 'The name of the amenity',
            'description'        => 'Description',
            'description_helper' => 'The description of the amenity',
            'user'               => 'User',
            'user_helper'        => 'The user that created the amenity',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'roomAmenity'    => [
        'title'          => 'Room Amenities',
        'title_singular' => 'Room Amenity',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'room'              => 'Room',
            'room_helper'       => 'The room that has the amenity',
            'amenity'           => 'Amenity',
            'amenity_helper'    => 'The amenity in the room',
            'user'              => 'User',
            'user_helper'       => 'The user that added this amenity to room',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'booking'        => [
        'title'          => 'Bookings',
        'title_singular' => 'Booking',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'amount'               => 'Amount',
            'amount_helper'        => 'The total amount paid',
            'tax'                  => 'Tax',
            'tax_helper'           => 'The tax amount paid',
            'discount'             => 'Discount',
            'discount_helper'      => 'The discount offered',
            'email_address'        => 'Email Address',
            'email_address_helper' => 'The email address of the customer',
            'phone'                => 'Phone',
            'phone_helper'         => 'The phone number of the customer',
            'status'               => 'Status',
            'status_helper'        => 'The status of the booking transaction',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
];