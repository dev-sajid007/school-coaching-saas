@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">My Classes</h1>
        <a href="{{ route('teacher.classes.create') }}" 
           class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition">
            Create New Class
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6">
        @forelse($classes as $class)
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4" 
                 style="border-left-color: {{ $class->subject->color_code }}">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $class->name }}</h3>
                        <p class="text-gray-600 mt-1">{{ $class->subject->name }} • {{ $class->grade_level }}</p>
                        <p class="text-gray-500 text-sm mt-2">{{ $class->description }}</p>
                        
                        <div class="flex items-center space-x-6 mt-4 text-sm text-gray-600">
                            <span>⏰ {{ \Carbon\Carbon::parse($class->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($class->end_time)->format('h:i A') }}</span>
                            <span>📅 {{ implode(', ', array_map('ucfirst', $class->days_of_week)) }}</span>
                            <span>👥 {{ $class->students_count }}/{{ $class->max_students }} students</span>
                        </div>
                    </div>
                    
                    <div class="flex space-x-3">
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $class->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $class->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <h3 class="text-gray-500 text-xl">No classes yet</h3>
                <p class="text-gray-400 mt-2">Create your first class to get started!</p>
                <a href="{{ route('teacher.classes.create') }}" 
                   class="mt-4 inline-block bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition">
                    Create Your First Class
                </a>
            </div>
        @endforelse
    </div>

    {{ $classes->links() }}
</div>
@endsection