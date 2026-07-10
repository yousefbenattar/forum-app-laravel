<?php

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

new #[Layout('layouts::app3')] class extends Component {


    public function getAllPosts()
    {
        return Post::latest()->get();
    }

    public function getTotalUsers()
    {
        return User::count();
    }

    public function getPostToday()
    {
        return Post::whereDate('created_at', today())->count();
    }

    public function getTotalPosts()
    {
        return Post::count();
    }

    public function getTotalAdmins()
    {
        return User::role("admin")->count();
    }

    public function getTopContributors()
    {
        return User::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();
    }

    public function getTopPosts()
    {
        return Post::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(10)
            ->get();
    }

    public function getTotalComments()
    {
        return Comment::whereDate('created_at', today())->count();
    }

    // تعديل الدالة لتعمل بناءً على التواريخ المختارة
    public function getChartData()
    {
        $barLabels = [];
        $barData = [];

        $start = Carbon::parse(now()->subDays(29)->format('Y-m-d'));
        $end = Carbon::parse(now()->format('Y-m-d'));

        // حلقة تكرارية تمر على الأيام المحصورة بين التاريخين
        for ($date = $start; $date->lte($end); $date->addDay()) {
            $barLabels[] = $date->format('d M'); // تنسيق اليوم والشهر
            $barData[] = Post::whereDate('created_at', $date->format('Y-m-d'))->count();
        }

        return [
            'labels' => $barLabels,
            'values' => $barData
        ];
    }
    public function getUsersPerDay()
    {
        $barLabels = [];
        $barData = [];

        $start = Carbon::parse(now()->subDays(29)->format('Y-m-d'));
        $end = Carbon::parse(now()->format('Y-m-d'));

        // حلقة تكرارية تمر على الأيام المحصورة بين التاريخين
        for ($date = $start; $date->lte($end); $date->addDay()) {
            $barLabels[] = $date->format('d M'); // تنسيق اليوم والشهر
            $barData[] = User::whereDate('created_at', $date->format('Y-m-d'))->count();
        }

        return [
            'labels' => $barLabels,
            'values' => $barData
        ];
    }
    public function getCommentsPerDay()
    {
        $start = now()->subDays(29)->startOfDay();
        $end = now()->endOfDay();

        // 1. Get all comment counts grouped by date in ONE single database query
        $commentsData = Comment::whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date'); // Creates an associative array: ['2026-07-01' => 12]

        $barLabels = [];
        $barData = [];

        // 2. Loop through the 30 days purely in-memory (lightning fast)
        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');

            $barLabels[] = $date->translatedFormat('d M');
            // If the date exists in our query results, use its count. Otherwise, default to 0.
            $barData[] = $commentsData->get($formattedDate, 0);
        }

        return [
            'labels' => $barLabels,
            'values' => $barData
        ];
    }
    public function postsPerCategory()
    {
        // 1. Fetch all categories with their post counts, sorted from highest to lowest
        $allCategories = Category::withCount('post')
            ->orderBy('post_count', 'desc')
            ->get();

        // 2. Take the top 5 categories
        $topCategories = $allCategories->take(5);

        // 3. Gather the remaining categories (from index 5 onwards)
        $remainingCategories = $allCategories->slice(5);

        // 4. Extract labels and values for the top 5
        $labels = $topCategories->pluck('name')->toArray();
        $data = $topCategories->pluck('post_count')->toArray();

        // 5. If there are remaining categories, calculate the "Others" total
        if ($remainingCategories->isNotEmpty()) {
            $othersCount = $remainingCategories->sum('post_count');

            // Append "Others" (or "أخرى" if your dashboard is in Arabic) to the arrays
            $labels[] = 'أخرى'; // You can change this to 'Others' if preferred
            $data[] = $othersCount;
        }

        return [
            'labels' => $labels,
            'values' => $data
        ];
    }
};
?>

