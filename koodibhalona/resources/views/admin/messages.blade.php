@extends('layouts.admin')

@section('title', 'Messages')
@section('header', 'Contact Messages')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">All Messages</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-sm uppercase tracking-wider">
                    <th class="p-4 font-medium">Date</th>
                    <th class="p-4 font-medium">Name</th>
                    <th class="p-4 font-medium">Contact Info</th>
                    <th class="p-4 font-medium">Subject</th>
                    <th class="p-4 font-medium">Message</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($messages as $message)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4 text-sm text-gray-500 whitespace-nowrap">
                        {{ $message->created_at->format('M d, Y H:i') }}
                    </td>
                    <td class="p-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $message->name }}
                    </td>
                    <td class="p-4 text-sm text-gray-600 whitespace-nowrap">
                        <div><a href="mailto:{{ $message->email }}" class="text-amber-600 hover:underline">{{ $message->email }}</a></div>
                        @if($message->phone)
                        <div><a href="tel:{{ $message->phone }}" class="text-gray-500 hover:text-gray-700">{{ $message->phone }}</a></div>
                        @endif
                    </td>
                    <td class="p-4 text-sm text-gray-900 font-medium">
                        {{ $message->subject }}
                    </td>
                    <td class="p-4 text-sm text-gray-600 max-w-xs truncate" title="{{ $message->message }}">
                        {{ Str::limit($message->message, 50) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <i data-lucide="inbox" class="w-12 h-12 text-gray-300 mb-3"></i>
                            <p>No messages found.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div class="p-4 border-t border-gray-100">
        {{ $messages->links() }}
    </div>
    @endif
</div>
@endsection
