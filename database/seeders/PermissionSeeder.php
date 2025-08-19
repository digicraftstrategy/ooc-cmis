<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Dashboard Permissions
            [
                'name' => 'View Dashboard',
                'slug' => 'dashboard_view',
                'group' => 'Dashboard',
                'description' => 'Allows users to view system dashboard and analytics'
            ],
            [
                'name' => 'Manage Dashboard',
                'slug' => 'dashboard_manage',
                'group' => 'Dashboard',
                'description' => 'Allows users to customize and configure dashboard widgets'
            ],

            // Reports Permissions
            [
                'name' => 'Create Report',
                'slug' => 'reports_create',
                'group' => 'Reports',
                'description' => 'Allows users to generate new system reports'
            ],
            [
                'name' => 'View Reports',
                'slug' => 'reports_view',
                'group' => 'Reports',
                'description' => 'Allows users to access and view generated reports'
            ],
            [
                'name' => 'Export Reports',
                'slug' => 'reports_export',
                'group' => 'Reports',
                'description' => 'Allows users to export reports in various formats (PDF, Excel, etc.)'
            ],
            [
                'name' => 'Schedule Reports',
                'slug' => 'reports_schedule',
                'group' => 'Reports',
                'description' => 'Allows users to set up automatic report generation on schedule'
            ],
            [
                'name' => 'Custom Report Builder',
                'slug' => 'reports_custom_builder',
                'group' => 'Reports',
                'description' => 'Allows users to create custom report templates and queries'
            ],
            [
                'name' => 'Data Extraction',
                'slug' => 'reports_data_extraction',
                'group' => 'Reports',
                'description' => 'Allows users to extract raw data from the system'
            ],
            [
                'name' => 'Analytics Dashboard',
                'slug' => 'reports_analytics',
                'group' => 'Reports',
                'description' => 'Allows users to access and configure analytics dashboards'
            ],

            // System Settings Permissions
            [
                'name' => 'Create System Variables',
                'slug' => 'settings_variables_create',
                'group' => 'System Settings',
                'description' => 'Allows users to create new system configuration variables'
            ],
            [
                'name' => 'View System Settings',
                'slug' => 'settings_view',
                'group' => 'System Settings',
                'description' => 'Allows users to view system configuration and settings'
            ],
            [
                'name' => 'Manage System Settings',
                'slug' => 'settings_manage',
                'group' => 'System Settings',
                'description' => 'Allows users to modify global system configuration'
            ],
            [
                'name' => 'Update System Variables',
                'slug' => 'settings_update_variables',
                'group' => 'System Settings',
                'description' => 'Allows users to modify existing system variables'
            ],
            [
                'name' => 'Delete System Variables',
                'slug' => 'settings_delete_variables',
                'group' => 'System Settings',
                'description' => 'Allows users to remove system configuration variables'
            ],
            [
                'name' => 'System Backup',
                'slug' => 'settings_backup',
                'group' => 'System Settings',
                'description' => 'Allows users to create system backups'
            ],
            [
                'name' => 'System Restore',
                'slug' => 'settings_restore',
                'group' => 'System Settings',
                'description' => 'Allows users to restore the system from backups'
            ],
            [
                'name' => 'View System Logs',
                'slug' => 'settings_view_logs',
                'group' => 'System Settings',
                'description' => 'Allows users to access and review system logs'
            ],

            // User Management Permissions
            [
                'name' => 'Create Users',
                'slug' => 'users_create',
                'group' => 'User Management',
                'description' => 'Allows users to add new users to the system'
            ],
            [
                'name' => 'View Users',
                'slug' => 'users_view',
                'group' => 'User Management',
                'description' => 'Allows users to view user accounts and their details'
            ],
            [
                'name' => 'Update Users',
                'slug' => 'users_edit',
                'group' => 'User Management',
                'description' => 'Allows users to modify existing user accounts'
            ],
            [
                'name' => 'Delete Users',
                'slug' => 'users_delete',
                'group' => 'User Management',
                'description' => 'Allows users to remove user accounts from the system'
            ],

            // Role Management Permissions
            [
                'name' => 'Create Role',
                'slug' => 'role_create',
                'group' => 'Role Management',
                'description' => 'Allows users to create new roles in the system'
            ],
            [
                'name' => 'View Role',
                'slug' => 'role_view',
                'group' => 'Role Management',
                'description' => 'Allows users to view role details and assigned permissions'
            ],
            [
                'name' => 'Update Role',
                'slug' => 'role_update',
                'group' => 'Role Management',
                'description' => 'Allows users to modify existing roles'
            ],
            [
                'name' => 'Delete Role',
                'slug' => 'role_delete',
                'group' => 'Role Management',
                'description' => 'Allows users to remove roles from the system'
            ],

            // Role Permissions Management
            [
                'name' => 'Create Role Permission',
                'slug' => 'role_permission_create',
                'group' => 'Roles',
                'description' => 'Allows users to create new role permissions'
            ],
            [
                'name' => 'View Role Permission',
                'slug' => 'role_permission_view',
                'group' => 'Roles',
                'description' => 'Allows users to view role permission details'
            ],
            [
                'name' => 'Update Role Permission',
                'slug' => 'role_permission_update',
                'group' => 'Roles',
                'description' => 'Allows users to modify existing role permissions'
            ],
            [
                'name' => 'Delete Role Permission',
                'slug' => 'role_permission_delete',
                'group' => 'Roles',
                'description' => 'Allows users to remove role permissions from the system'
            ],
            [
                'name' => 'Assign Permissions to Roles',
                'slug' => 'role_permission_assign',
                'group' => 'Roles',
                'description' => 'Allows users to assign or revoke permissions for roles'
            ],

            // Publication Premises Certificate Management Permissions
            [
                'name' => 'View License',
                'slug' => 'license_view',
                'group' => 'License Management',
                'description' => 'Allows users to view license details and status'
            ],
            [
                'name' => 'Manage License',
                'slug' => 'license_manage',
                'group' => 'License Management',
                'description' => 'Allows users to manage license operations'
            ],
            [
                'name' => 'Add License',
                'slug' => 'license_add',
                'group' => 'License Management',
                'description' => 'Allows users to add new licenses to the system'
            ],
            [
                'name' => 'Update License Information',
                'slug' => 'license_update',
                'group' => 'License Management',
                'description' => 'Allows users to modify existing license information'
            ],
            [
                'name' => 'Delete License Information',
                'slug' => 'license_delete',
                'group' => 'License Management',
                'description' => 'Allows users to remove licenses from the system'
            ],
            [
                'name' => 'Suspend License',
                'slug' => 'license_suspend',
                'group' => 'License Management',
                'description' => 'Allows users to temporarily suspend licenses'
            ],
            [
                'name' => 'Issue License',
                'slug' => 'license_issue',
                'group' => 'License Management',
                'description' => 'Allows users to issue new licenses'
            ],

            // Publication Premises Certificate Application Permissions
            [
                'name' => 'Create License Application',
                'slug' => 'create_license_application',
                'group' => 'License Application',
                'description' => 'Allows users to submit new license applications'
            ],
            [
                'name' => 'View License Application',
                'slug' => 'view_license_application',
                'group' => 'License Application',
                'description' => 'Allows users to view license application details'
            ],
            [
                'name' => 'Review License Application',
                'slug' => 'review_license_application',
                'group' => 'License Application',
                'description' => 'Allows users to review submitted license applications'
            ],
            [
                'name' => 'Update License Application',
                'slug' => 'update_license_application',
                'group' => 'License Application',
                'description' => 'Allows users to modify license application details'
            ],
            [
                'name' => 'Approve License Application',
                'slug' => 'approve_license_application',
                'group' => 'License Application',
                'description' => 'Allows users to approve license applications'
            ],
            [
                'name' => 'Reject License Application',
                'slug' => 'reject_license_application',
                'group' => 'License Application',
                'description' => 'Allows users to reject license applications'
            ],
        ];

        // Remove duplicate entry for 'View Dashboard'
        $permissions = $this->removeDuplicatePermissions($permissions);

        // Add timestamps and soft delete value (null)
        $timestamp = Carbon::now();
        $batchInsert = array_map(fn($perm) => array_merge($perm, [
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
            'deleted_at' => null,
        ]), $permissions);

        // Check if permission exists before inserting to avoid duplicates
        foreach ($batchInsert as $permission) {
            if (!DB::table('permissions')->where('slug', $permission['slug'])->exists()) {
                DB::table('permissions')->insert($permission);
            }
        }
    }

    /**
     * Remove duplicate permissions based on slug.
     *
     * @param array $permissions
     * @return array
     */
    private function removeDuplicatePermissions(array $permissions): array
    {
        $uniquePermissions = [];
        $slugs = [];

        foreach ($permissions as $permission) {
            if (!in_array($permission['slug'], $slugs)) {
                $slugs[] = $permission['slug'];
                $uniquePermissions[] = $permission;
            }
        }

        return $uniquePermissions;
    }
}