<div dir="rtl" class="p-6 bg-white min-h-screen text-right">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-bold text-gray-800 dark:text-white">لوحة التحكم الرئيسية</h1>
    </div>

    {{-- الكروت الإحصائية --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow ">
            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">إجمالي الأعضاء</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $this->getTotalUsers() }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow ">
            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">عدد المشرفين</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $this->getTotalAdmins() }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow ">
            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">المواضيع الجديدة اليوم</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $this->getPostToday() }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow ">
            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">الردود الجديدة اليوم</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $this->getTotalComments() }}</p>
        </div>
    </div>

    {{-- قسم الرسم البياني والفلترة --}}
    <div class="bg-white dark:bg-gray-800 w-full my-2 p-6 rounded-lg shadow mb-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-4">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">📊 عدد المنشورات ( أخر ثلاثين يوم )</h2>
        </div>

        <div class="h-64 relative">
            <canvas id="postsPerDayChart"></canvas>
        </div>
    </div>
    {{-- قسم الرسم البياني والفلترة --}}
    <div class="bg-white dark:bg-gray-800 w-full my-2 p-6 rounded-lg shadow mb-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-4">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">
                📊 عدد الأعضاء الجدد( أخر ثلاثين يوم )</h2>
        </div>

        <div class="h-64 relative">
            <canvas id="usersPerDayChart"></canvas>
        </div>
    </div>
    {{-- قسم الرسم البياني والفلترة --}}
    <div class=" flex bg-white dark:bg-gray-800 w-full my-2 p-6 rounded-lg shadow mb-6">
        <div class="w-1/2 flex flex-col">
            <div class="flex flex-col md:flex-row items-center gap-4 mb-4">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white">📊المنشورات حسب الفئة</h2>
            </div>

            <div class=" relative">
                <canvas id="postsPerCategory"></canvas>
            </div>
        </div>
        <div class="w-1/2 flex flex-col">
            <div class="flex flex-col md:flex-row items-center gap-4 mb-4">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white">📊عدد التعليقات (أخر ثلاثين يوم)</h2>
            </div>

            <div class=" relative">
                <canvas id="commentsPerDayChart"></canvas>
            </div>
        </div>
    </div>
    {{-- الجداول الإحصائية --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- المواضيع الأكثر تفاعلاً --}}
        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                <span>🔥</span> المواضيع الأكثر تفاعلاً
            </h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr
                            class="text-gray-500 dark:text-gray-400 text-xs font-medium border-b border-gray-200 dark:border-gray-700">
                            <th class="py-2 text-right">عنوان الموضوع</th>
                            <th class="py-2 text-center">الردود</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                        @forelse($this->getTopPosts() as $post)
                            <tr>
                                <td class="py-3 text-gray-900 dark:text-gray-200 font-medium">{{ $post->title }}</td>
                                <td class="py-3 text-center">
                                    {{-- تم التعديل هنا لاستخدام الكاونت المحمل مسبقاً تسريعاً للأداء --}}
                                    <span
                                        class="bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 px-2 py-0.5 rounded-full text-xs font-bold">
                                        {{ $post->comments_count }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-4 text-center text-gray-400">لا توجد مواضيع حالياً</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- الأعضاء الأكثر نشاطاً --}}
        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                <span>🏆</span> المؤرخون الأكثر نشاطاً (هذا الأسبوع)
            </h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr
                            class="text-gray-500 dark:text-gray-400 text-xs font-medium border-b border-gray-200 dark:border-gray-700">
                            <th class="py-2 text-right">المستخدم</th>
                            <th class="py-2 text-center">المشاركات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                        @forelse($this->getTopContributors() as $user)
                            <tr>
                                <td class="py-3 text-gray-900 dark:text-gray-200 font-semibold">
                                    <div class="flex items-center gap-2">
                                        @if ($user->avatar)
                                            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}"
                                                class="w-8 h-8 rounded-full" />
                                        @else
                                            <img src="{{ asset('images/profile.png') }}" alt="{{ $user->name }}"
                                                class="w-8 h-8 rounded-full" />
                                        @endif
                                        <p class="text-sm dark:text-white">{{ $user->name }}</p>
                                    </div>
                                </td>
                                <td class="py-3 text-center text-gray-600 dark:text-gray-400">{{ $user->posts_count }}
                                    مشاركة</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-4 text-center text-gray-400">لا يوجد متفاعلين هذا الأسبوع</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- جافاسكريبت الخاص بتحديث الـ Chart وتجنب الاختفاء عند تحديث Livewire --}}
    {{--
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script>
        document.addEventListener('livewire:navigated', () => {
            let postschartsInstance = null;
            let userschartsInstance = null;
            let categorieschartInstance = null;


            function initAllCharts() {
                const ctxPosts = document.getElementById('postsPerDayChart');
                if (!ctxPosts) return;

                if (postschartsInstance) {
                    postschartsInstance.destroy();
                }

                postschartsInstance = new Chart(ctxPosts.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: @json($this->getChartData()['labels']),
                        datasets: [{
                            label: 'المنشورات',
                            data: @json($this->getChartData()['values']),
                            backgroundColor: '#3b82f6',
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: { beginAtZero: true, ticks: { precision: 0 } }
                        },
                        plugins: { legend: { display: false } }
                    }
                });


                const ctxCategories = document.getElementById('postsPerCategory');
                if (!ctxCategories) return;

                if (categorieschartInstance) {
                    categorieschartInstance.destroy();
                }

                categorieschartInstance = new Chart(ctxCategories.getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: @json($this->postsPerCategory()['labels']),
                        datasets: [{
                            label: 'المنشورات',
                            data: @json($this->postsPerCategory()['values']),
                            backgroundColor: [
                                'rgb(255, 0, 55)',
                                'rgb(3, 154, 255)',
                                'rgb(255, 218, 7)',
                                'rgb(162, 0, 255)',
                                'rgb(72, 179, 77)',
                                'rgb(167, 101, 47)',
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                });

                const ctxUsers = document.getElementById('usersPerDayChart');
                if (!ctxUsers) return;

                if (userschartsInstance) {
                    userschartsInstance.destroy();
                }

                userschartsInstance = new Chart(ctxUsers.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: @json($this->getUsersPerDay()['labels']),
                        datasets: [{
                            label: 'المستخدمون',
                            data: @json($this->getUsersPerDay()['values']),
                            backgroundColor: '#10b981',
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: { beginAtZero: true, ticks: { precision: 0 } }
                        },
                        plugins: { legend: { display: false } }
                    }
                });
                // ---------------------------------
                // Make sure this is declared at the top level of your livewire:navigated event listener
                let commentsChartInstance = null; // Clean, singular naming

                const ctxComments = document.getElementById('commentsPerDayChart');
                if (ctxComments) {
                    // Check and destroy the correct variable name
                    if (commentsChartInstance) {
                        commentsChartInstance.destroy();
                    }

                    // Assign directly to the correct variable instance
                    commentsChartInstance = new Chart(ctxComments.getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: @json($this->getCommentsPerDay()['labels']),
                            datasets: [{
                                label: 'التعليقات',
                                data: @json($this->getCommentsPerDay()['values']),
                                borderColor: 'rgb(75, 192, 192)',
                                backgroundColor: 'rgba(75, 192, 192, 0.1)', // Optional shading under line
                                tension: 0.2, // Smoothes out the line nicely
                                fill: true
                            }]
                        },
                       
                    });
                }
            }
            initAllCharts();
        });
    </script>
</div>