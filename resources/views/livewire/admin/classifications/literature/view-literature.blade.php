<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">

    <!-- Page Header -->
    <header class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-white">
                        Literature Details
                    </h1>
                    <p class="text-blue-100 opacity-90 text-sm">
                        Full record for this literature entry as registered in CMIS.
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.classifications.literatures') }}"
                       class="px-3 py-2 text-sm rounded-lg bg-white/10 text-white hover:bg-white/20 border border-white/20 transition">
                        Back to List
                    </a>

                    <a href="{{ route('admin.classifications.literatures.edit', $literature->id) }}"
                       class="inline-flex items-center px-4 py-2 text-sm rounded-lg bg-white text-blue-700 hover:bg-blue-50 shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Literature
                    </a>
                </div>
            </div>

            <!-- Breadcrumb -->
            <nav class="px-6 mt-2 pb-4 text-xs text-blue-100">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('admin.classifications.literatures') }}" class="hover:underline">Literatures</a></li>
                    <li>/</li>
                    <li class="text-white font-medium">{{ $literature->literature_title }}</li>
                </ol>
            </nav>
        </div>
    </header>

    <!-- Notifications -->
    @if (session('success'))
        <div class="mx-4 sm:mx-6 lg:px-8 -mt-2">
            <div class="rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 shadow">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Left: Details -->
            <div class="lg:col-span-8 space-y-6">

                <!-- Overview -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b flex items-start justify-between gap-3">
                        <div>
                            <h2 class="text-sm font-semibold text-slate-800">Overview</h2>
                            <p class="text-xs text-slate-500">
                                Core identifiers and high-level info for this literature.
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-2 justify-end">
                            @if($literature->publication_year)
                                <span class="inline-flex items-center rounded-full bg-slate-50 text-slate-700 border border-slate-200 px-2 py-0.5 text-[11px] font-medium">
                                    Year: {{ $literature->publication_year }}
                                </span>
                            @endif
                            @if($literature->pages)
                                <span class="inline-flex items-center rounded-full bg-blue-50 text-blue-700 border border-blue-200 px-2 py-0.5 text-[11px] font-medium">
                                    {{ $literature->pages }} pages
                                </span>
                            @endif
                            @if($literature->genre)
                                <span class="inline-flex items-center rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 px-2 py-0.5 text-[11px] font-medium">
                                    {{ $literature->genre }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-5 space-y-4">
                        <div>
                            <h3 class="text-base font-semibold text-slate-900">
                                {{ $literature->literature_title }}
                            </h3>
                            @if($literature->slug)
                                <p class="mt-1 text-xs text-slate-500">
                                    Slug:
                                    <span class="font-mono text-[11px] bg-slate-50 border border-slate-200 px-1.5 py-0.5 rounded">
                                        {{ $literature->slug }}
                                    </span>
                                </p>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-800">
                            @if($literature->author)
                                <div>
                                    <p class="text-xs font-medium text-slate-600 mb-1">Author</p>
                                    <p>{{ $literature->author }}</p>
                                </div>
                            @endif
                            @if($literature->publisher)
                                <div>
                                    <p class="text-xs font-medium text-slate-600 mb-1">Publisher</p>
                                    <p>{{ $literature->publisher }}</p>
                                </div>
                            @endif
                        </div>

                        @if($literature->summary)
                            <div>
                                <h4 class="text-xs font-semibold text-slate-700 mb-1">Summary</h4>
                                <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                                    {{ $literature->summary }}
                                </p>
                            </div>
                        @endif
                    </div>
                </section>

            </div>

            <!-- Right: Cover & metadata -->
            <aside class="lg:col-span-4 space-y-6">

                <!-- Cover Art -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Cover Art</h3>
                        <p class="text-xs text-slate-500">
                            Visual cover associated with this literature (if any).
                        </p>
                    </div>
                    <div class="p-5">
                        @if($literature->cover_art_path)
                            <div class="rounded-lg border border-slate-200 overflow-hidden bg-slate-50">
                                <img src="{{ asset('storage/' . $literature->cover_art_path) }}"
                                     alt="Literature cover"
                                     class="w-full h-64 object-cover">
                            </div>
                            <a href="{{ asset('storage/' . $literature->cover_art_path) }}"
                               target="_blank"
                               class="mt-2 inline-block text-[11px] font-medium text-blue-600 hover:text-blue-700">
                                View / Download
                            </a>
                        @else
                            <p class="text-xs text-slate-500">
                                No cover art has been uploaded for this literature.
                            </p>
                        @endif
                    </div>
                </section>

                <!-- Record Metadata -->
                <section class="bg-white rounded-xl border shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b">
                        <h3 class="text-sm font-semibold text-slate-800">Record Metadata</h3>
                        <p class="text-xs text-slate-500">
                            System tracking information about when this record was registered or updated.
                        </p>
                    </div>
                    <div class="p-5 space-y-2 text-xs text-slate-600">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-700">Created at</span>
                            <span>{{ optional($literature->created_at)->format('d M Y, H:i') ?? '—' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-700">Last updated</span>
                            <span>{{ optional($literature->updated_at)->format('d M Y, H:i') ?? '—' }}</span>
                        </div>
                    </div>
                </section>

                <!-- Quick actions -->
                <section class="bg-white rounded-xl border shadow-sm p-5">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classifications.literatures') }}"
                           class="px-3 py-2 text-sm rounded-lg border border-slate-200 hover:bg-slate-50">
                            Back to List
                        </a>
                        <a href="{{ route('admin.classifications.literatures.edit', $literature->id) }}"
                           class="ml-auto inline-flex items-center px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Literature
                        </a>
                    </div>
                </section>
            </aside>
        </div>
    </main>
</div>
