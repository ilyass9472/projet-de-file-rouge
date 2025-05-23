@props(['title', 'value', 'icon', 'color'])

<div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="p-5">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <x-dynamic-component 
                    :component="'heroicon-o-' . $icon"
                    class="h-6 w-6 text-{{ $color }}-600"
                />
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        {{ $title }}
                    </dt>
                    <dd class="flex items-baseline">
                        <div class="text-2xl font-semibold text-gray-900">
                            {{ $value }}
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
