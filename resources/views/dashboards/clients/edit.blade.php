@extends('dashboards.layouts.app')

@section('content')
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Clients Edit` }">
            @include('dashboards.layouts.breadcrumb')
        </div>
        <!-- Breadcrumb End -->

        <!-- ====== Form Elements Section Start -->
        <div class="min-h-screen flex justify-center px-4">
            <div class="w-full max-w-3xl mt-0 sm:mt-2 lg:mt-4">
                <div class="grid grid-cols-1 gap-6">
                    <div class="space-y-6">
                        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                            <div class="px-5 py-4 sm:px-6 sm:py-5">
                                <div class="flex justify-between items-center w-full">
                                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90 flex-1 text-center">
                                        Edit Client
                                    </h3>
                                </div>
                            </div>

                            <form action="{{ route('clients.update', $client->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                                    <!-- Name Elements -->
                                    <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Name
                                        </label>
                                        <div class="relative">
                                            <input type="text" value="{{ $client->name ?? old('name') }}" name="name"
                                                id="name" placeholder="Name"
                                                class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                                                @error('name')
                                                border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                                                @else
                                                focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11  border-gray-300 dark:border-gray-700
                                                @enderror" />

                                            @error('name')
                                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                            fill="#F04438" />
                                                    </svg>
                                                </span>
                                            @enderror
                                        </div>
                                        @error('name')
                                            <p class="text-theme-xs text-error-500 mt-1.5">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Email Elements -->
                                    <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Email
                                        </label>
                                        <div class="relative">
                                            <input type="text" value="{{ $client->email ?? old('email') }}"
                                                name="email" id="email" placeholder="info@email.com"
                                                class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                                                @error('email')
                                                border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                                                @else
                                                focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11  border-gray-300 dark:border-gray-700
                                                @enderror" />
                                            @error('email')
                                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                            fill="#F04438" />
                                                    </svg>
                                                </span>
                                            @enderror
                                        </div>
                                        @error('email')
                                            <p class="text-theme-xs text-error-500 mt-1.5">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Domain Elements -->
                                    <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Domain
                                        </label>
                                        <div class="relative">
                                            <input type="url" value="{{ $client->domain ?? old('domain') }}"
                                                name="domain" id="domain" placeholder="www.abc.com"
                                                class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                                                @error('domain')
                                                border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                                                @else
                                                focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11  border-gray-300 dark:border-gray-700
                                                @enderror" />
                                            @error('domain')
                                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                            fill="#F04438" />
                                                    </svg>
                                                </span>
                                            @enderror
                                        </div>
                                        @error('domain')
                                            <p class="text-theme-xs text-error-500 mt-1.5">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Date Elements -->
                                    <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Subscription Expiry Date
                                        </label>

                                        <div class="relative">
                                            <input type="date" name="subscription_expiry_date"
                                                id="subscription_expiry_date"
                                                value="{{ $client->subscription_expiry_date ?? old('subscription_expiry_date') }}"
                                                placeholder="Select date" min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                                max="{{ date('Y-m-d', strtotime('+1 year')) }}"
                                                class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                                                @error('subscription_expiry_date')
                                                border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                                                @else
                                                focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 border-gray-300 dark:border-gray-700
                                                @enderror"
                                                onclick="this.showPicker()" />

                                            @error('subscription_expiry_date')
                                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                            fill="#F04438" />
                                                    </svg>
                                                </span>
                                            @else
                                                <span
                                                    class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                                            fill="" />
                                                    </svg>
                                                </span>
                                            @enderror
                                        </div>
                                        @error('subscription_expiry_date')
                                            <p class="text-theme-xs text-error-500 mt-1.5">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- API KEY Elements -->
                                    <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            API Key
                                        </label>
                                        <div class="relative">
                                            <input type="text" id="api_key" name="api_key"
                                                value="{{ $client->api_key }}" readonly
                                                class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                                                @error('api_key')
                                                border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800
                                                @else
                                                focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11  border-gray-300 dark:border-gray-700
                                                @enderror" />
                                            <div class="flex justify-between mt-3">
                                                <!-- Copy Button -->
                                                <button id="copyBtn"
                                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg focus:outline-none hover:bg-blue-600">
                                                    Copy
                                                </button>
                                                <!-- Regenerate Button -->
                                                <button id="regenBtn"
                                                    class="px-4 py-2 bg-green-500 text-white rounded-lg focus:outline-none hover:bg-green-600">
                                                    Regenerate
                                                </button>
                                            </div>
                                            @error('api_key')
                                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                            fill="#F04438" />
                                                    </svg>
                                                </span>
                                            @enderror
                                        </div>
                                        @error('api_key')
                                            <p class="text-theme-xs text-error-500 mt-1.5">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                        <!-- Error Message -->
                                        <div id="error-message" class="text-theme-xs text-error-500 mt-1.5 hidden">
                                            Error: Unable to generate API key
                                        </div>
                                    </div>


                                    <!-- Button Elements -->
                                    <div class="flex justify-end w-full gap-5">
                                        <button type="submit"
                                            class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                                            Update
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ====== Form Elements Section End -->
    </div>
@endsection
