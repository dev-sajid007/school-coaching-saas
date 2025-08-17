@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Join a Class</h1>
        <p class="text-gray-600 mt-2">Enter your class code and details to join</p>
    </div>

    @if(session('info'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-6">
            {{ session('info') }}
        </div>
    @endif

    <form action="{{ route('enrollment.process') }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
        @csrf
        
        <!-- Class Code -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Class Code</label>
            <input type="text" name="class_code" value="{{ old('class_code') }}" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-center text-lg font-mono"
                   placeholder="Enter class code (e.g., MATH2024)">
            @error('class_code')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Roll Number -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Roll Number</label>
                <input type="text" name="roll_number" value="{{ old('roll_number') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('roll_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Phone (Optional)</label>
                <input type="text" name="phone" value="{{ old('phone') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date of Birth -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('date_of_birth')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gender -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                <select name="gender" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Guardian Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Guardian Name</label>
                <input type="text" name="guardian_name" value="{{ old('guardian_name') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('guardian_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Guardian Phone -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Guardian Phone</label>
                <input type="text" name="guardian_phone" value="{{ old('guardian_phone') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('guardian_phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Guardian Email -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Guardian Email (Optional)</label>
            <input type="email" name="guardian_email" value="{{ old('guardian_email') }}" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('guardian_email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Address -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Address (Optional)</label>
            <textarea name="address" rows="3" 
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                      placeholder="Complete address...">{{ old('address') }}</textarea>
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-8">
            <button type="submit" 
                    class="w-full bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition font-medium">
                Join Class
            </button>
        </div>
    </form>
</div>
@endsection