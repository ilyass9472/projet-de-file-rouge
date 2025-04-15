<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <x-admin.stat-card
        title="Total Users"
        :value="$stats['total_users']"
        icon="users"
        color="blue"
    />
    <x-admin.stat-card
        title="Total Reports"
        :value="$stats['total_reports']"
        icon="document-text"
        color="green"
    />
    <x-admin.stat-card
        title="Pending Reports"
        :value="$stats['pending_reports']"
        icon="clock"
        color="yellow"
    />
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Activities -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900">Recent Activities</h3>
                <div class="mt-6">
                    <livewire:admin.activity-log />
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                <div class="mt-6 space-y-4">
                    <x-admin.action-button
                        href="{{ route('users.create') }}"
                        icon="user-add"
                        label="Add New User"
                    />
                    <x-admin.action-button
                        href="{{ route('roles.create') }}"
                        icon="shield-check"
                        label="Create New Role"
                    />
                    <x-admin.action-button
                        href="{{ route('admin.reports') }}"
                        icon="document"
                        label="View Reports"
                    />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
