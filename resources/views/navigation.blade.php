@foreach (config('custom-links.links') as $name => $link)

    @if(empty($link['_hasAnyPermission']) || auth()->user()->hasAnyPermission($link['_hasAnyPermission']))

        @if (empty($link['_url']))

            <h3 class="flex items-center font-normal text-white mb-{{ isset($link['_links']) ? '6' : '8' }} text-base no-underline">
                @if (empty($link['_icon']))
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="var(--sidebar-icon)"
                              d="M19.48 13.03A4 4 0 0 1 16 19h-4a4 4 0 1 1 0-8h1a1 1 0 0 0 0-2h-1a6 6 0 1 0 0 12h4a6 6 0 0 0 5.21-8.98L21.2 12a1 1 0 1 0-1.72 1.03zM4.52 10.97A4 4 0 0 1 8 5h4a4 4 0 1 1 0 8h-1a1 1 0 0 0 0 2h1a6 6 0 1 0 0-12H8a6 6 0 0 0-5.21 8.98l.01.02a1 1 0 1 0 1.72-1.03z"></path>
                    </svg>
                @else
                    {!! $link['_icon'] !!}
                @endif
                <span class="sidebar-label">
                    {{ $name }}
                </span>
            </h3>

        @else

            <a href="{{ $link['_url'] }}"
               class="cursor-pointer flex items-center font-normal dim text-white mb-{{ isset($link['_links']) ? '6' : '8' }} text-base no-underline"
               target="{{ isset($link['_target']) ? $link['_target'] : '_self' }}">
                @if (empty($link['_icon']))
                    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="var(--sidebar-icon)"
                              d="M19.48 13.03A4 4 0 0 1 16 19h-4a4 4 0 1 1 0-8h1a1 1 0 0 0 0-2h-1a6 6 0 1 0 0 12h4a6 6 0 0 0 5.21-8.98L21.2 12a1 1 0 1 0-1.72 1.03zM4.52 10.97A4 4 0 0 1 8 5h4a4 4 0 1 1 0 8h-1a1 1 0 0 0 0 2h1a6 6 0 1 0 0-12H8a6 6 0 0 0-5.21 8.98l.01.02a1 1 0 1 0 1.72-1.03z"></path>
                    </svg>
                @else
                    {!! $link['_icon'] !!}
                @endif
                <span class="text-white sidebar-label">
                {{ $name }}
            </span>
            </a>

        @endif

        @if (isset($link['_links']))

            @if (count($link['_links']))

                <ul class="list-reset mb-8">

                    @foreach ($link['_links'] as $name => $sublink)

                        @if(empty($sublink['_hasAnyPermission']) || auth()->user()->hasAnyPermission($sublink['_hasAnyPermission']))

                          <li class="leading-tight mb-4 ml-8 text-sm">
                        
                            @if (isset($sublink['_type']) && $sublink['_type'] == 'link')

                                    <a href="{{ $sublink['_url'] }}" class="text-white text-justify no-underline dim"
                                       target="{{ isset($sublink['_target']) ? $sublink['_target'] : '_self' }}">
                                        {{ $name }}
                                    </a>
                                
                            @elseif (isset($sublink['_type']) && $sublink['_type'] == 'resource')
                                <router-link :to="{
                                        name: 'index',
                                        params: {
                                            resourceName: '{{ $sublink['_url'] }}'
                                        }
                                    }" class="text-white text-justify no-underline dim">
                                        {{ $name }}
                                    </router-link>
                            @elseif (isset($sublink['_type']) && $sublink['_type'] == 'tool')
                                    <router-link :to="{
                                        name: '{{ $sublink['_url'] }}'
                                    }" class="text-white text-justify no-underline dim">
                                        {{ $name }}
                                    </router-link>
                            @endif
                          </li>
                        @endif

                    @endforeach

                </ul>

            @endif

        @endif

    @endif

@endforeach
