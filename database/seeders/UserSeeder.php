<?php

namespace Database\Seeders;

// Library
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;


// Models
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::whereIn('name', ['admin'])
            ->pluck('uuid', 'name')
            ->toArray();

        $users = [
            [
                'name' => 'Widya',
                'email' => 'widya@fitriacookry.com',
                'phone' => '+6288214407298',
                'password' => Hash::make('widya123'),
                'role' => 'admin',
            ],
        ]; 

        foreach ($users as $user) {
            if (!User::where('email', $user['email'])->exists()) {
                User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'password' => $user['password'],
                    'role_id' => $roles[$user['role']],
                ]);
            }
        }        
    }
}
