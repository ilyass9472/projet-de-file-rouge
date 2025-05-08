@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Send Accident Report to Authorities</h1>
            
            <div class="mb-6 p-4 border-l-4 border-blue-500 bg-blue-50 text-blue-700">
                <p><strong>Report ID:</strong> ACC-{{ str_pad($accident->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p><strong>Date of Accident:</strong> {{ $accident->accident_date->format('Y-m-d') }}</p>
                <p><strong>Time of Accident:</strong> {{ $accident->accident_time }}</p>
            </div>
            
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif
            
            <form action="{{ route('reports.send', $accident->id) }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="email_addresses" class="block text-sm font-medium text-gray-700 mb-1">Email Addresses</label>
                    <input type="text" id="email_addresses" name="email_addresses" value="{{ old('email_addresses') }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                        placeholder="Enter email addresses separated by commas" required>
                    <p class="mt-1 text-sm text-gray-500">
                        Enter the email addresses of the authorities, separated by commas.
                    </p>
                    @error('email_addresses')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Report Format</label>
                    <div class="mt-2 space-y-3">
                        <div class="flex items-center">
                            <input id="report-format-pdf" name="report_format" type="radio" value="pdf" 
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500" checked>
                            <label for="report-format-pdf" class="ml-3 block text-sm font-medium text-gray-700">
                                PDF Format
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="report-format-csv" name="report_format" type="radio" value="csv" 
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="report-format-csv" class="ml-3 block text-sm font-medium text-gray-700">
                                CSV Format (for MATLAB import)
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="report-format-both" name="report_format" type="radio" value="both" 
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="report-format-both" class="ml-3 block text-sm font-medium text-gray-700">
                                Both Formats
                            </label>
                        </div>
                    </div>
                    @error('report_format')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('accidents.show', $accident->id) }}" 
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Send Report
                    </button>
                </div>
            </form>
        </div>
        
        <div class="flex justify-between mb-10">
            <a href="{{ route('reports.pdf', $accident->id) }}" target="_blank" 
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                </svg>
                Download PDF Report
            </a>
            <a href="{{ route('reports.csv', $accident->id) }}" target="_blank" 
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                Download CSV for MATLAB
            </a>
        </div>
    </div>
</div>
@endsection