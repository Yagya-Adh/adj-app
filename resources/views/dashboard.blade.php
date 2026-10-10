```blade
@extends('layouts.app')

@section('adminContent')

<div class="min-h-screen bg-slate-50 px-4 py-6 sm:px-6 lg:px-8">

    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Gold & Silver Analytics
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Nepal precious metals market · NPR per tola
            </p>
        </div>

        <a href="https://www.fenegosida.org/"
           target="_blank"
           rel="noopener noreferrer"
           class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
            Official Market Source ↗
        </a>
    </div>

    {{-- Price Cards --}}
    <div class="mb-8 grid gap-5 sm:grid-cols-2">

        <div class="rounded-2xl border border-amber-100 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="font-medium text-slate-500">Gold · 24K</span>
                <span class="rounded-xl bg-amber-100 p-3 text-xl">🥇</span>
            </div>
            <p id="goldRate" class="mt-4 text-3xl font-bold text-slate-800">
                Loading...
            </p>
            <p class="mt-2 text-sm text-slate-500">NPR per tola</p>
            <p id="goldChange" class="mt-3 text-sm font-semibold text-slate-500">
                Loading history...
            </p>
            <p id="goldDate" class="mt-2 text-xs text-slate-400"></p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="font-medium text-slate-500">Silver</span>
                <span class="rounded-xl bg-slate-100 p-3 text-xl">🥈</span>
            </div>
            <p id="silverRate" class="mt-4 text-3xl font-bold text-slate-800">
                Loading...
            </p>
            <p class="mt-2 text-sm text-slate-500">NPR per tola</p>
            <p id="silverChange" class="mt-3 text-sm font-semibold text-slate-500">
                Loading history...
            </p>
            <p id="silverDate" class="mt-2 text-xs text-slate-400"></p>
        </div>

    </div>

    {{-- Chart --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6">

        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Historical Price Trends
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Daily market history from public CSV data
                </p>
            </div>

            <div class="flex gap-2">
                <button type="button" data-period="daily"
                    class="period-btn rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white">
                    Daily
                </button>
                <button type="button" data-period="weekly"
                    class="period-btn rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-600">
                    Weekly
                </button>
                <button type="button" data-period="monthly"
                    class="period-btn rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-600">
                    Monthly
                </button>
            </div>
        </div>

        <div class="relative h-80 sm:h-96">
            <canvas id="marketChart"></canvas>
        </div>

        <p id="chartMessage" role="status" aria-live="polite"
           class="mt-4 text-sm text-slate-500">
            Loading market data...
        </p>
    </div>

    {{-- Insights --}}
    <div class="mt-8 grid gap-5 md:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="font-bold text-slate-800">Gold Market Insight</h3>
            <p id="goldInsight" class="mt-3 text-sm leading-6 text-slate-600">
                Loading...
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="font-bold text-slate-800">Silver Market Insight</h3>
            <p id="silverInsight" class="mt-3 text-sm leading-6 text-slate-600">
                Loading...
            </p>
        </div>
    </div>

    <p class="mt-6 text-xs leading-5 text-slate-400">
        Data source: public community-maintained dataset compiled from
        published Nepal market rates. Data may be delayed or incomplete.
        Confirm current rates with the official association before trading.
    </p>

</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.8/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const SOURCES = {
        gold: 'https://cdn.jsdelivr.net/gh/binayabaral/nepal-market-data@main/data/precious-metals/gold-24k.csv',
        silver: 'https://cdn.jsdelivr.net/gh/binayabaral/nepal-market-data@main/data/precious-metals/silver.csv'
    };

    const $ = id => document.getElementById(id);

    const formatMoney = value => value == null
        ? 'N/A'
        : 'रु ' + Number(value).toLocaleString('en-IN', {
            maximumFractionDigits: 2
        });

    let goldHistory = [];
    let silverHistory = [];

    if (typeof Chart === 'undefined') {
        $('chartMessage').textContent = 'Chart.js failed to load. Check your internet connection.';
        return;
    }

    const chart = new Chart($('marketChart'), {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'Gold 24K (NPR/tola)',
                    data: [],
                    borderColor: '#d97706',
                    backgroundColor: 'rgba(217,119,6,.10)',
                    fill: true,
                    tension: .3,
                    borderWidth: 3,
                    pointRadius: 2
                },
                {
                    label: 'Silver (NPR/tola)',
                    data: [],
                    borderColor: '#64748b',
                    backgroundColor: 'rgba(100,116,139,.08)',
                    fill: false,
                    tension: .3,
                    borderWidth: 3,
                    pointRadius: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { usePointStyle: true, padding: 20 }
                },
                tooltip: {
                    callbacks: {
                        label: context =>
                            `${context.dataset.label}: ${formatMoney(context.parsed.y)}`
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { maxTicksLimit: 10, color: '#64748b' }
                },
                y: {
                    beginAtZero: false,
                    ticks: {
                        color: '#64748b',
                        callback: value => formatMoney(value)
                    },
                    grid: { color: '#f1f5f9' }
                }
            }
        }
    });

    // Parse the published_date,price CSV.
    function parseCSV(csv) {
        return csv.trim().split(/\r?\n/).slice(1)
            .map(line => {
                const columns = line.split(',');
                const date = columns[0]?.trim();
                const price = Number(columns[1]?.trim());

                return {
                    date,
                    price,
                    timestamp: Date.parse(date)
                };
            })
            .filter(row =>
                row.date &&
                Number.isFinite(row.price) &&
                Number.isFinite(row.timestamp)
            )
            .sort((a, b) => a.timestamp - b.timestamp);
    }

    async function fetchCSV(url) {
        const response = await fetch(url, { cache: 'no-cache' });

        if (!response.ok) {
            throw new Error(`Data request failed (${response.status})`);
        }

        return parseCSV(await response.text());
    }

    function updateCard(type, history) {
        const latest = history.at(-1);
        const previous = history.at(-2);

        if (!latest) {
            $(`${type}Rate`).textContent = 'N/A';
            $(`${type}Change`).textContent = 'No price data available';
            $(`${type}Date`).textContent = '';
            return;
        }

        $(`${type}Rate`).textContent = formatMoney(latest.price);
        $(`${type}Date`).textContent = `Published date: ${latest.date}`;

        if (!previous || previous.price === 0) {
            $(`${type}Change`).textContent = 'Change unavailable';
            return;
        }

        const change = ((latest.price - previous.price) / previous.price) * 100;
        const element = $(`${type}Change`);

        element.textContent =
            `${change > 0 ? '▲ +' : change < 0 ? '▼ ' : '● '}${change.toFixed(2)}% vs previous record`;

        element.classList.remove('text-emerald-600', 'text-red-600', 'text-slate-500');
        element.classList.add(
            change > 0 ? 'text-emerald-600' :
            change < 0 ? 'text-red-600' : 'text-slate-500'
        );
    }

    function aggregate(history, period) {
        if (period === 'daily') {
            return history.slice(-30);
        }

        const grouped = new Map();

        history.forEach(row => {
            const date = new Date(row.timestamp);
            let key;

            if (period === 'weekly') {
                const day = new Date(Date.UTC(
                    date.getUTCFullYear(),
                    date.getUTCMonth(),
                    date.getUTCDate()
                ));
                day.setUTCDate(day.getUTCDate() - ((day.getUTCDay() + 6) % 7));
                key = day.toISOString().slice(0, 10);
            } else {
                key = row.date.slice(0, 7);
            }

            // Keep the last published price for each period.
            grouped.set(key, row);
        });

        return Array.from(grouped.values()).slice(
            period === 'weekly' ? -12 : -12
        );
    }

    function insight(history) {
        if (history.length < 2) {
            return 'Not enough historical records to calculate a trend.';
        }

        const first = history[0].price;
        const last = history.at(-1).price;
        const change = first ? ((last - first) / first) * 100 : 0;

        const direction = change > 0 ? 'increased'
            : change < 0 ? 'decreased' : 'remained stable';

        return `The price ${direction} by ${Math.abs(change).toFixed(2)}% over the displayed historical period.`;
    }

    function render(period = 'daily') {
        const gold = aggregate(goldHistory, period);
        const silver = aggregate(silverHistory, period);

        // Merge dates so each metal retains its own actual published values.
        const dates = [...new Set([
            ...gold.map(row => row.date),
            ...silver.map(row => row.date)
        ])].sort();

        const goldMap = new Map(gold.map(row => [row.date, row.price]));
        const silverMap = new Map(silver.map(row => [row.date, row.price]));

        chart.data.labels = dates;
        chart.data.datasets[0].data = dates.map(date => goldMap.get(date) ?? null);
        chart.data.datasets[1].data = dates.map(date => silverMap.get(date) ?? null);
        chart.update();

        $('goldInsight').textContent = insight(gold);
        $('silverInsight').textContent = insight(silver);

        $('chartMessage').textContent =
            `Showing ${period} historical prices. Latest available records may not be from today.`;
    }

    document.querySelectorAll('.period-btn').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.period-btn').forEach(item => {
                item.classList.remove('bg-blue-600', 'text-white');
                item.classList.add('bg-slate-100', 'text-slate-600');
            });

            button.classList.add('bg-blue-600', 'text-white');
            button.classList.remove('bg-slate-100', 'text-slate-600');

            render(button.dataset.period);
        });
    });

    async function init() {
        $('chartMessage').textContent = 'Fetching gold and silver CSV data...';

        try {
            const [gold, silver] = await Promise.all([
                fetchCSV(SOURCES.gold),
                fetchCSV(SOURCES.silver)
            ]);

            goldHistory = gold;
            silverHistory = silver;

            updateCard('gold', goldHistory);
            updateCard('silver', silverHistory);
            render('daily');
        } catch (error) {
            $('chartMessage').textContent =
                `Unable to fetch market data: ${error.message}. Try again later or verify the source URLs.`;
        }
    }

    init();
});
</script>

@endsection