@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Welcome, {{ $teacher->name }}!</h1>
        <p class="text-gray-600 mt-2">Teacher Dashboard - {{ now()->format('F j, Y') }}</p>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <h3 class="text-lg font-semibold text-gray-700">My Classes</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['total_classes'] }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <h3 class="text-lg font-semibold text-gray-700">Students</h3>
            <p class="text-3xl font-bold text-green-600">{{ $stats['total_students'] }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <h3 class="text-lg font-semibold text-gray-700">Today's Sessions</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $stats['upcoming_sessions'] }}</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="#" class="bg-blue-500 text-white px-4 py-3 rounded-lg text-center hover:bg-blue-600 transition">
                Manage Classes
            </a>
            <a href="#" class="bg-green-500 text-white px-4 py-3 rounded-lg text-center hover:bg-green-600 transition">
                View Students
            </a>
            <a href="#" class="bg-purple-500 text-white px-4 py-3 rounded-lg text-center hover:bg-purple-600 transition">
                Schedule Session
            </a>
            <a href="#" class="bg-orange-500 text-white px-4 py-3 rounded-lg text-center hover:bg-orange-600 transition">
                Track Attendance
            </a>
        </div>
    </div>
</div>
@endsection