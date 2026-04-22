<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                لوحة تحكم الأدمن
            </h2>

            <span class="text-sm text-gray-500 dark:text-gray-300">
                مرحبًا، {{ auth()->user()->name }}
            </span>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- الإحصائيات -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-300">إجمالي الكتب</p>
                            <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                                {{ $totalBooks ?? 0 }}
                            </h3>
                        </div>
                        <div class="text-3xl">📚</div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-300">النسخ المتاحة</p>
                            <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                                {{ $availableCopies ?? 0 }}
                            </h3>
                        </div>
                        <div class="text-3xl">📦</div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-300">طلبات معلقة</p>
                            <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                                {{ $pendingBorrows ?? 0 }}
                            </h3>
                        </div>
                        <div class="text-3xl">⏳</div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-300">عدد الطلاب</p>
                            <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                                {{ $totalStudents ?? 0 }}
                            </h3>
                        </div>
                        <div class="text-3xl">👨‍🎓</div>
                    </div>
                </div>

            </div>

            <!-- المحتوى -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                <!-- آخر طلبات الاستعارة -->
                <div class="xl:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                            آخر طلبات الاستعارة
                        </h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-right">
                            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                                <tr>
                                    <th class="px-6 py-4 font-semibold">الطالب</th>
                                    <th class="px-6 py-4 font-semibold">الكتاب</th>
                                    <th class="px-6 py-4 font-semibold">تاريخ الطلب</th>
                                    <th class="px-6 py-4 font-semibold">الحالة</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-gray-700 dark:text-gray-100">
                                @forelse($latestBorrows ?? [] as $borrow)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                        <td class="px-6 py-4">{{ $borrow->user->name ?? '-' }}</td>
                                        <td class="px-6 py-4">{{ $borrow->libraryBook->title ?? '-' }}</td>
                                        <td class="px-6 py-4">{{ $borrow->created_at?->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4">
                                            @php
                                                $status = $borrow->status ?? 'pending';
                                            @endphp

                                            @if($status === 'pending')
                                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                                    معلّق
                                                </span>
                                            @elseif($status === 'approved')
                                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                                    مقبول
                                                </span>
                                            @elseif($status === 'rejected')
                                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                    مرفوض
                                                </span>
                                            @else
                                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                                    راجع
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-300">
                                            لا توجد طلبات استعارة حاليًا
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- الجانب -->
                <div class="space-y-6">

                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">
                            أحدث الكتب
                        </h3>

                        <div class="space-y-4">
                            @forelse($latestBooks ?? [] as $book)
                                <div class="pb-4 border-b border-gray-100 dark:border-gray-700 last:border-b-0 last:pb-0">
                                    <p class="font-semibold text-gray-800 dark:text-white">
                                        {{ $book->title ?? 'بدون عنوان' }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-300 mt-1">
                                        {{ $book->author ?? 'بدون مؤلف' }}
                                    </p>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-300">لا توجد كتب مضافة بعد</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">
                            تنبيهات سريعة
                        </h3>

                        <ul class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
                            <li>يوجد {{ $pendingBorrows ?? 0 }} طلب استعارة بانتظار المراجعة.</li>
                            <li>راجعي الكتب غير المتاحة أو المستعارة حاليًا.</li>
                            <li>حدثي المناهج والمشاريع والملفات بشكل دوري.</li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>