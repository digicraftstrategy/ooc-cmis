{{-- resources/views/admin/classifications/advertisement/show.blade.php --}}

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">

    <!-- Page Header -->
    <header class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">
                            Advertisement Details
                        </h1>
                        <p class="text-blue-100 opacity-90 text-sm">
                            Full record for this advertisement matter as registered in CMIS.
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.advertisements') }}"
                           class="px-3 py-2 text-sm rounded-lg bg-white/10 text-white hover:bg-white/20 border border-white/20 transition">
                            Back to List
                    </a>

                        <a href="{{ route('admin.classifications.advertisement.edit', $advertisement->id) }}"
                           class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-white text-blue-700 hover:bg-blue-50 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Advertisement
                        </a>
                    </div>
                </div>

                <!-- Breadcrumb -->
                <nav class="mt-4 text-xs text-blue-100">
                    <ol class="flex items-center gap-2">
                        <li>
                            <a href="{{ route('admin.classifications.advertisements') }}" class="hover:underline">
                                Advertisements
                            </a>
                        </li>
                        <li>/</li>
                        <li class="text-white font-medium">
                            {{ $advertisement->advertising_matter }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <!-- Notifications (optional) -->
    @if (session('success'))
        <div class="mx-4 sm:mx-6 lg:px-8 -mt-2">
            <div class="rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 shadow">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mx-4 sm:mx-6 lg:px-8 -mt-2">
            <div class="rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 shadow">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Left: Core details -->
            <div class="lg:col-span-8 space-y-6">

                <!-- Overview -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b flex items-start justify-between gap-3">
                        <div>
                            <h2 class="text-sm font-semibold text-slate-800">Overview</h2>
                            <p class="text-xs text-slate-500">
                                Core identifiers and high-level info for this advertisement matter.
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-2 justify-end">
                            @if($advertisement->has_subtitle)
                                <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 px-2 py-0.5 text-[11px] font-medium">
                                    Subtitled
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-slate-50 text-slate-600 border border-slate-200 px-2 py-0.5 text-[11px] font-medium">
                                    No Subtitles
                                </span>
                            @endif
                            @if($advertisement->language)
                                <span class="inline-flex items-center rounded-full bg-blue-50 text-blue-700 border border-blue-200 px-2 py-0.5 text-[11px] font-medium">
                                    {{ $advertisement->language }}
                                </span>
                            @endif
                            @if($advertisement->release_year)
                                <span class="inline-flex items-center rounded-full bg-slate-50 text-slate-700 border border-slate-200 px-2 py-0.5 text-[11px] font-medium">
                                    Year: {{ $advertisement->release_year }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-5 space-y-4">
                        <div>
                            <h3 class="text-base font-semibold text-slate-900">
                                {{ $advertisement->advertising_matter }}
                            </h3>
                            @if($advertisement->slug)
                                <p class="mt-1 text-xs text-slate-500">
                                    Slug:
                                    <span class="font-mono text-[11px] bg-slate-50 border border-slate-200 px-1.5 py-0.5 rounded">
                                        {{ $advertisement->slug }}
                                    </span>
                                </p>
                            @endif
                        </div>

                        @if($advertisement->description)
                            <div class="mt-2">
                                <h4 class="text-xs font-semibold text-slate-700 mb-1">Description</h4>
                                <p class="text-sm text-slate-700 leading-relaxed">
                                    {{ $advertisement->description }}
                                </p>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Creative & Production -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Creative & Production</h2>
                        <p class="text-xs text-slate-500">
                            Principal people and organisations involved in the advertisement.
                        </p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($advertisement->casts)
                            <div>
                                <p class="text-xs font-medium text-slate-600 mb-1">Main Actor / Actress</p>
                                <p class="text-sm text-slate-800">
                                    {{ $advertisement->casts }}
                                </p>
                            </div>
                        @endif

                        @if($advertisement->director)
                            <div>
                                <p class="text-xs font-medium text-slate-600 mb-1">Director</p>
                                <p class="text-sm text-slate-800">
                                    {{ $advertisement->director }}
                                </p>
                            </div>
                        @endif

                        @if($advertisement->producer)
                            <div>
                                <p class="text-xs font-medium text-slate-600 mb-1">Producer</p>
                                <p class="text-sm text-slate-800">
                                    {{ $advertisement->producer }}
                                </p>
                            </div>
                        @endif

                        @if($advertisement->production_company)
                            <div>
                                <p class="text-xs font-medium text-slate-600 mb-1">Production Company</p>
                                <p class="text-sm text-slate-800">
                                    {{ $advertisement->production_company }}
                                </p>
                            </div>
                        @endif

                        @if($advertisement->client_company)
                            <div class="md:col-span-2">
                                <p class="text-xs font-medium text-slate-600 mb-1">Client Company</p>
                                <p class="text-sm text-slate-800">
                                    {{ $advertisement->client_company }}
                                </p>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Content metadata -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Content Metadata</h2>
                        <p class="text-xs text-slate-500">
                            Technical and descriptive information used for classification and filters.
                        </p>
                    </div>

                    <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-xs font-medium text-slate-600 mb-1">Duration</p>
                            <p class="text-sm text-slate-800">
                                {{ $advertisement->duration ? $advertisement->duration . ' sec' : '—' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-slate-600 mb-1">Genre</p>
                            <p class="text-sm text-slate-800">
                                {{ $advertisement->genre ?: '—' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-slate-600 mb-1">Language</p>
                            <p class="text-sm text-slate-800">
                                {{ $advertisement->language ?: '—' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-slate-600 mb-1">Brand Promoted</p>
                            <p class="text-sm text-slate-800">
                                {{ $advertisement->brand_promoted ?: '—' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-slate-600 mb-1">Product Promoted</p>
                            <p class="text-sm text-slate-800">
                                {{ $advertisement->product_promoted ?: '—' }}
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Theme / Classification notes -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h2 class="text-sm font-semibold text-slate-800">Theme & Classification Notes</h2>
                        <p class="text-xs text-slate-500">
                            Narrative message, themes and any notes relevant to classification decisions.
                        </p>
                    </div>

                    <div class="p-5">
                        <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                            {{ $advertisement->theme ?: 'No theme or narrative summary has been recorded for this advertisement yet.' }}
                        </p>
                    </div>
                </section>

            </div>

            <!-- Right: Attachments & audit -->
            <aside class="lg:col-span-4 space-y-6">

                <!-- Attachments -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Attachments</h3>
                        <p class="text-xs text-slate-500">
                            Submission files uploaded for this advertisement (images, video, documents).
                        </p>
                    </div>

                    @php
                        // poster_path may be stored as JSON or single string
                        $attachmentsRaw = $advertisement->poster_path ?? null;

                        if (is_string($attachmentsRaw)) {
                            $decoded = json_decode($attachmentsRaw, true);
                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                $attachments = $decoded;
                            } elseif (trim($attachmentsRaw) !== '') {
                                $attachments = [$attachmentsRaw];
                            } else {
                                $attachments = [];
                            }
                        } elseif (is_array($attachmentsRaw)) {
                            $attachments = $attachmentsRaw;
                        } else {
                            $attachments = [];
                        }
                    @endphp

                    <div class="p-5 space-y-4">
                        @if (count($attachments) === 0)
                            <p class="text-xs text-slate-500">
                                No attachments have been uploaded for this advertisement.
                            </p>
                        @else
                            <ul class="space-y-2">
                                @foreach ($attachments as $filePath)
                                    @php
                                        $fileName = basename($filePath);
                                        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                                        $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                                        $isVideo = in_array($ext, ['mp4','mov','m4v','avi','mkv']);
                                        $isDoc   = in_array($ext, ['pdf','doc','docx']);
                                    @endphp
                                    <li class="flex items-center justify-between rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-xs">
                                        <div class="flex items-center gap-2 min-w-0">
                                            <div class="flex h-7 w-7 items-center justify-center rounded-full 
                                                @if($isImage) bg-indigo-100 text-indigo-700
                                                @elseif($isVideo) bg-emerald-100 text-emerald-700
                                                @elseif($isDoc) bg-amber-100 text-amber-700
                                                @else bg-slate-100 text-slate-700 @endif">
                                                @if($isImage)
                                                    <!-- image icon -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M4 16l4-4 4 4 4-4 4 4M4 6h16v12H4z" />
                                                    </svg>
                                                @elseif($isVideo)
                                                    <!-- video icon -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 6h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
                                                    </svg>
                                                @elseif($isDoc)
                                                    <!-- doc icon -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M7 3h8l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                                    </svg>
                                                @else
                                                    <!-- generic -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M4 16V4a2 2 0 012-2h8l6 6v8a2 2 0 01-2 2H6a2 2 0 01-2-2z" />
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="min-w-0">
                                                <p class="truncate font-medium text-slate-800">
                                                    {{ $fileName }}
                                                </p>
                                                <p class="text-[11px] text-slate-500">
                                                    {{ strtoupper($ext) }} file
                                                </p>
                                            </div>
                                        </div>

                                        <a href="{{ asset('storage/' . ltrim($filePath, '/')) }}"
                                           target="_blank"
                                           class="text-[11px] font-medium text-blue-600 hover:text-blue-700">
                                            View / Download
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            {{-- Optional: Large preview for first image attachment --}}
                            @php
                                $firstImagePath = null;
                                foreach ($attachments as $f) {
                                    $e = strtolower(pathinfo($f, PATHINFO_EXTENSION));
                                    if (in_array($e, ['jpg','jpeg','png','gif','webp'])) {
                                        $firstImagePath = $f;
                                        break;
                                    }
                                }
                            @endphp

                            @if($firstImagePath)
                                <div class="mt-4">
                                    <p class="text-xs font-medium text-slate-600 mb-1">Primary Image Preview</p>
                                    <div class="rounded-lg border border-slate-200 overflow-hidden bg-slate-50">
                                        <img src="{{ asset('storage/' . ltrim($firstImagePath, '/')) }}"
                                             alt="Advertisement image preview"
                                             class="w-full h-56 object-cover">
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </section>

                <!-- Audit trail -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Record Metadata</h3>
                        <p class="text-xs text-slate-500">
                            System tracking information about when this advertisement was registered or updated.
                        </p>
                    </div>
                    <div class="p-5 space-y-2 text-xs text-slate-600">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-700">Created by</span>
                            <span>
                                {{ $advertisement->user?->name ?? 'Unknown User' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-700">Created at</span>
                            <span>
                                {{ optional($advertisement->created_at)->format('d M Y, H:i') ?? '—' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-700">Last updated</span>
                            <span>
                                {{ optional($advertisement->updated_at)->format('d M Y, H:i') ?? '—' }}
                            </span>
                        </div>
                    </div>
                </section>

                <!-- Quick actions -->
                <section class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.advertisements') }}"
                           class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50">
                            Back to List
                        </a>
                        <a href="{{ route('admin.classifications.advertisement.edit', $advertisement->id) }}"
                           class="ml-auto inline-flex items-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Advertisement
                        </a>
                    </div>
                </section>

            </aside>
        </div>
    </main>
</div>
