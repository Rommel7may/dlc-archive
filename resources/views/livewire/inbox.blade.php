<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="flex items-center justify-between">
        <h1 class="text-4xl font-bold text-red-900">Pending ACM Requests</h1>
        <div class="flex justify-end w-lg">
        </div>
    </div>
    <div class="mt-6 p-4 bg-white rounded-xl">
        <div class="overflow-x-auto bg-white shadow-md rounded-xl">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-amber-100">
                    <tr class="">
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                            #
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Requester
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Title
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Request Purpose
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Status
                        </th>
           
                        <th class="px-6 py-3 text-right text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
               
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($requests as $request)
                    <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $request->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $request->researchProject->title }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $request->purpose }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $request->status }}
                            </td>
     
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm ">
                                @if($request->status !== 'approved')
                                    <flux:button class="mr-2" icon="check" size="sm" wire:click="approveRequest({{ $request->id }})">Approve</flux:button>
                                    <flux:button variant="danger" icon="x-mark" size="sm" wire:click="rejectRequest({{ $request->id }})">Decline</flux:button>
                                @else
                                    @if($request->pdf_path)
                                    <flux:button icon="document-arrow-down" size="sm" href="{{ asset(str_replace('public/', 'storage/', $request->pdf_path)) }}" target="_blank">Download</flux:button>
                                    {{-- <flux:button icon="document-arrow-down" size="sm" wire:click="download({{ $request->id }})" target="_blank">Download</flux:button> --}}
                                    @endif
                                    <flux:button variant="danger" icon="trash" size="sm" wire:click="rejectRequest({{ $request->id }})">Delete</flux:button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                </tbody>
                
            </table>
        </div>
    </div>

<!-- oihuj -->
</div>
