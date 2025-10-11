<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-red-950 !text-yellow-500">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
            

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <button class="flex w-full items-center justify-between text-white cursor-pointer">
                    <div class="flex items-center gap-2">
                        <flux:avatar :name="auth()->user()->name" initials:single class="size-8"/>
                        {{ auth()->user()->name }}
                    </div>
                    
                    <flux:icon name="chevron-up-down" class="size-4"/>
                </button>

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
            <!-- End Desktop User Menu -->
        
            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">

                @if(auth()->check() && auth()->user()->isAdmin())
                    <flux:navlist.item class="{{ request()->routeIs('dashboard') ? '!text-black' : '!text-white' }}" icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>

                    <flux:navlist.item class="{{ request()->routeIs('manage-users') ? '!text-black' : '!text-white' }}" icon="users" wire:navigate :href="route('manage-users')" :current="request()->routeIs('manage-users')">{{ __('Manage User') }}</flux:navlist.item>

                    <flux:navlist.item class="{{ request()->routeIs('manage-projects') ? '!text-black' : '!text-white' }}" icon="document-text" wire:navigate :href="route('manage-projects')" :current="request()->routeIs('manage-projects')">{{ __('Manage Project') }}</flux:navlist.item>

                    <flux:navlist.item  class="{{ request()->routeIs('admin-accounts') ? '!text-black' : '!text-white' }}" icon="user-plus" wire:navigate :href="route('admin-accounts')" :current="request()->routeIs('admin-accounts')">{{ __('Add Admin Account') }}</flux:navlist.item>

                    <flux:navlist.item  class="{{ request()->routeIs('inbox') ? '!text-black' : '!text-white' }}" icon="inbox-arrow-down" wire:navigate :href="route('inbox')" :current="request()->routeIs('inbox')">{{ __('Inbox') }}</flux:navlist.item>
                @endif
                
                

                @if(auth()->user()->isUser())
                    <flux:navlist.item  class="{{ request()->routeIs('templates') ? '!text-black' : '!text-white' }}" icon="inbox-arrow-down" wire:navigate :href="route('templates')" :current="request()->routeIs('templates')">{{ __('Templates') }}</flux:navlist.item>

                    <flux:navlist.item  class="{{ request()->routeIs('user-inbox') ? '!text-black' : '!text-white' }}" icon="inbox-arrow-down" wire:navigate :href="route('user-inbox')" :current="request()->routeIs('user-inbox')">{{ __('User Inbox') }}</flux:navlist.item>
                @endif

                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

    
            
        </flux:sidebar>

           <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>
        
        {{ $slot }}

        @fluxScripts


        @livewireScripts
        @livewireStyles
    </body>
</html>
