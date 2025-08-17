@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Create New Class</h1>
        <p class="text-gray-600 mt-2">Set up a new class for your students</p>
    </div>

    <form action="{{ route('teacher.classes.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Class Name -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Class Name</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="e.g., Advanced Mathematics">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subject -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                <select name="subject_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
                @error('subject_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grade Level -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Grade Level</label>
                <select name="grade_level" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Grade</option>
                    @foreach($gradeLevels as $grade)
                        <option value="{{ $grade }}" {{ old('grade_level') == $grade ? 'selected' : '' }}>
                            {{ $grade }}
                        </option>
                    @endforeach
                </select>
                @error('grade_level')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Time -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Start Time</label>
                <input type="time" name="start_time" value="{{ old('start_time') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('start_time')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">End Time</label>
                <input type="time" name="end_time" value="{{ old('end_time') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('end_time')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Max Students -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Maximum Students</label>
                <input type="number" name="max_students" value="{{ old('max_students', 30) }}" min="1" max="50"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('max_students')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Days of Week -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Days of Week</label>
                <div class="grid grid-cols-7 gap-2">
                    @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                        <label class="flex items-center justify-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="days_of_week[]" value="{{ $day }}" 
                                   class="sr-only peer" {{ in_array($day, old('days_of_week', [])) ? 'checked' : '' }}>
                            <span class="peer-checked:bg-blue-500 peer-checked:text-white px-3 py-1 rounded text-sm">
                                {{ ucfirst(substr($day, 0, 3)) }}
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('days_of_week')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                          placeholder="Brief description of the class...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end space-x-4 mt-8">
            <a href="{{ route('teacher.classes.index') }}" 
               class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                Cancel
            </div>
            <button type="submit" 
                    class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                Create Class
            </button>
        </div>
    </form>
</div>
@endsection