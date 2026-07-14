<?php

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Livewire\Attributes\Layout;

new #[Layout('layouts::app3')] class extends Component
 {

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
        // Fix if your app uses spatie/laravel-permission or manual scope
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

    // FIXED: Optimized to run exactly 1 query instead of 30
    public function getChartData()
    {
        $start = now()->subDays(29)->startOfDay();
        $end = now()->endOfDay();

        $postsData = Post::whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');

        $barLabels = [];
        $barData = [];

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $barLabels[] = $date->translatedFormat('d M');
            $barData[] = $postsData->get($formattedDate, 0);
        }

        return [
            'labels' => $barLabels,
            'values' => $barData
        ];
    }

    // FIXED: Optimized to run exactly 1 query instead of 30
    public function getUsersPerDay()
    {
        $start = now()->subDays(29)->startOfDay();
        $end = now()->endOfDay();

        $usersData = User::whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');

        $barLabels = [];
        $barData = [];

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $barLabels[] = $date->translatedFormat('d M');
            $barData[] = $usersData->get($formattedDate, 0);
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

        $commentsData = Comment::whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');

        $barLabels = [];
        $barData = [];

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $barLabels[] = $date->translatedFormat('d M');
            $barData[] = $commentsData->get($formattedDate, 0);
        }

        return [
            'labels' => $barLabels,
            'values' => $barData
        ];
    }

    public function postsPerCategory()
    {
        // FIXED: Changed withCount('post') to withCount('posts') assuming plural setup
        $allCategories = Category::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->get();

        $topCategories = $allCategories->take(5);
        $remainingCategories = $allCategories->slice(5);

        $labels = $topCategories->pluck('name')->toArray();
        $data = $topCategories->pluck('posts_count')->toArray();

        if ($remainingCategories->isNotEmpty()) {
            $othersCount = $remainingCategories->sum('posts_count');
            $labels[] = 'أخرى';
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
 <select wire:model.change="days" class="rounded-md border-gray-300 dark:bg-gray-700 dark:text-white text-sm">
            <option value="7">أخر 7 أيام</option>
            <option value="30">أخر شهر</option>
            <option value="365">أخر سنة</option>
            <option value="0">الجميع</option>
        </select>
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
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">📊 عدد الأعضاء الجدد( أخر ثلاثين يوم )</h2>
        </div>

        <div class="h-64 relative">
            <canvas id="usersPerDayChart"></canvas>
        </div>
    </div>

    {{-- قسم الرسم البياني والفلترة --}}
    <div class="flex flex-col lg:flex-row bg-white dark:bg-gray-800 w-full my-2 p-6 rounded-lg shadow mb-6 gap-6">
        <div class="w-full lg:w-1/2 flex flex-col">
            <div class="flex flex-col md:flex-row items-center gap-4 mb-4">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white">📊المنشورات حسب الفئة</h2>
            </div>
            <div class="relative h-64">
                <canvas id="postsPerCategory"></canvas>
            </div>
        </div>
        <div class="w-full lg:w-1/2 flex flex-col">
            <div class="flex flex-col md:flex-row items-center gap-4 mb-4">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white">📊عدد التعليقات (أخر ثلاثين يوم)</h2>
            </div>
            <div class="relative h-64">
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
                        <tr class="text-gray-500 dark:text-gray-400 text-xs font-medium border-b border-gray-200 dark:border-gray-700">
                            <th class="py-2 text-right">عنوان الموضوع</th>
                            <th class="py-2 text-center">الردود</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                        @forelse($this->getTopPosts() as $post)
                            <tr>
                                <td class="py-3 text-gray-900 dark:text-gray-200 font-medium">{{ $post->title }}</td>
                                <td class="py-3 text-center">
                                    <span class="bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 px-2 py-0.5 rounded-full text-xs font-bold">
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
                        <tr class="text-gray-500 dark:text-gray-400 text-xs font-medium border-b border-gray-200 dark:border-gray-700">
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
                                            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="w-8 h-8 rounded-full" />
                                        @else
                                            <img src="{{ asset('images/profile.png') }}" alt="{{ $user->name }}" class="w-8 h-8 rounded-full" />
                                        @endif
                                        <p class="text-sm dark:text-white">{{ $user->name }}</p>
                                    </div>
                                </td>
                                <td class="py-3 text-center text-gray-600 dark:text-gray-400">{{ $user->posts_count }} مشاركة</td>
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

    {{-- FIXED: Global script scope cleaned up to prevent instances collisions --}}
    <script>
        document.addEventListener('livewire:navigated', () => {
            let postschartsInstance = null;
            let userschartsInstance = null;
            let categorieschartInstance = null;
            let commentsChartInstance = null; 

            function initAllCharts() {
                // 1. Posts Chart
                const ctxPosts = document.getElementById('postsPerDayChart');
                if (ctxPosts) {
                    if (postschartsInstance) postschartsInstance.destroy();
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
                            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
                            plugins: { legend: { display: false } }
                        }
                    });
                }

                // 2. Categories Chart
                const ctxCategories = document.getElementById('postsPerCategory');
                if (ctxCategories) {
                    if (categorieschartInstance) categorieschartInstance.destroy();
                    categorieschartInstance = new Chart(ctxCategories.getContext('2d'), {
                        type: 'pie',
                        data: {
                            labels: @json($this->postsPerCategory()['labels']),
                            datasets: [{
                                label: 'المنشورات',
                                data: @json($this->postsPerCategory()['values']),
                                backgroundColor: [
                                    'rgb(255, 0, 55)', 'rgb(3, 154, 255)', 'rgb(255, 218, 7)',
                                    'rgb(162, 0, 255)', 'rgb(72, 179, 77)', 'rgb(167, 101, 47)',
                                ],
                            }]
                        },
                        options: { responsive: true, maintainAspectRatio: false }
                    });
                }

                // 3. Users Chart
                const ctxUsers = document.getElementById('usersPerDayChart');
                if (ctxUsers) {
                    if (userschartsInstance) userschartsInstance.destroy();
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
                            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
                            plugins: { legend: { display: false } }
                        }
                    });
                }

                // 4. Comments Chart
                const ctxComments = document.getElementById('commentsPerDayChart');
                if (ctxComments) {
                    if (commentsChartInstance) commentsChartInstance.destroy();
                    commentsChartInstance = new Chart(ctxComments.getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: @json($this->getCommentsPerDay()['labels']),
                            datasets: [{
                                label: 'التعليقات',
                                data: @json($this->getCommentsPerDay()['values']),
                                borderColor: 'rgb(75, 192, 192)',
                                backgroundColor: 'rgba(75, 192, 192, 0.1)',
                                tension: 0.2,
                                fill: true
                            }]
                        },
                        options: { responsive: true, maintainAspectRatio: false }
                    });
                }
            }
            initAllCharts();
        });
    </script>
</div>